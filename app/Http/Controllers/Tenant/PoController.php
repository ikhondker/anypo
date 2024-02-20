<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Po;
use App\Http\Requests\Tenant\StorePoRequest;
use App\Http\Requests\Tenant\UpdatePoRequest;

use App\Http\Controllers\Tenant\DeptBudgetControllers;

# Models
use App\Models\User;

use App\Models\Tenant\Pol;
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
use App\Helpers\PoBudget;
use App\Helpers\ExchangeRate;
# Notifications
use Notification;
//use App\Notifications\PrCreated;
use App\Notifications\Tenant\PoActions;
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
				$pos = $pos->ByDeptAll()->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
				$pos = $pos->ByBuyerAll()->paginate(10);
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$pos = $pos->with('dept')->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$pos = $pos->ByUserAll()->paginate(10);
				Log::warning("tenant.po.index Other roles!");
		}

		return view('tenant.pos.index', compact('pos'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Po::class);

		$depts 		= Dept::primary()->get();
		$items 		= Item::primary()->get();
		$suppliers 	= Supplier::primary()->get();
		$projects 	= Project::primary()->get();
		$uoms 	= Uom::primary()->get();

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

		$po = Po::create($request->all());
		// Write to Log
		EventLog::event('po', $po->id, 'create');

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $po->id ]);
			$request->merge(['entity'		=> EntityEnum::PO->value ]);
			$attid = FileUpload::upload($request);
			//$request->merge(['logo'		=> $fileName ]);
		}

		// create pol lines TODO lin num
		$pol				= new Pol();
		$pol->po_id			= $po->id;
		$pol->line_num		= 1;	
		$pol->item_id		= $request->input('item_id');
		$pol->dept_id		= $po->dept_id;
		$pol->requestor_id	= $po->requestor_id;
		$pol->uom_id		= $request->input('uom_id');
		$pol->summary		= $request->input('summary');
		$pol->qty			= $request->input('qty');
		$pol->price			= $request->input('price');
		
		$pol->sub_total		= $request->input('qty') * $request->input('price');
		$pol->tax			= $request->input('tax');
		$pol->gst			= $request->input('gst');
		$pol->amount		= ($request->input('qty') * $request->input('price')) +$request->input('tax')+$request->input('gst');
		
		$pol->save();
		$pol_id			= $pol->id;
	
		switch ($request->input('action')) {
			case 'save':
				return redirect()->route('pos.show', $po->id)->with('success', 'Po#'. $po->id.' created successfully.');
				break;
			case 'save_add':
				return redirect()->route('pols.createline', $po->id)->with('success', 'Po#'. $po->id.' created successfully. Please add more line.');
				break;
		}
	}

	// add attachments
	public function attach(StorePoRequest $request)
	{
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $request->input('attach_po_id') ]);
			$request->merge(['entity'		=> EntityEnum::PO->value ]);
			$attid = FileUpload::upload($request);
			//$request->merge(['logo'	=> $fileName ]);
		}

		return redirect()->route('pos.show', $request->input('attach_po_id'))->with('success', 'File Uploaded successfully.');
	}

	public function detach(Po $po)
	{
		//$this->authorize('view', $po);

		

		$po = Po::where('id', $po->id)->get()->firstOrFail();
		$attachments = Attachment::where('entity', EntityEnum::PO->value)->where('article_id', $po->id)->get()->all();
		return view('tenant.pos.detach', compact('po', 'attachments'));
	}

	public function history(Po $po)
	{
		//$this->authorize('view', $po);
	
		$po = Po::where('id', $po->id)->get()->firstOrFail();
		return view('tenant.pos.history', compact('po'));
	}

	public function invoice(Po $po)
	{
		//$this->authorize('view', $po);

		// if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
		// 	return redirect()->route('pos.show',$po->id)->with('error', 'Only APPROVED Purchase Order can have Invoices.');
		// }


		$po = Po::where('id', $po->id)->get()->firstOrFail();
		return view('tenant.pos.invoice', compact('po'));
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
	 * Display the specified resource.
	 */
	public function extra(Po $po)
	{
		$this->authorize('view', $po);

		return view('tenant.pos.extra', compact('po'));
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

		return view('tenant.pos.edit', compact('po', 'suppliers', 'depts', 'projects', 'users'));
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

		$po->update($request->all());

		// Write to Log
		EventLog::event('po', $po->id, 'update', 'summary', $po->summary);
		return redirect()->route('pos.show', $po->id)->with('success', 'Purchase Purchase Order updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function xxpdf(Po $po)
	{
		$this->authorize('delete', $po);

		$po->fill(['enable' => !$po->enable]);
		$po->update();

		// Write to Log
		EventLog::event('po', $po->id, 'status', 'enable', $po->enable);

		return redirect()->route('pos.index')->with('success', 'Purchase Order status Updated successfully');
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
	public function close(Po $po)
	{
		
		//$this->authorize('close',Po::class);
		//$po_id= $request->input('po_id');

		
		if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
			return back()->withError("Only APPROVED Purchase Order can be closed!")->withInput();
		}

		if ($po->status <> ClosureStatusEnum::OPEN->value) {
			return back()->withError("Only OPEN Purchased Order can be closed!")->withInput();
		}

		// PO status update
		$po->status = ClosureStatusEnum::FORCED->value;
		$po->save();
		
		return redirect()->route('pos.index')->with('success', 'Purchase Order Force Closed successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function open(Po $po)
	{
		
		//$this->authorize('close',Po::class);
		//$po_id= $request->input('po_id');
		
		if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
			return back()->withError("Only APPROVED Purchase Order can be Opened!")->withInput();
		}

		if ($po->status <> ClosureStatusEnum::FORCED->value) {
			return back()->withError("Only Force Closed Purchased Order can be Opened!")->withInput();
		}

		// PO status update
		$po->status = ClosureStatusEnum::OPEN->value;
		$po->save();
		
		return redirect()->route('pos.index')->with('success', 'Purchase Order Opened successfully');

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
			
			//  Reverse Approve Budget
			$retcode = PoBudget::poBudgetApproveCancel($po_id); 
			Log::debug("tenant.po.cancel retcode = ".$retcode);
	
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
	
			// open the source PR
			// TODO P2 
			Pr::where('po_id', $po->id)
				->update([
					'po_id' 	=> null,
				]);

			// Write to Log
			EventLog::event('Po', $po->id, 'cancel', 'id', $po->id);
	
			return redirect()->route('pos.index')->with('success', 'Purchase Order canceled successfully.');
		
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("PO #".$po_id." not Found!")->withInput();
		}
	}

		
	public function export()
	{
		$data = DB::select("
		SELECT po.id, po.summary, po.po_date, po.need_by_date, u.name requestor, d.name dept_name,p.name project_name, s.name supplier_name, 
		po.notes, po.currency, po.sub_total, po.tax, po.gst, po.amount, po.status, po.auth_status, po.auth_date 
		FROM pos po,depts d, projects p, suppliers s, users u 
		WHERE po.dept_id=d.id 
		AND po.project_id=p.id 
		AND po.supplier_id=s.id 
		AND po.requestor_id=u.id
		ORDER BY po.id DESC			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}

	public function submit(Po $po)
	{
		$this->authorize('submit', $po);

		if ($po->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('prs.show',$po->id)->with('error', 'You can only submit if the status is '. strtoupper(AuthStatusEnum::DRAFT->value) .' !');
		}
		if ($po->amount == 0) {
			return redirect()->route('prs.show',$po->id)->with('error', 'You cannot submit zero value Purchase Order');
		}

		// check if budget created and set dept_budget_id
		// check if budget for this year exists
		$fy = Carbon::now()->format('Y');
		try {
			$budget = Budget::where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			return redirect()->route('prs.index')->with('error', 'Budget is not defined for '.$fy.'. Please open this years budget and try again.');
		}

		if ($budget->closed) {
			return redirect()->route('prs.show', $po->id)->with('error', 'Budget for this period is closed! You can not submit new PO for approval!');
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
			return redirect()->route('prs.index')->with('error', 'Department Budget is not defined for FY'.$fy.'. Please add budget and try again.');
		}

		if ($dept_budget->closed) {
			return redirect()->route('prs.index')->with('error', 'Department budget is closed!. Will Need to open it for any transaction.');
		} 
		
		// 	Populate functional currency values
		$result = Po::updatePoFcValues($po->id);

		if (!$result) {
			return redirect()->route('pos.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
		} 

		//  Check and book Budget
		$retcode = PoBudget::poBudgetBook($po->id);
		Log::debug("tenant.po.submit  retcode = ".$retcode );

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
		$wf_id = Workflow::submitWf(EntityEnum::PO->value, $po->id);
		if ($wf_id == 0) {
			return redirect()->route('pos.index')->with('error', 'Workflow can not be created! Failed to Submit.');
		}

		//Update back po WF id and status
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
		$action = WflActionEnum::PENDING->value;
		$actionURL = route('pos.show', $po->id);
		$next_approver_id = Workflow::getNextApproverId($po->wf_id);
		Log::debug("tenant.po.submit next_approver_id = ". $next_approver_id);
		if ($next_approver_id <> 0) {
			$approver = User::where('id', $next_approver_id)->first();
			$approver->notify(new PoActions($approver, $po, $action, $actionURL));
		} else {
			Log::debug("tenant.po.submit  next_approver_id not found!");
		}

		return redirect()->route('pos.show', $po->id)->with('success', 'Purchase Order submitted for approval successfully.');
	}

	public function copy(Po $po)
	{
		$this->authorize('view', $po);

		$sourcePo = Po::where('id', $po->id)->first();
		$po				= new Po;
		
		//  don't set dept_budget_id . It will be save during submissions
		//  Populate Function currency amounts during submit
		$po->summary			= $sourcePo->summary;
		$po->po_date			= now();
		$po->buyer_id			= auth()->user()->id;

		// User and Hod can copy into own department
		if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value ) {
			$po->requestor_id	= auth()->user()->id;
			$po->dept_id		= auth()->user()->dept_id;
		} else {
			$po->requestor_id	= $sourcePo->requestor_id;
			$po->dept_id		= $sourcePo->dept_id;
		}

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

		// copy lines into prls
		$sql= "INSERT INTO pols( po_id, line_num, summary, item_id, uom_id, qty, price, sub_total, tax, gst, amount, notes, requestor_id, dept_id, unit_id, project_id, closure_status ) 
		SELECT ".$po->id.",line_num, summary, item_id, uom_id, qty, price, sub_total, tax, gst, amount, notes, requestor_id, dept_id, unit_id, project_id, '".ClosureStatusEnum::OPEN->value."'  
		FROM pols WHERE 
		po_id= ".$sourcePo->id." ;";
		DB::INSERT($sql);

		Log::debug('tenant.po.copy New PO created =' . $po->id);
		EventLog::event('po', $po->id, 'copied','id', $sourcePo->id);	// Write to Log

		return redirect()->route('pos.show', $po->id)->with('success', 'New Purchase Order #'.$po_id.' created.');
	}


}
