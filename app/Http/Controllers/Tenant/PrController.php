<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Pr;
use App\Http\Requests\Tenant\StorePrRequest;
use App\Http\Requests\Tenant\UpdatePrRequest;


use App\Http\Controllers\Tenant\DeptBudgetControllers;

# Models
use App\Models\User;

use App\Models\Tenant\Prl;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;


use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Admin\Attachment;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;

use App\Models\Tenant\Workflow\Wfl;

# Enums
use App\Enum\UserRoleEnum;
use App\Enum\EntityEnum;
use App\Enum\WflActionEnum;
use App\Enum\ClosureStatusEnum;
use App\Enum\AuthStatusEnum;

//use App\Enum\ActionEnum;

# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\Workflow;
use App\Helpers\FileUpload;
use App\Helpers\CheckBudget;
use App\Helpers\ExchangeRate;
# Notifications
use Notification;
//use App\Notifications\PrCreated;
use App\Notifications\Tenant\PrActions;
# Mails
# Packages
# Seeded
use DB;
use Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

# Exceptions
# Events


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
				$prs = $prs->ByUserAll()->paginate(10);
				break;
			case UserRoleEnum::HOD->value:
				$prs = $prs->ByDeptAll()->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$prs = $prs->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$prs = $prs->ByUserAll()->paginate(10);
				Log::debug("Other roles!");
		}

		return view('tenant.prs.index', compact('prs'))->with('i', (request()->input('page', 1) - 1) * 10);
	}
 
	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Pr::class);

		$depts = Dept::getAll();
		$items = Item::getAll();
		$uoms = Uom::primary()->get();
		$suppliers = Supplier::getAll1();
		$projects = Project::getAll();

		return view('tenant.prs.create', compact('suppliers', 'depts', 'items','uoms', 'projects'));

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StorePrRequest $request)
	{
		$this->authorize('create', Pr::class);
		$setup = Setup::first();

		// don't set dept_budget_id . It will be save during submissions
		$request->merge(['requestor_id'	=> 	auth()->user()->id ]);
		$request->merge(['pr_date'		=> date('Y-m-d H:i:s')]);
		$request->merge(['amount'		=> $request->input('prl_amount')]);

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
			$attid = FileUpload::upload($request);
			//$request->merge(['logo'		=> $fileName ]);
		}

		// create prl lines TODO lin num
		$prl			= new Prl();
		$prl->pr_id		= $pr->id;
		$prl->line_num	= 1;	
		$prl->item_id	= $request->input('item_id');
		$prl->uom_id	= $request->input('uom_id');
		$prl->summary	= $request->input('summary');
		$prl->qty		= $request->input('qty');
		$prl->price		= $request->input('price');
		$prl->amount	= $request->input('prl_amount');

		$prl->save();
		$prl_id			= $prl->id;
		//Log::debug("wf_id = ".$wf_id );
	
		switch ($request->input('action')) {
			case 'save':
				return redirect()->route('prs.show', $pr->id)->with('success', 'Pr#'. $pr->id.' created successfully.');
				break;
			case 'save_add':
				return redirect()->route('prls.createline', $pr->id)->with('success', 'Pr#'. $pr->id.' created successfully. Please add more line.');
				break;
		}
	}

	// add attachments
	public function attach(StorePrRequest $request)
	{
		$this->authorize('create', Pr::class);

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_pr_id') ]);
			$request->merge(['entity'		=> EntityEnum::PR->value ]);
			$attid = FileUpload::upload($request);
			//$request->merge(['logo'	=> $fileName ]);
		}

		return redirect()->route('prs.show', $request->input('attach_pr_id'))->with('success', 'File Uploaded successfully.');
	}

	public function detach(Pr $pr)
	{
		//$this->authorize('view', $pr);

		$pr = Pr::where('id', $pr->id)->get()->firstOrFail();
		$attachments = Attachment::where('entity', EntityEnum::PR->value)->where('article_id', $pr->id)->get()->all();
		return view('tenant.prs.detach', compact('pr', 'attachments'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Pr $pr)
	{
		$this->authorize('view', $pr);

		$prls = Prl::where('pr_id', $pr->id)->get()->all();

		// approve-reject form
		if ($pr->auth_status->value == AuthStatusEnum::INPROCESS->value) {
			try {
				$wfl = Wfl::where('wf_id', $pr->wf_id)->where('action', WflActionEnum::PENDING->value)->where('performer_id', auth()->user()->id)->firstOrFail();
			} catch (ModelNotFoundException $exception) {
				$wfl = "";
				Log::debug("pr.show: Okay. Not pending with current user.");
			}
		} else {
			$wfl = "";
		}
		return view('tenant.prs.show', compact('pr', 'prls', 'wfl'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Pr $pr)
	{
		$this->authorize('update', $pr);

		$depts = Dept::getAll();
		
		$suppliers = Supplier::getAll1();
		$projects = Project::getAll();
		$users = User::getAll();

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

		// Write to Log
		EventLog::event('pr', $pr->id, 'update', 'summary', $pr->summary);
		return redirect()->route('prs.show', $pr->id)->with('success', 'Purchase Requisition  updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function pdf(Pr $pr)
	{
		$this->authorize('delete', $pr);

		$pr->fill(['enable' => !$pr->enable]);
		$pr->update();

		// Write to Log
		EventLog::event('pr', $pr->id, 'status', 'enable', $pr->enable);

		return redirect()->route('prs.index')->with('success', 'Pr status Updated successfully');
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Pr $pr)
	{
		$this->authorize('delete', $pr);

		//Log::debug('pr_id='.$pr->id. ' authe_status='.$pr->auth_status->value );

		if ($pr->auth_status->value <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('prs.show', $pr->id)->with('error', 'Only DRAFT Purchase Requisition can be deleted!');
		}

		// Write to Log
		EventLog::event('Pr', $pr->id, 'delete', 'id', $pr->id);
		// delete from prl
		DB::table('prls')->where('pr_id', $pr->id)->delete();
		$pr->delete();

		return redirect()->route('prs.index')->with('success', 'Purchase Requisition deleted successfully');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function getCancelPrNum()
	{

		$this->authorize('cancel',Pr::class);
		
		Log::debug('pr_id=getCancelPrNum');
		
		return view('tenant.prs.cancel');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(StorePrRequest $request)
	{
		
		$this->authorize('cancel',Pr::class);

		try {
			$pr = Pr::where('id', $request->input('pr_id'))->firstOrFail();

			if ($pr->auth_status->value == AuthStatusEnum::DRAFT->value) {
				return redirect()->route('prs.cancel')->with('error', 'Please delete DRAFT Requisition if needed!');
			}
	
			if ($pr->auth_status->value <> AuthStatusEnum::APPROVED->value) {
				return redirect()->route('prs.cancel')->with('error', 'Only APPROVED Purchase Requisition can be canceled!');
			}
	
			if ($pr->po_id  <> 0 ) {
				return redirect()->route('prs.cancel')->with('error', 'This Requisition is already converted to PO#'.$pr->po_id.'. Requisition can not be canceled.');
			}
	
			//  Reverse Booking
			$retcode = CheckBudget::reverseBookingPr($pr->id);
			Log::debug("retcode = ".$retcode);
	
			// Cancel All PR Lines
			Prl::where('pr_id', $pr->id)
				  ->update(['status' => ClosureStatusEnum::CANCELED->value]);
	
			// cancel PR
			Pr::where('id', $pr->id)
				->update(['status' => ClosureStatusEnum::CANCELED->value]);
	
			// Write to Log
			EventLog::event('Pr', $pr->id, 'cancel', 'id', $pr->id);
	
			return redirect()->route('prs.index')->with('success', 'Purchase Requisition canceled successfully.');
		
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			//Log::debug("PR#".$request->input('pr_id')." not Found!");
			return back()->withError("PR#".$request->input('pr_id')." not Found!")->withInput();
		}
	}

	public function export()
	{
		$data = DB::select("SELECT id, name, email, cell, role, enable 
			FROM users");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}

	public function submit(Pr $pr)
	{
		
		$this->authorize('submit', $pr);

		if ($pr->auth_status->value <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('prs.index')->with('error', 'You can only submit if the status is '. AuthStatusEnum::DRAFT->value .' !');
		}

		// check if budget created and set dept_budget_id
		// check if budget for this year exists
		$fy = Carbon::now()->format('Y');
		try {
			$budget = Budget::where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			return redirect()->route('prs.index')->with('error', 'Budget is not defined for '.$fy.'. Please open this years budget and try again');
		}

		if ($budget->freeze) {
			return redirect()->route('prs.show', $pr->id)->with('error', 'Budget for this period is freezed! You can not submit new PR for approval!');
		}

		// check if dept_budget for this year exists then update dept_budget_id column
		try {
			$dept_budget = DeptBudget::primary()
				->where('budget_id', $budget->id)
				->where('dept_id', $pr->dept_id)
				->firstOrFail();
			$pr->dept_budget_id = $dept_budget->id;
			$pr->save();
		} catch (ModelNotFoundException $exception) {
			//Log::debug("Inside ModelNotFoundException");
			return redirect()->route('prs.index')->with('error', 'Department Budget is not defined for FY'.$fy.'. Please add budget and try again');
		}

		//  Populate Function currency amounts
		$setup = Setup::first();
		// PR in functional currency
		//dd($pr,$setup);
		if ($pr->currency == $setup->currency) {
			$pr->fc_currency 		= $setup->currency;
			$pr->fc_exchange_rate 	= 1;
			$pr->fc_amount			= $pr->amount;
			$pr->save();
		} else {
			$rate = ExchangeRate::getRate($pr->currency, $setup->currency);
			if ($rate == 0) {
				return redirect()->route('prs.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
			} else {

				$pr->fc_currency		= $setup->currency;
				$pr->fc_exchange_rate	= round($rate, 6);
				// Log::debug("rate=".$rate);
				// Log::debug("fc_exchange_rate=".$pr->fc_exchange_rate);
				// Log::debug("amount=".$pr->amount);
				$pr->fc_amount = round($pr->amount * $pr->fc_exchange_rate, 2);
				$pr->save();
			}
		}

		//  Check and book Budget
		$retcode = CheckBudget::checkAndBookPr($pr->id);
		//Log::debug("retcode = ".$retcode );

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
		Log::debug("next_approver_id = ". $next_approver_id);
		if ($next_approver_id <> 0) {
			$approver = User::where('id', $next_approver_id)->first();
			$approver->notify(new PrActions($approver, $pr, $action, $actionURL));
		} else {
			Log::debug("next_approver_id not found!");
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
		$pr->amount				= $sourcePr->amount;
		$pr->fc_currency		= $sourcePr->fc_currency;
		$pr->fc_exchange_rate	= $sourcePr->fc_exchange_rate;
		$pr->fc_amount			= $sourcePr->fc_amount;
		$pr->closure_status		= ClosureStatusEnum::OPEN->value;
		$pr->auth_status		= AuthStatusEnum::DRAFT->value;
		$pr->save();
		$pr_id					= $pr->id;

		// copy lines into prls
		$sql= "INSERT INTO prls( pr_id, line_num, summary, item_id, uom_id, notes, qty, price, sub_total, tax, vat, amount, status ) 
		SELECT ".$pr->id.",line_num, summary, item_id, uom_id, notes, qty, price, sub_total, tax, vat, amount, '".ClosureStatusEnum::OPEN->value."'  
		FROM prls WHERE 
		pr_id= ".$sourcePr->id." ;";
		//Log::debug('sql=' . $sql);
		DB::INSERT($sql);

		Log::debug('New PR created =' . $pr->id);
		EventLog::event('pr-copy', $pr->id, 'copied');	// Write to Log

		return redirect()->route('prs.show', $pr->id)->with('success', 'Purchase Requisition #'.$pr_id.' created.');
	}

}
