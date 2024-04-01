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
use App\Models\Tenant\Admin\Attachment;

use App\Models\Tenant\Manage\Status;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Project;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;

use App\Models\Tenant\Workflow\Wfl;
# 2. Enums
use App\Enum\UserRoleEnum;
use App\Enum\EntityEnum;
use App\Enum\WflActionEnum;
use App\Enum\ClosureStatusEnum;
use App\Enum\AuthStatusEnum;

# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
use App\Helpers\Workflow;
use App\Helpers\FileUpload;
use App\Helpers\PrBudget;
use App\Helpers\ExchangeRate;
# 4. Notifications
use Notification;
use App\Notifications\Tenant\PrActions;
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
# 13. TODO 


class PrController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{

		$prs = Pr::query();
		if (request('term')) {
			$prs->where('summary', 'LIKE', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:
				$prs = $prs->ByUserAll()->with("requestor")->with("dept")->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::HOD->value:
				$prs = $prs->ByDeptApproved()->with("requestor")->with("dept")->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
				$prs = $prs->AllApproved()->with("requestor")->with("dept")->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
				$prs = $prs->AllApproved()->with("requestor")->with("dept")->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::SYSTEM->value:
				//->with('status_badge')
				//->with('auth_status_badge')
				//$prs = $prs->with("requestor")->with("dept")->with('status_badge')->with('auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				$prs = $prs->with("requestor")->with("dept")->with('status_badge','auth_status_badge')->orderBy('id', 'DESC')->paginate(10);
				
				break;
			default:
				$prs = $prs->ByUserAll()->paginate(10);
				Log::warning("tenant.pr.index Other roles!");
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

		$depts = Dept::primary()->get();
		$items = Item::primary()->get();
		$suppliers = Supplier::primary()->get();
		$projects = Project::primary()->get();
		$uoms = Uom::primary()->get();
		
		return view('tenant.prs.create', compact('suppliers', 'depts', 'items','uoms', 'projects'));

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
	
		// 	update PR Header value
		$result = Pr::updatePrHeaderValue($prl->pr_id);
	
		
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

	// add attachments
	public function attach(FormRequest $request)
	{
		$this->authorize('create', Pr::class);
		
		// allow add attachment only if status is draft
		try {
			$pr = Pr::where('id', $request->input('attach_pr_id'))->get()->firstOrFail();
		} catch (Exception $e) {
			Log::error('tenant.pr.attach '. $e->getMessage());
			return redirect()->back()->with(['error' => 'Unknown Error!']);
		}
		if ($pr->auth_status <>  AuthStatusEnum::DRAFT->value){
			return redirect()->route('prs.show', $pr->id)->with('error',  'Add attachment is only allowed for DRAFT requisition.');
		}
	
		// $request->validate([

		// ]);
		//$request->validate(['file_to_upload'	=> 'required|file|mimes:zip,rar,doc,docx,xls,xlsx,pdf,jpg|max:512']);

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_pr_id')]);
			$request->merge(['entity'		=> EntityEnum::PR->value ]);
			$attid = FileUpload::aws($request);
		}

		return redirect()->route('prs.show', $request->input('attach_pr_id'))->with('success', 'File Uploaded successfully.');
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
	public function extra(Pr $pr)
	{
		$this->authorize('view', $pr);

		return view('tenant.prs.extra', compact('pr'));
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Pr $pr)
	{
		
		if ($pr->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('prs.show',$pr->id)->with('error', 'You can not edit a Requisition with status '. strtoupper($pr->auth_status) .' !');
		}

		$this->authorize('update', $pr);

		$depts = Dept::primary()->get();
		
		$suppliers = Supplier::primary()->get();
		$projects = Project::primary()->get();
		$users = User::tenant()->get();

		return view('tenant.prs.edit', compact('pr', 'suppliers', 'depts', 'projects', 'users'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePrRequest $request, Pr $pr)
	{
		$this->authorize('update', $pr);

		// User and HoD Can not edit department PR
		if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value ) {
			$request->merge(['dept_id'		=> auth()->user()->dept_id]);
		} 

		$pr->update($request->all());

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $pr->id ]);
			$request->merge(['entity'		=> EntityEnum::PR->value ]);
			$attid = FileUpload::aws($request);
		}
		
		// Write to Log
		EventLog::event('pr', $pr->id, 'update', 'summary', $pr->summary);
		return redirect()->route('prs.show', $pr->id)->with('success', 'Purchase Requisition  updated successfully.');
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Pr $pr)
	{

		//Log::debug('tenant.prs.destroy pr_id='.$pr->id. ' auth_status='.$pr->auth_status );

		if ($pr->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('prs.show', $pr->id)->with('error', 'Only DRAFT Purchase Requisition can be deleted!');
		}

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

		$this->authorize('recalculate', Pr::class);
		// 	update PR Header value
		DB::statement("set @sequenceNumber=0");

		DB::statement("UPDATE prls SET 
				line_num	= (@sequenceNumber:=@sequenceNumber+1),
				sub_total	= qty*price,
				amount		= qty * price + tax +gst
				WHERE pr_id = ".$pr->id."");

		$result = Pr::updatePrHeaderValue($pr->id);
		return redirect()->route('prs.show', $pr->id)->with('success', 'Amount Recalculated!');

	}
	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(Pr $pr)
	{

		$this->authorize('cancel', Pr::class);
	
		$pr_id= $pr->id;

		try {
			$pr = Pr::where('id', $pr_id)->firstOrFail();

			if ($pr->auth_status == AuthStatusEnum::DRAFT->value) {
				return back()->withError("Please delete DRAFT Requisition if needed!")->withInput();
				//return redirect()->route('prs.cancel')->with('error', 'Please delete DRAFT Requisition if needed!');
			}
	
			if ($pr->auth_status <> AuthStatusEnum::APPROVED->value) {
				return back()->withError("Only APPROVED Purchase Requisition can be canceled!")->withInput();
				//return redirect()->route('prs.cancel')->with('error', 'Only APPROVED Purchase Requisition can be canceled!');
			}
	
			if ($pr->po_id  <> 0 ) {
				return back()->withError('This Requisition is already converted to PO #'.$pr->po_id.'. Requisition can not be canceled.')->withInput();
				//return redirect()->route('prs.cancel')->with('error', 'This Requisition is already converted to PO#'.$pr->po_id.'. Requisition can not be canceled.');
			}
	
			//  Reverse Booking 
			$retcode = PrBudget::prBudgetApproveCancel($pr_id); 
			Log::debug("tenant.pr.cancel retcode = ".$retcode);
	
			// Cancel All PR Lines
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
			Log::warning("tenant.prs.cancel PR#".$request->input('pr_id')." not Found!");
			return back()->withError("PR #".$pr_id." not Found!")->withInput();
		}
	}

	
	public function submit(Pr $pr)
	{
		
		$this->authorize('submit', $pr);

		if ($pr->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('prs.show',$pr->id)->with('error', 'You can only submit if the status is '. strtoupper(AuthStatusEnum::DRAFT->value) .' !');
		}
		if ($pr->amount == 0) {
			return redirect()->route('prs.show',$pr->id)->with('error', 'You cannot submit zero value Requisition');
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

		if ($budget->closed) {
			return redirect()->route('prs.show', $pr->id)->with('error', 'Budget for this period is freezed! You can not submit new PR for approval!');
		}

		// check if dept_budget for this year exists then update dept_budget_id column
		try {
			$dept_budget = DeptBudget::where('budget_id', $budget->id)
				->where('dept_id', $pr->dept_id)
				->firstOrFail();
			$pr->dept_budget_id = $dept_budget->id;
			$pr->save();
			Log::debug('tenant.po.submit dept_budget=' . $dept_budget->id);
			
		} catch (ModelNotFoundException $exception) {
			Log::warning("tenant.prs.submit ModelNotFoundException. DeptBudget not found for budget_id= ". $budget->id);
			return redirect()->route('prs.index')->with('error', 'Department Budget is not defined for FY'.$fy.'. Please add budget and try again');
		}

		if ($dept_budget->closed) {
			return redirect()->route('prs.index')->with('error', 'Department budget is closed!. Will Need to open it for any transaction.');
		} 

		// 	Populate functional currency values
		$result = Pr::updatePrFcValues($pr->id);
		if (! $result ) {
			return redirect()->route('prs.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
		} else {
			Log::debug('tenant.po.submit updatePrFcValues completed.');
		}

		//  Check and book Dept Budget
		$retcode = PrBudget::prBudgetBook($pr->id);

		// TODO use db table
		//Log::debug("tenant.pr.submit retcode = ".$retcode );
		switch ($retcode) {
			case 'E001':
				return redirect()->back()->with('error', config('akk.MSG_E001'));
				break;
			case 'E002':
				return redirect()->back()->with('error', config('akk.MSG_E002'));
				break;
			case 'E003':
				return redirect()->back()->with('error', config('akk.MSG_E003'));
				break;
			case 'E999':
				return redirect()->back()->with('error', config('akk.MSG_E999')) ;
				break;
			default:
				Log::debug('tenant.po.submit prBudgetBook completed successfully.');
				// Success
		}

		//  Submit for approval
		$wf_id = Workflow::submitWf(EntityEnum::PR->value, $pr->id);
		if ($wf_id == 0) {
			return redirect()->route('prs.index')->with('error', 'Workflow can not be created! Failed to Submit.');
		}

		//Update back pr WF id and status
		$pr->wf_id = $wf_id;
		$pr->auth_status = AuthStatusEnum::INPROCESS->value;
		$pr->submission_date = Carbon::now();
		$pr->update();
		EventLog::event('pr', $pr->id, 'submit');	// Write to Log

		// Send notification to Pr creator
		$action = WflActionEnum::SUBMITTED->value;
		$actionURL = route('prs.show', $pr->id);
		$requestor = User::where('id', $pr->requestor_id)->first();
		$requestor->notify(new PrActions($requestor, $pr, $action, $actionURL));

		// Send notification to Next Approver
		$action = WflActionEnum::PENDING->value;
		$actionURL = route('prs.show', $pr->id);
		$next_approver_id = Workflow::getNextApproverId($pr->wf_id);
		Log::debug("tenant.pr.submit next_approver_id = ". $next_approver_id);
		if ($next_approver_id <> 0) {
			$approver = User::where('id', $next_approver_id)->first();
			$approver->notify(new PrActions($approver, $pr, $action, $actionURL));
		} else {
			Log::debug("tenant.pr.submit next_approver_id not found!");
		}

		return redirect()->route('prs.show', $pr->id)->with('success', 'Purchase Requisition submitted for approval successfully.');
	}

	public function copy(Pr $pr)
	{
		$this->authorize('view', $pr);

		$sourcePr = Pr::where('id', $pr->id)->first();
		$pr				= new Pr;
		
		//  don't set dept_budget_id . It will be save during submissions
		//  Populate Function currency amounts during submit
		$pr->summary			= $sourcePr->summary;
		$pr->pr_date			= now();
		
		// User and Hod can copy into own department
		if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value ) {
			$pr->requestor_id	= auth()->user()->id;
			$pr->dept_id		= auth()->user()->dept_id;
		} else {
			$pr->requestor_id	= $sourcePr->requestor_id;
			$pr->dept_id		= $sourcePr->dept_id;
		}

		$pr->need_by_date		= $sourcePr->need_by_date;
		$pr->project_id			= $sourcePr->project_id;
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
		$sql= "INSERT INTO prls( pr_id, line_num, summary, item_id, uom_id, notes, qty, price, sub_total, tax, gst, amount, closure_status ) 
		SELECT ".$pr->id.",line_num, summary, item_id, uom_id, notes, qty, price, sub_total, tax, gst, amount, '".ClosureStatusEnum::OPEN->value."'  
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
			return redirect()->route('prs.show',$pr->id)->with('error', 'You can only convert to PO if Requisition status is '. AuthStatusEnum::DRAFT->value .' !');
		}

		if ($pr->po_id <> 0) {
			return redirect()->route('prs.show',$pr->id)->with('error', 'Requisition already converted to PO #'. $pr->po_id .' !');
		}

		$pr = Pr::where('id', $pr->id)->first();
		//  don't set dept_budget_id . It will be save during submissions
		//  Populate Function currency amounts during submit
		$po					= new Po;
		$po->summary		= $pr->summary;
		$po->buyer_id		= auth()->user()->id;
		$po->po_date		= now();
		$po->need_by_date	= $pr->need_by_date;
		$po->requestor_id	= $pr->requestor_id;
		$po->dept_id		= $pr->dept_id;
		$po->unit_id		= $pr->unit_id;
		$po->project_id		= $pr->project_id;
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
		$sql= "
		INSERT INTO pols( po_id, line_num, summary, item_id, uom_id, qty, price, sub_total, tax, gst, amount, notes,
		requestor_id, dept_id, unit_id, closure_status ) 
		SELECT ".$po_id.",prl.line_num, prl.summary, prl.item_id, prl.uom_id,  prl.qty, prl.price, prl.sub_total, prl.tax, prl.gst, prl.amount, prl.notes,
		pr.requestor_id, pr.dept_id, pr.unit_id,'".ClosureStatusEnum::OPEN->value."'  
		FROM prls prl,prs pr
		WHERE pr.id=prl.pr_id
		AND pr_id= ".$pr->id.
		" ;";
		DB::INSERT($sql);

		// update source PR 
		$pr->po_id		= $po_id;
		$pr->save();

		EventLog::event('po', $po->id, 'converted','id',$pr->id);	// Write to Log

		return redirect()->route('pos.show', $po_id)->with('success', 'Purchase Order #'.$po_id.' created.');
	}

	public function export()
	{

		$this->authorize('export', Pr::class);

		if (auth()->user()->role->value == UserRoleEnum::USER->value ){
			$requestor_id 	= auth()->user()->id;
		} else {
			$requestor_id 	= '';
		}

		if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$dept_id 	= auth()->user()->dept_id;
		} else {
			$dept_id 	= '';
		}

		$data = DB::select("
		SELECT pr.id, pr.summary, pr.pr_date, pr.need_by_date, u.name requestor, d.name dept_name,p.name project_name, s.name supplier_name, 
		pr.notes, pr.currency, pr.sub_total, pr.tax, pr.gst, pr.amount, pr.status, pr.auth_status, pr.auth_date 
		FROM prs pr,depts d, projects p, suppliers s, users u 
		WHERE pr.dept_id=d.id 
		AND pr.project_id=p.id 
		AND pr.supplier_id=s.id 
		AND pr.requestor_id=u.id
		AND ". ($dept_id <> '' ? 'pr.dept_id='.$dept_id.' ' : ' 1=1 ')  ."
		AND ". ($requestor_id <> '' ? 'pr.requestor_id='.$requestor_id.' ' : ' 1=1 ')  ."
		ORDER BY pr.id DESC
		");

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('prs', $dataArray);
	}

	
}
