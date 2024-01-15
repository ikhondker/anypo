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
use App\Helpers\CheckBudget;
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
		$pos = Po::query();
		if (request('term')) {
			$pos->where('summary', 'LIKE', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:
				$pos = $pos->ByUserAll()->paginate(10);
				break;
			case UserRoleEnum::HOD->value:
				$pos = $pos->ByDeptAll()->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$pos = $pos->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$pos = $pos->ByUserAll()->paginate(10);
				Log::debug("Other roles!");
		}

		return view('tenant.pos.index', compact('pos'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Po::class);

		$depts = Dept::getAll();
		$items = Item::getAll();
		$uoms = Uom::primary()->get();
		$suppliers = Supplier::getAll1();
		$projects = Project::getAll();

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
		$request->merge(['amount'		=> $request->input('pol_amount')]);
		$request->merge(['buyer_id'		=> auth()->user()->id]);
		$request->merge(['requestor_id'		=> auth()->user()->id]);

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
		$pol			= new Pol();
		$pol->po_id		= $po->id;
		$pol->line_num	= 1;	
		$pol->item_id	= $request->input('item_id');
		$pol->uom_id	= $request->input('uom_id');
		$pol->summary	= $request->input('summary');
		$pol->qty		= $request->input('qty');
		$pol->price		= $request->input('price');
		$pol->amount	= $request->input('pol_amount');

		$pol->save();
		$pol_id			= $pol->id;
		//Log::debug("wf_id = ".$wf_id );
	
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

	/**
	 * Display the specified resource.
	 */
	public function show(Po $po)
	{
		$this->authorize('view', $po);

		$pols = Pol::where('po_id', $po->id)->get()->all();

		// approve-reject form
		if ($po->auth_status->value == AuthStatusEnum::INPROCESS->value) {
			try {
				$wfl = Wfl::where('wf_id', $po->wf_id)->where('action', WflActionEnum::PENDING->value)->where('performer_id', auth()->user()->id)->firstOrFail();
			} catch (ModelNotFoundException $exception) {
				$wfl = "";
				Log::debug("po.show: Okay. Not pending with current user.");
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

		$depts = Dept::getAll();
		
		$suppliers = Supplier::getAll1();
		$projects = Project::getAll();
		$users = User::getAll();

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
		return redirect()->route('pos.show', $po->id)->with('success', 'Purchase Requisition  updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function pdf(Po $po)
	{
		$this->authorize('delete', $po);

		$po->fill(['enable' => !$po->enable]);
		$po->update();

		// Write to Log
		EventLog::event('po', $po->id, 'status', 'enable', $po->enable);

		return redirect()->route('pos.index')->with('success', 'Po status Updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Po $po)
	{
		$this->authorize('delete', $dept);

		$dept->fill(['enable' => !$dept->enable]);
		$dept->update();

		// Write to Log
		EventLog::event('dept', $dept->id, 'status', 'enable', $dept->enable);

		return redirect()->route('depts.index')->with('success', 'Dept status Updated successfully');
	}

	public function export()
	{
		$data = DB::select("SELECT id, name, email, cell, role, enable 
			FROM users");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function getCancelPoNum()
	{

		$this->authorize('cancel',Po::class);
		
	
		return view('tenant.pos.cancel');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(StorePoRequest $request)
	{
		
		$this->authorize('cancel',Po::class);

		try {
			$po = Po::where('id', $request->input('po_id'))->firstOrFail();

			if ($po->auth_status->value == AuthStatusEnum::DRAFT->value) {
				return redirect()->route('pos.cancel')->with('error', 'Please delete DRAFT Requisition if needed!');
			}
	
			if ($po->auth_status->value <> AuthStatusEnum::APPROVED->value) {
				return redirect()->route('pos.cancel')->with('error', 'Only APPROVED Purchase Requisition can be canceled!');
			}
	
			if ($po->po_id  <> 0 ) {
				return redirect()->route('pos.cancel')->with('error', 'This Requisition is already converted to PO#'.$po->po_id.'. Requisition can not be canceled.');
			}
	
			//  Reverse Booking
			$retcode = CheckBudget::reverseBookingPo($po->id);
			Log::debug("retcode = ".$retcode);
	
			// Cancel All PO Lines
			Pol::where('po_id', $po->id)
				  ->update(['status' => ClosureStatusEnum::CANCELED->value]);
	
			// cancel PO
			Po::where('id', $po->id)
				->update(['status' => ClosureStatusEnum::CANCELED->value]);
	
			// Write to Log
			EventLog::event('Po', $po->id, 'cancel', 'id', $po->id);
	
			return redirect()->route('pos.index')->with('success', 'Purchase Requisition canceled successfully.');
		
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("PO#".$request->input('po_id')." not Found!")->withInput();
		}
	}
}
