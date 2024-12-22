<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			PrController.php
* @brief		This file contains the implementation of the PrController
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

use App\Models\Tenant\Pr;
use App\Http\Requests\Tenant\StorePrRequest;
use App\Http\Requests\Tenant\UpdatePrRequest;

# 1. Models
use App\Models\Tenant\Po;
use App\Models\User;

use App\Models\Tenant\Prl;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;

use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Manage\CustomError;
//use App\Models\Tenant\Attachment;
//use App\Models\Tenant\Manage\Status;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Lookup\Category;

use App\Models\Tenant\Workflow\Hierarchy;
use App\Models\Tenant\Workflow\Hierarchyl;


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
use App\Helpers\Tenant\PrBudget;
use App\Helpers\Tenant\ExchangeRate;
# 4. Notifications
use Notification;
use App\Notifications\Tenant\PrActions;
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

# 9. Exceptions
# 10. Events
# 11. Controller
use App\Http\Controllers\Tenant\DeptBudgetControllers;
# 12. Seeded
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
# 13. FUTURE


class PrController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{

		$prs = Pr::query();
		if (request('term')) {
			$prs->where('summary', 'LIKE', '%' . request('term') . '%')
			->orWhere('id', 'Like', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:
				$prs = $prs->ByUserAll()->with('requestor')->with('dept')->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::HOD->value:
				$prs = $prs->ByDeptAll()->with('requestor')->with('dept')->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
				$prs = $prs->AllApproved()->with('requestor')->with('dept')->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
				$prs = $prs->AllApproved()->with('requestor')->with('dept')->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::SYSTEM->value:
				//->with('status_badge')
				//->with('auth_status_badge')
				//$prs = $prs->with("requestor")->with("dept")->with('status_badge')->with('auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				$prs = $prs->with('requestor')->with('dept')->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);

				break;
			default:
				$prs = $prs->ByUserAll()->paginate(10);
				Log::warning(tenant('id'). 'tenant.pr.index Other role = '. auth()->user()->role->value);
		}

		return view('tenant.prs.index', compact('prs'));
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Pr::class);

		$setup 	= Setup::first();
		if ($setup->readonly ){
			return redirect()->route('dashboards.index')->with('error', config('akk.MSG_READ_ONLY'));
		}

		$depts		= Dept::primary()->get();
		$items 		= Item::primary()->get();
		$suppliers 	= Supplier::primary()->get();
		$projects 	= Project::primary()->get();
		$uoms 		= Uom::primary()->get();
		$categories	= Category::primary()->get();

		return view('tenant.prs.create', compact('suppliers', 'depts', 'items','uoms', 'projects','categories'));

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StorePrRequest $request)
	{
		$this->authorize('create', Pr::class);
		$setup = Setup::first();
		// create PR with zero value and then update
		// don't set dept_budget_id . It will be save during submissions

		$request->merge(['status'		=> ClosureStatusEnum::OPEN->value ]);
		$request->merge(['auth_status'	=> AuthStatusEnum::DRAFT->value]);
		$request->merge(['requestor_id'	=> 	auth()->user()->id ]);
		$request->merge(['pr_date'		=> date('Y-m-d H:i:s')]);
		$request->merge(['fc_currency'	=> $setup->currency]);

		// as this is the first line pr value will be same as prl values
		$request->merge(['sub_total'	=> $request->input('qty') * $request->input('price')]);
		$request->merge(['tax'			=> $request->input('tax')]);
		$request->merge(['gst'			=> $request->input('gst')]);
		$request->merge(['amount'		=> ($request->input('qty')*$request->input('price'))+$request->input('tax')+ $request->input('gst') ]);

		// User and HoD Can create only own department PR
		if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value ) {
			$request->merge(['dept_id'		=> auth()->user()->dept_id]);
		}

		$pr = Pr::create($request->all());
		// Write to Log
		EventLog::event('pr', $pr->id, 'create');

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $pr->id ]);
			$request->merge(['entity'		=> EntityEnum::PR->value ]);
			$attid = FileUpload::aws($request);
		}

		// create prl lines line with line number
		$prl			= new Prl();
		$prl->pr_id		= $pr->id;
		$prl->line_num	= 1;
		$prl->item_id	= $request->input('item_id');
		$prl->uom_id	= $request->input('uom_id');
		$prl->item_description	= $request->input('item_description');
		$prl->qty		= $request->input('qty');
		$prl->price		= $request->input('price');

		$prl->sub_total	= $request->input('qty') * $request->input('price');
		$prl->tax		= $request->input('tax');
		$prl->gst		= $request->input('gst');
		$prl->amount	= ($request->input('qty') * $request->input('price')) +$request->input('tax')+$request->input('gst');

		$prl->save();
		$prl_id			= $prl->id;

		// 	Update PR Header value and Populate functional currency values
		$result = Pr::syncPrValues($pr->id);
		if ($result == '') {
			Log::debug('tenant.pr.store syncPrValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.pr.store syncPrValues pr_id = '.$pr->id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}

		if($request->has('add_row')) {
			//Checkbox checked
			return redirect()->route('prls.add-line', $pr->id)->with('success', 'PR #'. $pr->id.' created successfully. Please add more line.');
		} else {
			//Checkbox not checked
			return redirect()->route('prs.show', $pr->id)->with('success', 'PR #'. $pr->id.' created successfully.');
		}

		// switch ($request->input('action')) {
		// 	case 'save':
		// 		return redirect()->route('prs.show', $pr->id)->with('success', 'PR #'. $pr->id.' created successfully.');
		// 		break;
		// 	case 'save_add':
		// 		return redirect()->route('prls.add-line', $pr->id)->with('success', 'PR #'. $pr->id.' created successfully. Please add more line.');
		// 		break;
		// }
	}




	/**
	 * Display the specified resource.
	 */
	public function show(Pr $pr)
	{
		$this->authorize('view', $pr);

		$prls = Prl::with("item")->with("uom")->where('pr_id', $pr->id)->get()->all();

		// approve-reject form
		if ($pr->auth_status == AuthStatusEnum::INPROCESS->value) {
			try {
				$wfl = Wfl::where('wf_id', $pr->wf_id)->where('action', WflActionEnum::PENDING->value)->where('performer_id', auth()->user()->id)->firstOrFail();
			} catch (ModelNotFoundException $exception) {
				$wfl = "";
				Log::debug("tenant.pr.show: Okay. Not pending with current user.");
			}
		} else {
			$wfl = "";
		}
		return view('tenant.prs.show', compact('pr', 'prls', 'wfl'));
	}


	/**
	 * Display the specified resource.
	 */
	public function timestamp(Pr $pr)
	{
		$this->authorize('view', $pr);

		return view('tenant.prs.timestamp', compact('pr'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Pr $pr)
	{

		// if ($pr->auth_status <> AuthStatusEnum::DRAFT->value) {
		// 	return redirect()->route('prs.show',$pr->id)->with('error', 'You can not edit a Requisition with status '. strtoupper($pr->auth_status) .' !');
		// }

		$this->authorize('update', $pr);

		$depts		= Dept::primary()->get();

		$suppliers 	= Supplier::primary()->get();
		$projects 	= Project::primary()->get();
		$users 		= User::tenant()->get();
		$categories	= Category::primary()->get();

		$prls = Prl::with('item')->with('uom')->where('pr_id', $pr->id)->get()->all();

		return view('tenant.prs.edit', compact('pr','prls', 'suppliers', 'depts', 'projects', 'users','categories'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePrRequest $request, Pr $pr)
	{
		$this->authorize('update', $pr);

		Log::debug('tenant.pr.update updating pr_id = ' . $pr->id);

		// User and HoD Can not edit department PR
		if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value ) {
			$request->merge(['dept_id'		=> auth()->user()->dept_id]);
		}

		// Write to Log
		EventLog::event('pr', $pr->id, 'update', 'summary', $pr->summary);
		$pr->update($request->all());

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $pr->id ]);
			$request->merge(['entity'		=> EntityEnum::PR->value ]);
			$attid = FileUpload::aws($request);
		}

		// 	Update PR Header value and Populate functional currency values. Currency Might change
		Log::debug('tenant.pr.update calling syncPrValues for pr_id = '. $pr->id);
		$result = Pr::syncPrValues($pr->id);
		//Log::debug('tenant.pr.update syncPrValues return value = '. $result);

		if ($result == '') {
			Log::debug('tenant.pr.update syncPrValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.pr.update syncPrValues pr_id = '.$pr->id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}


		return redirect()->route('prs.show', $pr->id)->with('success', 'Purchase Requisition updated successfully.');
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Pr $pr)
	{

		//Log::debug('tenant.prs.destroy pr_id = '.$pr->id. ' auth_status = '.$pr->auth_status );
		// don't allow REJECTED to delete as it has dbu rows
		if (($pr->auth_status <> AuthStatusEnum::DRAFT->value) ) {
			return redirect()->route('prs.show', $pr->id)->with('error', 'Only DRAFT Purchase Requisition can be deleted!');
		}
		Log::debug(tenant('id'). ' tenant.pr.destroy deleting pr_id = ' . $pr->id);

		// check if allowed by policy
		$this->authorize('delete', $pr);

		// Write to Log
		EventLog::event('Pr', $pr->id, 'delete', 'id', $pr->id);
		// delete from prl
		DB::table('prls')->where('pr_id', $pr->id)->delete();
		$pr->delete();

		return redirect()->route('prs.index')->with('success', 'Purchase Requisition deleted successfully');
	}

	public function recalculate(Pr $pr)
	{
		// Update pr.line_num
		// TODO must uncomment
		// $this->authorize('recalculate', $pr);

		if ($pr->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('prs.show', $pr->id)->with('error', 'Only DRAFT Purchase Requisition can be recalculated!');
		}

		Log::debug(tenant('id'). ' tenant.pr.recalculate recalculating pr_id = ' . $pr->id);

		// 	update PR Header value
		DB::statement("set @sequenceNumber=0");

		DB::statement("UPDATE prls SET
				line_num	= (@sequenceNumber:=@sequenceNumber + 1),
				sub_total	= qty * price,
				amount		= qty * price + tax + gst
				WHERE pr_id = ".$pr->id."");

		Log::debug(tenant('id'). ' tenant.pr.recalculate calling syncPrValues for pr_id = '. $pr->id);
		$result = Pr::syncPrValues($pr->id);

		if ($result == '') {
			Log::debug(tenant('id'). ' tenant.PrController.recalculate Pr->syncPrValues Successful');
			return redirect()->route('prs.show', $pr->id)->with('success', 'PR Line Numbers updated and Amount Recalculated!');
		} else {
			Log::error(tenant('id'). ' tenant.PrController.recalculate for pr_id = '.$pr->id.' Return value of Pr->syncPrValues = ' . $result);
			$customError = CustomError::where('code', $result)->first();
			return redirect()->route('prs.show', $pr->id)->with('error', $customError->message.' Please Try later.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(Pr $pr)
	{

		$pr_id = $pr->id;
		Log::debug(tenant('id'). ' tenant.pr.cancel cancelling pr_id = ' . $pr_id);

		try {
			$pr = Pr::where('id', $pr_id)->firstOrFail();

			if ($pr->auth_status == AuthStatusEnum::DRAFT->value) {
				return back()->withError("Can not cancel a DRAFT Requisition. Please delete this DRAFT Requisitions, if needed!")->withInput();
				//return redirect()->route('prs.cancel')->with('error', 'Please delete DRAFT Requisition if needed!');
			}

			if ($pr->auth_status <> AuthStatusEnum::APPROVED->value) {
				return back()->withError("Only APPROVED Purchase Requisition can be canceled!")->withInput();
				//return redirect()->route('prs.cancel')->with('error', 'Only APPROVED Purchase Requisition can be canceled!');
			}

			if ($pr->po_id <> 0 ) {
				return back()->withError('This Requisition is already converted to PO #'.$pr->po_id.'. Requisition can not be canceled.')->withInput();
				//return redirect()->route('prs.cancel')->with('error', 'This Requisition is already converted to PO#'.$pr->po_id.'. Requisition can not be canceled.');
			}

			// check if allowed by policy
			$this->authorize('cancel', $pr);

			// Reverse Booking
			Log::debug(tenant('id'). ' tenant.pr.cancel calling PrBudget::prBudgetApproveCancel ...');
			$retcode = PrBudget::prBudgetApproveCancel($pr_id);
			Log::debug(tenant('id'). ' tenant.pr.cancel retcode = '.$retcode);

			// Cancel All PR Lines
			Log::debug(tenant('id'). ' tenant.pr.cancel cancelling all prl lines ...');
			Prl::where('pr_id', $pr_id)
				->update([
					'price' 			=> 0,
					'sub_total' 		=> 0,
					'tax' 				=> 0,
					'gst' 				=> 0,
					'amount' 			=> 0,
					'fc_sub_total' 		=> 0,
					'fc_tax' 			=> 0,
					'price' 			=> 0,
					'fc_amount' 		=> 0,
					'closure_status'	=> ClosureStatusEnum::CANCELED->value
					]);

			// cancel PR
			Log::debug(tenant('id'). ' tenant.pr.cancel cancelling pr line ...');
			Pr::where('id', $pr_id)
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

			// Write to Log
			EventLog::event('Pr', $pr->id, 'cancel', 'id', $pr->id);

			return redirect()->route('prs.index')->with('success', 'Purchase Requisition canceled successfully.');

		} catch (ModelNotFoundException $exception) {
			// Error handling code

			Log::warning(tenant('id').' tenant.prs.cancel PR#'.$pr->id.' not Found!');
			return back()->withError("PR #".$pr_id." not Found!")->withInput();
		}
	}


	public function submit(Pr $pr)
	{

		$this->authorize('submit', $pr);

		if ($pr->amount == 0) {
			return redirect()->route('prs.show',$pr->id)->with('error', 'You cannot submit zero value Requisition.');
		}

		// if ($pr->dept_id <> auth()->user()->dept_id) {
		// 	return redirect()->route('prs.show',$pr->id)->with('error', 'You can only submit own department Requisition!');
		// }

		if ($pr->requestor_id <> auth()->user()->id) {
			return redirect()->route('prs.show',$pr->id)->with('error', 'You can only submit own Requisition!');
		}
		Log::debug(tenant('id'). ' tenant.pr.submit submitting pr_id = ' . $pr->id);

		// check if approval hierarchy exists and is valid
		$dept = Dept::where('id', $pr->dept_id)->first();
		try {
			$hierarchy		= Hierarchy::where('id', $dept->pr_hierarchy_id)->firstOrFail();
			$hierarchy_id	= $hierarchy->id;
		} catch (Exception $e) {
			Log::error("tenant.pr.submit Hierarchy find error for pr_id= ".$pr->id ." dept_id = ".$dept->id);
			return redirect()->route('prs.show',$pr->id)->with('error', 'Approval Hierarchy not found! Please assign approval Hierarchy for dept!');
		}

		// check if approval hierarchy lines exists and is valid
		$hl_count	= Hierarchyl::where('hid',$hierarchy_id)->count();
		//Log::error("tenant.pr.submit hl_count = ".$hl_count);
		if ( $hl_count == 0){
			return redirect()->route('prs.show',$pr->id)->with('error', 'No Approver found in Approval Hierarchy ' . $hierarchy->name . '! Please assign approver first.');
		}

		// generate fc_currency value and check budget
		// check if budget created and set dept_budget_id
		// check if budget for this year exists
		$fy = Carbon::now()->format('Y');
		try {
			$budget = Budget::where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			return redirect()->route('prs.index')->with('error', 'Budget is not defined for '.$fy.'. Please open this years budget and try again');
		}
		Log::debug(tenant('id'). ' tenant.pr.submit budget defined budget_id = ' . $budget->id);

		if ($budget->closed) {
			return redirect()->route('prs.show', $pr->id)->with('error', 'Budget for this period is freezed! You can not submit new PR for approval!');
		}
		Log::debug(tenant('id'). ' tenant.pr.submit budget is open budget_id = ' . $budget->id);

		// check if dept_budget for this year exists then update dept_budget_id column
		try {
			$dept_budget = DeptBudget::where('budget_id', $budget->id)
				->where('dept_id', $pr->dept_id)
				->firstOrFail();
			$pr->dept_budget_id = $dept_budget->id;
			$pr->save();
			Log::debug(tenant('id'). ' tenant.pr.submit PR dept_budget_id updated with dept_budget = ' . $dept_budget->id);

		} catch (ModelNotFoundException $exception) {
			Log::warning(tenant('id').' tenant.prs.submit ModelNotFoundException. DeptBudget not found for budget_id= '. $budget->id);
			return redirect()->route('prs.index')->with('error', 'Department Budget is not defined for FY'.$fy.'. Please add budget and try again');
		}

		if ($dept_budget->closed) {
			return redirect()->route('prs.index')->with('error', 'Department budget is closed!. Will Need to open it for any transaction.');
		}
		Log::debug('tenant.pr.submit DeptBudget is open dept_budget_id = ' . $dept_budget->id);

		// 	Populate functional currency values
		Log::debug(tenant('id'). ' tenant.pr.submit calling syncPrValues for pr_id = '. $pr->id);
		$result = Pr::syncPrValues($pr->id);

		if ($result == '') {
			Log::debug(tenant('id'). ' tenant.pr.submit syncPrValues completed.');
		} else {
			Log::error(tenant('id'). 'tenant.PrController.submit Return value of pr_id = '.$pr->id.' Pr->syncPrValues = ' . $result);
			$customError = CustomError::where('code', $result)->first();
			return redirect()->route('prs.show', $pr->id)->with('error', $customError->message.' Please Try later.');
		}


		// Check and book Dept Budget
		Log::debug(tenant('id'). ' tenant.pr.submit booking budget by PrBudget::prBudgetBook...');
		$retcode = PrBudget::prBudgetBook($pr->id);

		if ( $retcode <> '' ){
			try {
				Log::warning(tenant('id').' tenant.prs.submit Error for pr_id = '.$pr->id.'during prBudgetBook error_code = '. $retcode);
				$customError = CustomError::where('code', $retcode)->firstOrFail();
				return redirect()->back()->with('error', $customError->message);
			} catch (ModelNotFoundException $exception) {
				// Error code not found!
				Log::error(tenant('id').' tenant.prs.submit ModelNotFoundException. prBudgetBook Error code pr_id = '.$pr->id.' not found error_code = '. $retcode);
				return redirect()->back()->with('error', 'Error-E000');
			}
		} else {
			// Submission Success
			Log::debug(tenant('id'). ' tenant.prs.submit prBudgetBook okay for pr_id = '. $pr->id);
		}

		// Submit for approval
		Log::debug(tenant('id'). ' tenant.pr.submit submitting in Workflow::submitWf ...');
		$wf_id = Workflow::submitWf(EntityEnum::PR->value, $pr->id);
		if ($wf_id == 0) {
			Log::error(tenant('id').' tenant.prs.submit Workflow::submitWf failed for pr_id = '.$pr->id);
			return redirect()->route('prs.index')->with('error', 'Workflow can not be created! Failed to Submit.');
		}

		//Update back pr wf_id and status
		Log::debug(tenant('id'). ' tenant.pr.submit updating pr wf_id and status ...');
		$pr->wf_id = $wf_id;
		$pr->auth_status = AuthStatusEnum::INPROCESS->value;
		$pr->submission_date = Carbon::now();
		$pr->update();
		EventLog::event('pr', $pr->id, 'submit');	// Write to Log

		// Send notification to Pr creator
		$action = WflActionEnum::SUBMITTED->value;
		$actionURL = route('prs.show', $pr->id);
		$requestor = User::where('id', $pr->requestor_id)->first();
		Log::debug(tenant('id'). ' tenant.pr.submit notifying submitter user_id = ' . $requestor->id);
		$requestor->notify(new PrActions($requestor, $pr, $action, $actionURL));

		// Send notification to Next Approver
		$action = WflActionEnum::DUE->value;
		$actionURL = route('prs.show', $pr->id);
		$due_approver_id = Workflow::getDueApproverId($pr->wf_id);
		Log::debug(tenant('id'). ' tenant.pr.submit notifying next_approver_id = '. $due_approver_id);
		if ($due_approver_id <> '') {
			$approver = User::where('id', $due_approver_id)->first();
			$approver->notify(new PrActions($approver, $pr, $action, $actionURL));
		} else {
			Log::debug(tenant('id'). 'tenant.pr.submit okay. Last Approver. next_approver_id not found!');
		}


		return redirect()->route('prs.show', $pr->id)->with('success', 'Purchase Requisition submitted for approval successfully.');
	}

	public function duplicate(Pr $pr)
	{
		$this->authorize('view', $pr);

		$sourcePr = Pr::where('id', $pr->id)->first();
		$pr				= new Pr;

		// don't set dept_budget_id . It will be save during submissions
		// Populate Function currency amounts during submit
		$pr->summary			= $sourcePr->summary;
		$pr->pr_date			= now();

		// For User and Hod change requestor and dept to on
		// For everyone change requestor and dept to own
		$pr->requestor_id	= auth()->user()->id;
		$pr->dept_id		= auth()->user()->dept_id;
		// if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value ) {
		// } else {
		// 	$pr->requestor_id	= $sourcePr->requestor_id;
		// 	$pr->dept_id		= $sourcePr->dept_id;
		// }

		$pr->need_by_date		= $sourcePr->need_by_date;
		$pr->project_id			= $sourcePr->project_id;
		$pr->category_id	 	= $sourcePr->category_id;
		$pr->supplier_id		= $sourcePr->supplier_id;
		$pr->notes				= $sourcePr->notes;
		$pr->currency			= $sourcePr->currency;

		$pr->sub_total			= $sourcePr->sub_total;
		$pr->tax				= $sourcePr->tax;
		$pr->gst				= $sourcePr->gst;
		$pr->amount				= $sourcePr->amount;
		$pr->fc_currency		= $sourcePr->fc_currency;
		//$pr->fc_exchange_rate	= $sourcePr->fc_exchange_rate;
		//$pr->fc_amount			= $sourcePr->fc_amount;
		$pr->status				= ClosureStatusEnum::OPEN->value;
		$pr->auth_status		= AuthStatusEnum::DRAFT->value;
		$pr->save();
		$pr_id					= $pr->id;

		// copy lines into prls
		$sql= "INSERT INTO prls(
				pr_id, line_num, item_description, item_id, uom_id, notes, qty, price, sub_total, tax, gst, amount, closure_status )
		SELECT ".
				$pr->id.",line_num, item_description, item_id, uom_id, notes, qty, price, sub_total, tax, gst, amount, '".ClosureStatusEnum::OPEN->value."'
		FROM prls WHERE
		pr_id= ".$sourcePr->id." ;";
		DB::INSERT($sql);

		EventLog::event('pr', $pr->id, 'copied','id', $sourcePr->id);	// Write to Log

		return redirect()->route('prs.show', $pr->id)->with('success', 'New Purchase Requisition #'.$pr_id.' created.');
	}

	public function convertPo(Pr $pr)
	{
		$this->authorize('convert', $pr);

		if ($pr->auth_status <> AuthStatusEnum::APPROVED->value) {
			return redirect()->route('prs.show',$pr->id)->with('error', 'You can only convert Approved Requisition to Purchase Order!');
		}

		if ($pr->po_id <> 0) {
			return redirect()->route('prs.show',$pr->id)->with('error', 'Requisition already converted to PO#'. $pr->po_id .' !');
		}

		Log::debug('tenant.pr.convertPo Converting Requisition to PO pr_id = '.$pr->id);
		$pr = Pr::where('id', $pr->id)->first();
		// don't set dept_budget_id . It will be save during submissions
		// Populate Function currency amounts during submit
		$po					= new Po;
		$po->summary		= $pr->summary;
		$po->buyer_id		= auth()->user()->id;
		$po->po_date		= now();
		$po->need_by_date	= $pr->need_by_date;
		$po->requestor_id	= $pr->requestor_id;
		$po->dept_id		= $pr->dept_id;
		$po->unit_id		= $pr->unit_id;
		$po->project_id		= $pr->project_id;
		$po->category_id	= $pr->category_id;
		//dept_budget_id
		$po->supplier_id	= $pr->supplier_id;
		$po->notes			= $pr->notes;
		$po->currency		= $pr->currency;
		$po->fc_currency	= $pr->fc_currency;

		$po->sub_total		= $pr->sub_total;
		$po->tax			= $pr->tax;
		$po->gst			= $pr->gst;
		$po->amount			= $pr->amount;

		$po->status			= ClosureStatusEnum::OPEN->value;
		$po->auth_status	= AuthStatusEnum::DRAFT->value;
		$po->save();
		$po_id				= $po->id;

		// copy prls into pols
		$result = Pr::insertPrlsIntoPols($pr->id, $po_id);

		// update and close source PR
		$pr->po_id		= $po_id;
		$pr->status		= ClosureStatusEnum::CLOSED->value;
		$pr->save();
		Log::debug('tenant.pr.convertPo PR marked as closed pr_id = '.$pr->id);
		Log::debug('tenant.pr.convertPo Requisition Converted to po_id = '.$po_id);

		EventLog::event('po', $po->id, 'converted','id',$pr->id);	// Write to Log

		return redirect()->route('pos.show', $po_id)->with('success', 'Purchase Order #'.$po_id.' created.');
	}

	public function export()
	{

		$this->authorize('export', Pr::class);

		$fileName = 'export-prs-' . date('Ymd') . '.xls';

		//$prs = Budget::query();
		//$prs = Pr::with('dept');
		//$prs = Pr::with('dept')->with('project')->with('supplier')->with('requestor')->with('user_created_by')->with('user_updated_by');
		$prs = Pr::with('dept')->with('project')->with('supplier')->with('requestor')->with('user_created_by')->with('user_updated_by')->where('auth_status',AuthStatusEnum::APPROVED->value);
		//$pr = Pr::with('dept')->with('project')->with('supplier')->with('user_created_by')->with('user_updated_by')->get();

		if (auth()->user()->role->value == UserRoleEnum::USER->value ){
			$prs->where('requestor_id',auth()->user()->id);
		}

		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$prs->where('dept_id',auth()->user()->dept_id);
		}
		//$prs = Pr::with('dept');
		$prs = $prs->get();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// SELECT pr.id, pr.summary, pr.pr_date, pr.need_by_date, u.name requestor, d.name dept_name,p.name project_name, s.name supplier_name,
		// pr.notes, pr.currency, pr.sub_total, pr.tax, pr.gst, pr.amount, pr.status, pr.auth_status, pr.auth_date
		// FROM prs pr,depts d, projects p, suppliers s, users u

		$sheet->setCellValue('A1', 'Id');
		$sheet->setCellValue('B1', 'summary');
		$sheet->setCellValue('C1', 'pr_date');
		$sheet->setCellValue('D1', 'need_by_date');
		$sheet->setCellValue('E1', 'requestor');
		$sheet->setCellValue('F1', 'dept_name');
		$sheet->setCellValue('G1', 'project_name');
		$sheet->setCellValue('H1', 'supplier_name');
		$sheet->setCellValue('I1', 'notes');
		$sheet->setCellValue('J1', 'currency');
		$sheet->setCellValue('K1', 'sub_total');
		$sheet->setCellValue('L1', 'tax');
		$sheet->setCellValue('M1', 'gst');
		$sheet->setCellValue('N1', 'amount');
		$sheet->setCellValue('O1', 'status');
		$sheet->setCellValue('P1', 'auth_status');
		$sheet->setCellValue('Q1', 'auth_date');
		// $sheet->setCellValue('R1', 'Created By');
		// $sheet->setCellValue('S1', 'Created At');
		// $sheet->setCellValue('T1', 'Updated By');
		// $sheet->setCellValue('U1', 'Updated At');

		$rows = 2;
		foreach($prs as $pr){
			$sheet->setCellValue('A' . $rows, $pr->id);
			$sheet->setCellValue('B' . $rows, $pr->summary);
			$sheet->setCellValue('C' . $rows, $pr->pr_date);
			$sheet->setCellValue('D' . $rows, $pr->need_by_date);
			$sheet->setCellValue('E' . $rows, $pr->requestor->name);
			$sheet->setCellValue('F' . $rows, $pr->dept->name);
			$sheet->setCellValue('G' . $rows, $pr->project->name);
			$sheet->setCellValue('H' . $rows, $pr->supplier->name);
			$sheet->setCellValue('I' . $rows, $pr->notes);
			$sheet->setCellValue('J' . $rows, $pr->currency);
			$sheet->setCellValue('K' . $rows, $pr->sub_total);
			$sheet->setCellValue('L' . $rows, $pr->tax);
			$sheet->setCellValue('M' . $rows, $pr->gst);
			$sheet->setCellValue('N' . $rows, $pr->amount);
			$sheet->setCellValue('O' . $rows, $pr->status);
			$sheet->setCellValue('P' . $rows, $pr->auth_status);
			$sheet->setCellValue('Q' . $rows, $pr->auth_date);
			// $sheet->setCellValue('R' . $rows, $pr->user_created_by->name);
			// $sheet->setCellValue('S' . $rows, $pr->created_at);
			// $sheet->setCellValue('T' . $rows, $pr->user_updated_by->name);
			// $sheet->setCellValue('U' . $rows, $pr->updated_at);
			$rows++;
		}

		$writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
		$writer->save('php://output');


		// if (auth()->user()->role->value == UserRoleEnum::USER->value ){
		// 	$requestor_id 	= auth()->user()->id;
		// } else {
		// 	$requestor_id 	= '';
		// }

		// if (auth()->user()->role->value == UserRoleEnum::HOD->value){
		// 	$dept_id 	= auth()->user()->dept_id;
		// } else {
		// 	$dept_id 	= '';
		// }

		// $data = DB::select("
		// 	SELECT pr.id, pr.summary, pr.pr_date, pr.need_by_date, u.name requestor, d.name dept_name,p.name project_name, s.name supplier_name,
		// 	pr.notes, pr.currency, pr.sub_total, pr.tax, pr.gst, pr.amount, pr.status, pr.auth_status, pr.auth_date
		// 	FROM prs pr,depts d, projects p, suppliers s, users u
		// 	WHERE pr.dept_id=d.id
		// 	AND pr.project_id=p.id
		// 	AND pr.supplier_id=s.id
		// 	AND pr.requestor_id=u.id
		// 	AND ". ($dept_id <> '' ? 'pr.dept_id = '.$dept_id.' ' : ' 1=1 ') ."
		// 	AND ". ($requestor_id <> '' ? 'pr.requestor_id = '.$requestor_id.' ' : ' 1=1 ') ."
		// 	ORDER BY pr.id DESC
		// ");

		//$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		//return Export::csv('prs', $dataArray);
	}


	/**
	 * Display a listing of the resource.
	 */
	public function myPr()
	{

		$prs = Pr::query();
		if (request('term')) {
			$prs->where('summary', 'LIKE', '%' . request('term') . '%');
		}
		$prs = $prs->ByUserAll()->with("requestor")->with("dept")->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.prs.my-prs', compact('prs'));
	}

	// add attachments
	public function attach(FormRequest $request)
	{
		$this->authorize('create', Pr::class);

		// allow add attachment only if status is draft
		try {
			$pr = Pr::where('id', $request->input('attach_pr_id'))->get()->firstOrFail();
		} catch (Exception $e) {
			Log::error(tenant('id'). ' tenant.pr.attach user_id = '. auth()->user()->id.' request = '. $request. ' class = '.get_class($e). ' Message = '. $e->getMessage());
			return redirect()->back()->with(['error' => 'Requisition Not Found!']);
		}
		if ($pr->auth_status <> AuthStatusEnum::DRAFT->value){
			return redirect()->route('prs.show', $pr->id)->with('error', 'Add attachment is only allowed for DRAFT requisition.');
		}

		// $request->validate([

		// ]);
		//$request->validate(['file_to_upload'	=> 'required|file|mimes:zip,rar,doc,docx,xls,xlsx,pdf,jpg|max:512']);

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_pr_id')]);
			$request->merge(['entity'		=> EntityEnum::PR->value ]);
			$attid = FileUpload::aws($request);
		}

		//return redirect()->route('prs.show', $request->input('attach_pr_id'))->with('success', 'File Uploaded successfully.');
		return redirect()->back()->with('success', 'File Uploaded successfully.');
	}

	public function attachments(Pr $pr)
	{
		$this->authorize('view', $pr);

		$pr = Pr::where('id', $pr->id)->get()->firstOrFail();
		//$attachments = Attachment::with('owner')->where('entity', EntityEnum::PR->value)->where('article_id', $pr->id)->get();
		return view('tenant.prs.attachments', compact('pr'));
	}

	public function history(Pr $pr)
	{
		$this->authorize('view', $pr);

		$pr = Pr::where('id', $pr->id)->get()->firstOrFail();
		return view('tenant.prs.history', compact('pr'));
	}

	/**
	 * Display the specified resource.
	 */
	public function extra(Pr $pr)
	{
		$this->authorize('view', $pr);

		return view('tenant.prs.extra', compact('pr'));
	}

	/**
	 * Display the specified resource.
	 */
	public function addToPo(Pr $pr)
	{
		$this->authorize('addToPo', $pr);
		return view('tenant.prs.add-to-po', compact('pr'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function addPrLineToPo(Request $request, Pr $pr)
	{
		$this->authorize('addToPo', $pr);

		Log::debug('tenant.pr.addPrLineToPo updating pr_id = ' . $pr->id);

		// check if PR is approved
		if ($pr->auth_status <> AuthStatusEnum::APPROVED->value) {
			return back()->withErrors('YOu can only add to PO a approved Requisition.');
		}
		// if PR is open
		if ($pr->status <> ClosureStatusEnum::OPEN->value) {
			return back()->withErrors('You can only add an Open Requisition with PO.');
		}

		// if PO exists
		$po_id= $request->input('po_id');
		Log::debug('tenant.pr.addPrLineToPo entered po_id = '.$po_id);
		try {
			$po = Po::where('id', $request->input('po_id'))->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			return back()->withErrors('Invalid PO Number!');
		}

		// if PO is draft or rejected
		if (($po->auth_status <> AuthStatusEnum::DRAFT->value ) && ($po->auth_status <> AuthStatusEnum::REJECTED->value )) {
			return back()->withErrors('You can only add a Requisition with DRAFT Purchase Order!');

		}

		// check if PR supplier is same don't need to check

		// check if currency is same
		if ($pr->currency <> $po->currency ) {
			return back()->withErrors('Requisition Currency and Purchase Order Currency should be same!.');
		}

		$result = Pr::insertPrlsIntoPols($pr->id, $po->id);

		// update and close source PR
		$pr->po_id		= $po->id;
		$pr->status		= ClosureStatusEnum::CLOSED->value;
		$pr->save();

		Log::debug('tenant.pr.addPrLineToPo PR marked as closed pr_id = '.$pr->id);
		Log::debug('tenant.pr.addPrLineToPo Requisition Added to po_id = '.$po->id);

		EventLog::event('po', $po->id, 'add','id',$pr->id);	// Write to Log

		// now update PO values
		$result = Po::syncPoValues($po->id);
		Log::debug('tenant.PoController.addPrLineToPo Return value of Po->syncPoValues = ' . $result);
		if ($result == '') {
			Log::debug('tenant.PoController.addPrLineToPo syncPoValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.PoController.addPrLineToPo syncPoValues po_id = '.$po->id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}

		return redirect()->route('pos.show', $po->id)->with('success', 'Purchase Requisition added to PO# '.$po->id.' successfully.');
	}


}
