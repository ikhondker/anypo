<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			PoController.php
* @brief		This file contains the implementation of the PoController
* @path			\App\Http\Controllers\Tenant
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Po;
use App\Http\Requests\Tenant\StorePoRequest;
use App\Http\Requests\Tenant\UpdatePoRequest;


# 1. Models
use App\Models\User;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Pol;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;

use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Manage\CustomError;
use App\Models\Tenant\Attachment;


use App\Models\Tenant\Workflow\Hierarchy;
use App\Models\Tenant\Workflow\Hierarchyl;


use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;

use App\Models\Tenant\Workflow\Wfl;
# 2. Enums
use App\Enum\UserRoleEnum;
use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\WflActionEnum;
use App\Enum\Tenant\ClosureStatusEnum;
use App\Enum\Tenant\AuthStatusEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
use App\Helpers\Tenant\Workflow;
use App\Helpers\Tenant\FileUpload;
use App\Helpers\Tenant\PoBudget;
use App\Helpers\Tenant\ExchangeRate;
# 4. Notifications
use Notification;
use App\Notifications\Tenant\PoActions;
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
use App\Http\Controllers\Tenant\DeptBudgetControllers;
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
# 13. FUTURE


class PoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Po::class);

		$pos = Po::query();
		if (request('term')) {
			$pos->where('summary', 'LIKE', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
			case UserRoleEnum::HOD->value:
				$pos = $pos->ByDeptAll()->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
				$pos = $pos->All()->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::CXO->value:
				$pos = $pos->AllApproved()->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::ADMIN->value:
				$pos = $pos->AllExceptDraft()->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::SYSTEM->value:
				$pos = $pos->with('dept')->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				//$pos = $pos->ByUserAll()->paginate(10);
				Log::warning(tenant('id'). ' tenant.po.index Other role = '. auth()->user()->role->value);
				abort(403);
		}

		return view('tenant.pos.index', compact('pos'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Po::class);

		$setup 	= Setup::first();
		if ($setup->readonly ){
			return redirect()->route('dashboards.index')->with('error', config('akk.MSG_READ_ONLY'));
		}

		$depts 		= Dept::primary()->get();
		$items 		= Item::primary()->get();
		$suppliers 	= Supplier::primary()->get();
		$projects 	= Project::primary()->get();
		$uoms 		= Uom::primary()->get();

		return view('tenant.pos.create', compact('suppliers', 'depts', 'items','uoms', 'projects'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StorePoRequest $request)
	{
		$this->authorize('create', Po::class);
		$setup = Setup::first();

		// don't set dept_budget_id . It will be save during submissions
		//$request->merge(['requestor_id'	=> 	auth()->id() ]);
		$request->merge(['po_date'		=> date('Y-m-d H:i:s')]);
		$request->merge(['buyer_id'		=> auth()->user()->id]);
		$request->merge(['requestor_id'	=> auth()->user()->id]);
		$request->merge(['fc_currency'	=> $setup->currency]);

		// as this is the first line po value will be same as pol values
		$request->merge(['sub_total'	=> $request->input('qty') * $request->input('price')]);
		$request->merge(['tax'			=> $request->input('tax')]);
		$request->merge(['gst'			=> $request->input('gst')]);
		$request->merge(['amount'		=> ($request->input('qty')*$request->input('price'))+$request->input('tax')+ $request->input('gst') ]);


		// User and HoD Can create only own department PO
		if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value ) {
			$request->merge(['dept_id'		=> auth()->user()->dept_id]);
		}

		if($request->has('tc')) {
			//Checkbox checked
			$request->merge(['tc' => 1]);
		} else {
			//Checkbox not checked
			$request->merge([ 'tc' => 0]);
		}

		$po = Po::create($request->all());
		// Write to Log
		EventLog::event('po', $po->id, 'create');

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $po->id ]);
			$request->merge(['entity'		=> EntityEnum::PO->value ]);
			$attid = FileUpload::aws($request);
			//$request->merge(['logo'		=> $fileName ]);
		}

		// create pol lines
		$pol				= new Pol();
		$pol->po_id			= $po->id;
		$pol->line_num		= 1;
		$pol->item_id		= $request->input('item_id');
		$pol->dept_id		= $po->dept_id;
		$pol->requestor_id	= $po->requestor_id;
		$pol->uom_id		= $request->input('uom_id');
		//$pol->summary		= $request->input('summary');
		$pol->item_description	= $request->input('item_description');
		$pol->qty			= $request->input('qty');
		$pol->price			= $request->input('price');

		$pol->sub_total		= $request->input('qty') * $request->input('price');
		$pol->tax			= $request->input('tax');
		$pol->gst			= $request->input('gst');
		$pol->amount		= ($request->input('qty') * $request->input('price')) +$request->input('tax')+$request->input('gst');

		$pol->save();
		$pol_id			= $pol->id;

		$result = Po::syncPoValues($po->id);
		Log::debug('tenant.PoController.update Return value of Po->syncPoValues = ' . $result);
		if ($result == '') {
			Log::debug('tenant.po.update syncPoValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.po.store syncPoValues po_id = '.$po->id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}



		if($request->has('add_row')) {
			//Checkbox checked
			return redirect()->route('pols.add-line', $pol->po_id)->with('success', 'Line added to PO #'. $pol->po_id.' successfully.');
			//return redirect()->route('pols.createline', $po->id)->with('success', 'PO #'. $po->id.' created successfully. Please add more line.');
		} else {
			//Checkbox not checked
			return redirect()->route('pos.show', $pol->po_id)->with('success', 'Lined added to PO #'. $pol->po_id.' successfully.');
			//return redirect()->route('pos.show', $po->id)->with('success', 'PO #'. $po->id.' created successfully.');
		}

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Po $po)
	{
		$this->authorize('view', $po);

		$pols = Pol::where('po_id', $po->id)->get()->all();

		// approve-reject form
		if ($po->auth_status == AuthStatusEnum::INPROCESS->value) {
			try {
				$wfl = Wfl::where('wf_id', $po->wf_id)->where('action', WflActionEnum::PENDING->value)->where('performer_id', auth()->user()->id)->firstOrFail();
			} catch (ModelNotFoundException $exception) {
				$wfl = "";
				Log::debug("tenant.po.show: Okay. Not pending with current user.");
			}
		} else {
			$wfl = "";
		}
		return view('tenant.pos.show', compact('po', 'pols', 'wfl'));
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Po $po)
	{
		$this->authorize('update', $po);


		if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('pos.show',$po->id)->with('error', 'You can not edit a Purchase Order with status '. strtoupper($po->auth_status) .' !');
		}

		$depts = Dept::primary()->get();

		$suppliers = Supplier::primary()->get();
		$projects = Project::primary()->get();
		$users = User::tenant()->get();

		$pols = Pol::with('item')->with('uom')->where('po_id', $po->id)->get()->all();

		return view('tenant.pos.edit', compact('po','pols', 'suppliers', 'depts', 'projects', 'users'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePoRequest $request, Po $po)
	{
		$this->authorize('update', $po);

		// User and HoD Can not edit department PRO
		if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value ) {
			$request->merge(['dept_id'		=> auth()->user()->dept_id]);
		}

		if($request->has('tc')) {
			//Checkbox checked
			$request->merge(['tc' => 1]);
		} else {
			//Checkbox not checked
			$request->merge([ 'tc' => 0]);
		}

		// Write to Log
		EventLog::event('po', $po->id, 'update', 'summary', $po->summary);
		$po->update($request->all());

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_po_id') ]);
			$request->merge(['entity'		=> EntityEnum::PO->value ]);
			$attid = FileUpload::aws($request);
			//$request->merge(['logo'	=> $fileName ]);
		}

		$result = Po::syncPoValues($po->id);
		Log::debug('tenant.PoController.update Return value of Po->syncPoValues = ' . $result);
		if ($result == '') {
			Log::debug('tenant.po.update syncPoValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.po.store syncPoValues po_id = '.$po->id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}

		return redirect()->route('pos.show', $po->id)->with('success', 'Purchase Purchase Order updated successfully.');
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Po $po)
	{
		$this->authorize('delete', $po);

		if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('pos.show', $po->id)->with('error', 'Only DRAFT Purchase Order can be deleted!');
		}

		if ($po->buyer_id <> auth()->user()->id) {
			return redirect()->route('pos.show',$po->id)->with('error', 'You can only Delete Purchase Orders created by you!');
		}

		// mark all source PR as non converted to PO and make it open
		Log::debug(tenant('id'). ' tenant.po.destroy marking source PR as open for po_id = '.$po->id);
		Pr::where('po_id', $po->id)
			->update([
				'po_id' 	=> null,
				'status'	=> ClosureStatusEnum::OPEN->value,
			]);

		// Write to Log
		EventLog::event('Po', $po->id, 'delete', 'id', $po->id);
		// delete from pol
		DB::table('pols')->where('po_id', $po->id)->delete();
		$po->delete();

		return redirect()->route('pos.index')->with('success', 'Purchase Order status Updated successfully');
	}



	/**
	 * Remove the specified resource from storage.
	 */
	public function open(Po $po)
	{

		$this->authorize('open',$po);
		//$po_id= $request->input('po_id');

		if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
			return back()->withError("Only APPROVED Purchase Order can be Opened!")->withInput();
		}

		if ($po->status <> ClosureStatusEnum::CLOSED->value) {
			return back()->withError("Only Closed Purchased Order can be Opened!")->withInput();
		}

		// PO status update
		$po->status = ClosureStatusEnum::OPEN->value;
		$po->save();

		// Write to Log
		EventLog::event('po', $po->id, 'open', 'id', $po->id);

		return redirect()->route('pos.index')->with('success', 'Purchase Order Opened successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function close(Po $po)
	{

		$this->authorize('close', $po);
		//$po_id= $request->input('po_id');


		if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
			return back()->withError("Only APPROVED Purchase Order can be closed!")->withInput();
		}

		if ($po->status <> ClosureStatusEnum::OPEN->value) {
			return back()->withError("Only OPEN Purchased Order can be closed!")->withInput();
		}

		// PO status update
		$po->status = ClosureStatusEnum::CLOSED->value;
		$po->save();

		return redirect()->route('pos.index')->with('success', 'Purchase Order Force Closed successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(Po $po)
	{

		$this->authorize('cancel',Po::class);
		//$po_id= $request->input('po_id');

		$po_id = $po->id;

		try {
			$po = Po::where('id',$po_id )->firstOrFail();

			if ($po->auth_status == AuthStatusEnum::DRAFT->value) {
				//return redirect()->route('pos.cancel')->with('error', 'Please delete DRAFT Requisition if needed!');
				return back()->withError("Please delete DRAFT Purchase Order if needed!")->withInput();
			}

			if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
				return back()->withError("Only APPROVED Purchase Order can be canceled!!")->withInput();
				//return redirect()->route('pos.cancel')->with('error', 'Only APPROVED Purchase Requisition can be canceled!');
			}

			// Check payment exists
			if ($po->amount_invoice <> 0 ) {
				return back()->withError("Invoice exists for this PO. Can not cancel!!")->withInput();
				//return redirect()->route('pos.cancel')->with('error', 'Payment exists for this PO. Can not cancel!');
			}

			// Check payment exists
			if ($po->amount_paid <> 0 ) {
				return back()->withError("Payment exists for this PO. Can not cancel!!")->withInput();
				//return redirect()->route('pos.cancel')->with('error', 'Payment exists for this PO. Can not cancel!');
			}

			// Check receipts exists
			$received_qty		= Pol::where('po_id',$po_id)->sum('received_qty');
			if ($received_qty <> 0 ) {
				return back()->withError("Receipt exists for this PO. Can not cancel!")->withInput();
				//return redirect()->route('pos.cancel')->with('error', 'Receipt exists for this PO. Can not cancel!');
			}

			// Reverse Approve Budget
			$retcode = PoBudget::poBudgetApproveCancel($po_id);
			Log::debug(tenant('id').' tenant.po.cancel retcode = '.$retcode);

			// Cancel All PO Lines
			Pol::where('po_id',$po_id)
				->update([
					'prl_id' 			=> NULL,
					'price' 			=> 0,
					'sub_total' 		=> 0,
					'tax' 				=> 0,
					'gst' 				=> 0,
					'amount' 			=> 0,
					'fc_sub_total' 		=> 0,
					'fc_tax' 			=> 0,
					'fc_price' 			=> 0,
					'fc_amount' 		=> 0,
					'fc_grs_price' 		=> 0,
					'closure_status' 	=> ClosureStatusEnum::CANCELED->value
				]);

			// Cancel PO
			Po::where('id', $po->id)
				->update([
					'sub_total' 	=> 0,
					'tax' 			=> 0,
					'gst' 			=> 0,
					'amount' 		=> 0,
					'fc_sub_total' 	=> 0,
					'fc_tax' 		=> 0,
					'fc_gst' 		=> 0,
					'fc_amount' 	=> 0,
					'status' 		=> ClosureStatusEnum::CANCELED->value
				]);

			// mark all source PR as non converted to PO and make it open
			Log::debug(tenant('id'). ' tenant.po.cancel marking source PR as open for po_id='.$po->id);
			Pr::where('po_id', $po->id)
				->update([
					'po_id' 	=> null,
					'status'	=> ClosureStatusEnum::OPEN->value,
				]);

			// Write to Log
			EventLog::event('po', $po->id, 'cancel', 'id', $po->id);

			return redirect()->route('pos.index')->with('success', 'Purchase Order canceled successfully.');

		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("PO #".$po_id." not Found!")->withInput();
		}
	}


	/**
	 * Display a listing of the resource.
	 */
	public function myPo()
	{

		$pos = Po::query();
		if (request('term')) {
			$pos->where('summary', 'LIKE', '%' . request('term') . '%');
		}
		//$pos = $pos->ByBuyerAll()->with("requestor")->with("dept")->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
		$pos = $pos->ByBuyerAll()->with("buyer")->with("dept")->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.pos.my-pos', compact('pos'));
	}

	public function submit(Po $po)
	{
		$this->authorize('submit', $po);

		if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('pos.show',$po->id)->with('error', 'You can only submit if the status is '. strtoupper(AuthStatusEnum::DRAFT->value) .' !');
		}

		// only buyer can submit PO
		if ( ! auth()->user()->isBuyer() ) {
			return redirect()->route('pos.show',$po->id)->with('error', 'Only a Buyer Can submit a Purchase Order for Approval!');
		}

		if ($po->buyer_id <> auth()->user()->id) {
			return redirect()->route('pos.show',$po->id)->with('error', 'You can only submit Purchase Orders created by you!');
		}

		if ($po->amount == 0) {
			return redirect()->route('pos.show',$po->id)->with('error', 'You cannot submit zero value Purchase Order!');
		}

		// check if approval hierarchy exists and is valid
		$dept = Dept::where('id', $po->dept_id)->first();
		try {
			$hierarchy		= Hierarchy::where('id', $dept->po_hierarchy_id)->firstOrFail();
			$hierarchy_id   = $hierarchy->id;
		} catch (Exception $e) {
			Log::error("tenant.po.submit Hierarchy find error for po_id= ".$po->id ." dept_id = ".$dept->id);
			return redirect()->route('prs.show',$po->id)->with('error', 'Approval Hierarchy not found! Please assign approval Hierarchy for dept!');
		}

		// check if approval hierarchy lines exists and is valid
		$hl_count	= Hierarchyl::where('hid',$hierarchy_id)->count();
		if ( $hl_count == 0){
			return redirect()->route('pos.show',$po->id)->with('error', 'No Approver found in Approval Hierarchy ' . $hierarchy->name . '! Please assign approver first.');
		}

		Log::debug('tenant.po.submit submitting po_id = ' . $po->id);

		// check if budget created and set dept_budget_id
		// check if budget for this year exists
		$fy = Carbon::now()->format('Y');
		try {
			$budget = Budget::where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			return redirect()->route('pos.index')->with('error', 'Budget is not defined for '.$fy.'. Please open this years budget and try again.');
		}

		if ($budget->closed) {
			return redirect()->route('pos.show', $po->id)->with('error', 'Budget for this period is closed! You can not submit new PO for approval!');
		}

		// check if dept_budget for this year exists then update dept_budget_id column
		try {
			$dept_budget = DeptBudget::primary()
				->where('budget_id', $budget->id)
				->where('dept_id', $po->dept_id)
				->firstOrFail();
			$po->dept_budget_id = $dept_budget->id;
			$po->save();
		} catch (ModelNotFoundException $exception) {
			//Log::debug("Inside ModelNotFoundException");
			return redirect()->route('pos.index')->with('error', 'Department Budget is not defined for FY'.$fy.'. Please add budget and try again.');
		}

		if ($dept_budget->closed) {
			return redirect()->route('pos.index')->with('error', 'Department budget is closed!. Will Need to open it for any transaction.');
		}

		// 	Populate functional currency values
		$result = Po::syncPoValues($po->id);
		if ( $result == '' ) {
			Log::debug('tenant.po.submit syncPoValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			return redirect()->route('pos.show', $po->id)->with('error', $customError->message.' Please Try later.');
		}

		// Check and book Budget
		$retcode = PoBudget::poBudgetBook($po->id);
		if ( $retcode <> '' ){
			try {
				$customError = CustomError::where('code', $retcode)->firstOrFail();
				Log::warning(tenant('id'). 'tenant.pos.submit Error during Submission error_code = '. $retcode);
				return redirect()->back()->with('error', $customError->message);
			} catch (ModelNotFoundException $exception) {
				// Error code not found!
				Log::error(tenant('id'). 'tenant.pos.submit ModelNotFoundException. Error code not found for po_id = '.$po->id.' error_code = '. $retcode);
				return redirect()->back()->with('error', 'Error-E000');
			}
		} else {
			// Submission Success
			Log::debug('tenant.pos.submit Submission okay for po_id = '. $po->id);
		}

		// Submit for approval
		Log::debug("tenant.po.submit creating new workflow for po_id = ".$po->id);
		$wf_id = Workflow::submitWf(EntityEnum::PO->value, $po->id);
		if ($wf_id == 0) {
			Log::error(tenant('id'). 'tenant.po.submit Error creating new workflow for po_id = !'.$po->id);
			return redirect()->route('pos.index')->with('error', 'Workflow can not be created! Failed to Submit.');
		}

		//Update back po WF id and status
		Log::debug("tenant.po.submit updating back po wf_id and status for po_id=".$po->id);
		$po->wf_id = $wf_id;
		$po->auth_status = AuthStatusEnum::INPROCESS->value;
		$po->submission_date = Carbon::now();
		$po->update();
		EventLog::event('po', $po->id, 'submit');	// Write to Log

		// Send notification to Po Buyer
		$action = WflActionEnum::SUBMITTED->value;
		$actionURL = route('pos.show', $po->id);
		$buyer = User::where('id', $po->buyer_id)->first();
		$buyer->notify(new PoActions($buyer, $po, $action, $actionURL));

		// Send notification to Next Approver
		$action = WflActionEnum::DUE->value;
		$actionURL = route('pos.show', $po->id);
		$due_approver_id = Workflow::getDueApproverId($po->wf_id);
		Log::debug("tenant.po.submit next_approver_id = ". $due_approver_id);
		if ($due_approver_id <> '') {
			$approver = User::where('id', $due_approver_id)->first();
			$approver->notify(new PoActions($approver, $po, $action, $actionURL));
		} else {
			Log::debug("tenant.po.submit next_approver_id not found!");
		}

		return redirect()->route('pos.show', $po->id)->with('success', 'Workflow #'.$wf_id.' created. Purchase Order submitted for approval successfully.');
	}

	public function duplicate(Po $po)
	{

		$this->authorize('duplicate', Po::class);

		$sourcePo = Po::where('id', $po->id)->first();
		$po				= new Po;

		// don't set dept_budget_id . It will be save during submissions
		// Populate Function currency amounts during submit
		$po->summary			= $sourcePo->summary;
		$po->po_date			= now();
		$po->buyer_id			= auth()->user()->id;

		// Only buyer can copy dont change requestor and dept
		$po->requestor_id	= $sourcePo->requestor_id;
		$po->dept_id		= $sourcePo->dept_id;

		$po->need_by_date		= $sourcePo->need_by_date;
		$po->project_id			= $sourcePo->project_id;
		$po->supplier_id		= $sourcePo->supplier_id;
		$po->notes				= $sourcePo->notes;
		$po->currency			= $sourcePo->currency;

		$po->sub_total			= $sourcePo->sub_total;
		$po->tax				= $sourcePo->tax;
		$po->gst				= $sourcePo->gst;
		$po->amount				= $sourcePo->amount;
		$po->fc_currency		= $sourcePo->fc_currency;

		$po->status				= ClosureStatusEnum::OPEN->value;
		$po->auth_status		= AuthStatusEnum::DRAFT->value;
		$po->save();
		$po_id					= $po->id;

		// copy lines into pols
		$sql= "INSERT INTO pols(
			po_id, line_num, item_description, item_id, uom_id,
			qty, price, sub_total, tax, gst, amount, notes,
			requestor_id, dept_id, unit_id, project_id, closure_status )
		SELECT ".
			$po->id.",line_num, item_description, item_id, uom_id,
			qty, price, sub_total, tax, gst, amount, notes,
			requestor_id, dept_id, unit_id, project_id, '".ClosureStatusEnum::OPEN->value."'
			FROM pols WHERE
			po_id= ".$sourcePo->id." ;";
		DB::INSERT($sql);

		Log::debug('tenant.po.copy New PO created = ' . $po->id);
		EventLog::event('po', $po->id, 'copied','id', $sourcePo->id);	// Write to Log

		return redirect()->route('pos.show', $po->id)->with('success', 'New Purchase Order #'.$po_id.' created.');
	}

	public function recalculate(Po $po)
	{

		$this->authorize('recalculate', Po::class);

		if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('pos.show', $po->id)->with('error', 'Only DRAFT Purchase Order can be recalculated!');
		}

		$po = Po::where('id', $po->id)->get()->firstOrFail();
		// TODO requestor_id don't reset why?

		// 	update PP Header value
		DB::statement("set @sequenceNumber=0");

		DB::statement("UPDATE pols SET
				line_num	= (@sequenceNumber:=@sequenceNumber + 1),
				dept_id		= ".$po->dept_id.",
				sub_total	= qty * price,
				amount		= qty * price + tax +gst
				WHERE po_id = ".$po->id."");

		$result = Po::syncPoValues($po->id);
		Log::debug('tenant.PoController.recalculate Return value of Po->syncPoValues = ' . $result);
		if ($result == '') {
			return redirect()->route('pos.show', $po->id)->with('success', 'PO Line Numbers updated and Amount Recalculated!');
		} else {
			$customError = CustomError::where('code', $result)->first();
			return redirect()->route('pos.show', $po->id)->with('error', $customError->message.' Please Try later.');
		}

	}

	public function exportForSupplier($supplier_id)
	{
		$this->authorize('export', Po::class);
		return self::export($supplier_id,null,null);
	}
	public function exportForProject($project_id)
	{
		$this->authorize('export', Po::class);
		return self::export(null, $project_id,null);
	}

	public function exportForBuyer($buyer_id)
	{
		$this->authorize('export', Po::class);
		return self::export(null, null,$buyer_id);
	}


	public function export($supplier_id = null, $project_id = null, $buyer_id = null)
	{
		$this->authorize('export', Po::class);

		if ($supplier_id <> null) {
			$whereSupplier = 'po.supplier_id = '. $supplier_id;
		} else {
			$whereSupplier = '1 = 1';
		}
		if ( $project_id <> null ) {
			$whereProject = 'po.project_id = '. $project_id;
		} else {
			$whereProject = '1 = 1';
		}

		if ( $buyer_id <> null ) {
			$whereBuyer = 'po.buyer_id = '. $buyer_id;
		} else {
			$whereBuyer = '1 = 1';
		}

		if (auth()->user()->role->value == UserRoleEnum::USER->value ){
			$whereRequestor = 'po.requestor_id = '. auth()->user()->id;
		} else {
			$whereRequestor = '1 = 1';
		}

		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			//$dept_id 	= auth()->user()->dept_id;
			$whereDept = 'po.dept_id = '. auth()->user()->dept_id;
		} else {
			$whereDept = '1 = 1';
		}

		$sql = "
			SELECT po.id, po.summary, po.po_date, po.need_by_date, u.name requestor, d.name dept_name,p.name project_name, s.name supplier_name,
			po.notes, po.currency, po.sub_total, po.tax, po.gst, po.amount, po.status, po.auth_status, po.auth_date
			FROM pos po, depts d, projects p, suppliers s, users u
			WHERE po.dept_id=d.id
			AND po.project_id=p.id
			AND po.supplier_id=s.id
			AND po.requestor_id=u.id
			AND ". $whereRequestor ."
			AND ". $whereDept ."
			AND ". $whereSupplier ."
			AND ". $whereProject ."
			AND ". $whereBuyer ."
			ORDER BY po.id DESC	";

		$data = DB::select($sql);

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('po-lists', $dataArray);
	}

	// add attachments
	public function attach(FormRequest $request)
	{

		$this->authorize('create', Po::class);

		// allow add attachment only if status is draft
		try {
			$po = Po::where('id', $request->input('attach_po_id'))->get()->firstOrFail();
		} catch (Exception $e) {
			Log::error(tenant('id'). ' tenant.po.attach user_id = '. auth()->user()->id.' request = '. $request. ' class = '.get_class($e). ' Message = '. $e->getMessage());
			return redirect()->back()->with(['error' => 'Purchase Order not Found!']);
		}
		if ($po->auth_status <> AuthStatusEnum::DRAFT->value){
			return redirect()->route('pos.show', $po->id)->with('error', 'Add attachment is only allowed for DRAFT requisition.');
		}

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_po_id') ]);
			$request->merge(['entity'		=> EntityEnum::PO->value ]);
			$attid = FileUpload::aws($request);
			//$request->merge(['logo'	=> $fileName ]);
		}

		return redirect()->route('pos.show', $request->input('attach_po_id'))->with('success', 'File Uploaded successfully.');
	}

	public function attachments(Po $po)
	{
		$this->authorize('view', $po);

		$po = Po::where('id', $po->id)->get()->firstOrFail();
		//$attachments = Attachment::where('entity', EntityEnum::PO->value)->where('article_id', $po->id)->get()->all();
		return view('tenant.pos.attachments', compact('po'));
	}

	public function history(Po $po)
	{
		$this->authorize('view', $po);

		$po = Po::where('id', $po->id)->get()->firstOrFail();
		return view('tenant.pos.history', compact('po'));
	}

	public function ael(Po $po)
	{
		$this->authorize('view', $po);

		$po = Po::where('id', $po->id)->get()->firstOrFail();
		return view('tenant.pos.ael', compact('po'));
	}


	public function invoices(Po $po)
	{
		$this->authorize('view', $po);

		// if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
		// 	return redirect()->route('pos.show',$po->id)->with('error', 'Only APPROVED Purchase Order can have Invoices.');
		// }

		$po = Po::where('id', $po->id)->get()->firstOrFail();
		return view('tenant.pos.invoices', compact('po'));
	}


	public function payments(Po $po)
	{
		$this->authorize('view', $po);

		// if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
		// 	return redirect()->route('pos.show',$po->id)->with('error', 'Only APPROVED Purchase Order can have Invoices.');
		// }

		$po = Po::where('id', $po->id)->get()->firstOrFail();
		return view('tenant.pos.payments', compact('po'));
	}


	/**
	 * Display the specified resource.
	 */
	public function extra(Po $po)
	{
		$this->authorize('view', $po);

		return view('tenant.pos.extra', compact('po'));
	}

	// used in pol dropdown ajax
	public function getPo($poId = 0)
	{
		// lwc
		//http://demo1.localhost:8000/pos/get-po/1005
		//$data = [];
		//$data = Po::select('id','summary','amount','currency','supplier_id')->with('supplier:id,name')->where('id', $poId)->first();
		//Log::debug('Value of data=' . $data);
		//return response()->json($data);

		$sql = "
			SELECT  p.id po_id, p.currency,
			p.summary po_summary, DATE_FORMAT(p.po_date,'%d-%b-%Y') po_date, FORMAT(p.amount,2) po_amount,p.currency po_currency,
			d.name dept_name,prj.name project_name, u.name buyer_name,
			s.name supplier_name
			FROM pos p, suppliers s, depts d, projects prj, users u
			WHERE 1=1
			AND p.supplier_id = s.id
			AND p.dept_id = d.id
			AND p.project_id = prj.id
			AND p.buyer_id = u.id
			AND p.id = '".$poId."'
		";

		$result = DB::selectOne($sql);
		return response()->json([
			'po_id'   		=> $result->po_id,
			'po_currency'	=> $result->currency,
			'po_summary'	=> $result->po_summary,
			'po_date' 		=> $result->po_date,
			'po_amount' 	=> $result->po_amount,
			'dept_name' 	=> $result->dept_name,
			'project_name'	=> $result->project_name,
			'buyer_name'	=> $result->buyer_name,
			'supplier_name'	=> $result->supplier_name
		]);

	}
}
