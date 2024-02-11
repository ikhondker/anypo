<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Receipt;
use App\Http\Requests\Tenant\StoreReceiptRequest;
use App\Http\Requests\Tenant\UpdateReceiptRequest;

# Models
use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Lookup\Warehouse;
use App\Models\Tenant\Lookup\Project;

use App\Models\Tenant\Admin\Setup;

# Enums
use App\Enum\EntityEnum;
use App\Enum\EventEnum;
use App\Enum\UserRoleEnum;
use App\Enum\ReceiptStatusEnum;

use App\Enum\ClosureStatusEnum;

# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\FileUpload;
use App\Helpers\ExchangeRate;
# Notifications
# Mails
# Packages
# Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
# Exceptions
# Events

#Jobs
use App\Jobs\Tenant\ConsolidateBudget;
use App\Jobs\Tenant\RecordDeptBudgetUsage;


class ReceiptController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Receipt::class);

		$receipts = Receipt::query();
		if (request('term')) {
			$receipts->where('name', 'Like', '%' . request('term') . '%');
		}

		switch (auth()->user()->role->value) {
			case UserRoleEnum::BUYER->value:
				// buyer can see all payment of all his po's
				$receipts = $receipts->with('pol')->with('warehouse')->with('receiver')->ByPoBuyer(auth()->user()->id)->paginate(10);
				break;
			case UserRoleEnum::HOD->value:
				$receipts = $receipts->with('pol')->with('warehouse')->with('receiver')->ByPoDept(auth()->user()->dept_id)->paginate(10);
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$receipts = $receipts->with('pol')->with('warehouse')->with('receiver')->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$receipts = $receipts->with('pol')->with('warehouse')->with('receiver')->ByUserAll()->paginate(10);
				Log::debug("payment.index Other roles!");
		}

		//$receipts = $receipts->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.receipts.index', compact('receipts'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Pol $pol)
	{
		$this->authorize('create', Receipt::class);

		//$pol = Pol::where('id', $pol_id)->first();
		$po = Po::where('id', $pol->po_id)->first();
		$warehouses = Warehouse::primary()->get();

		return view('tenant.receipts.create-for-pol', with(compact('po','pol','warehouses')));

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreReceiptRequest $request)
	{
		$this->authorize('create', Receipt::class);

		$pol_id =$request->input('pol_id');
		$pol = Pol::where('id', $pol_id)->first();

		$request->merge(['receive_date'	=> date('Y-m-d H:i:s')]);
		$request->merge(['receiver_id'	=> 	auth()->user()->id ]);
		$request->merge(['price'	=> 	$pol->price ]);
		$request->merge(['amount'	=> 	$request->input('qty') *$pol->price ]);

		// save receipt
		$receipt = Receipt::create($request->all());

		// 	Populate functional currency values
		$result = self::updateReceiptFcValues($receipt->id);
		if (! $result) {
			return redirect()->route('pos.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
		}
		// Reupload 
		$receipt = Receipt::where('id', $receipt->id)->first();

		// update pol rcv quantity
		$pol 	= Pol::where('id', $receipt->pol_id)->firstOrFail();
		$pol->received_qty	= $pol->received_qty + $receipt->qty;
		if ($pol->qty == $pol->received_qty){
			$pol->closure_status = ClosureStatusEnum::CLOSED->value;
		}
		$pol->save();

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $receipt->id ]);
			$request->merge(['entity'		=> EntityEnum::RECEIPT->value ]);
			$attid = FileUpload::upload($request);
		}

		// update budget and project level summary 
		$po = Po::where('id', $pol->po_id)->first();
		// Po dept budget grs amount update
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_grs = $dept_budget->amount_grs + $receipt->fc_amount;
		$dept_budget->save();

		// Po project budget used
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_grs = $project->amount_grs + $receipt->fc_amount;
		$project->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::RECEIPT->value, $receipt->id, EventEnum::CREATE->value,$receipt->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		// Write to Log
		EventLog::event('receipt', $receipt->id, 'create');
		return redirect()->route('receipts.index')->with('success', 'Receipt created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Receipt $receipt)
	{
		$this->authorize('view', $receipt);
		return view('tenant.receipts.show', compact('receipt'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Receipt $receipt)
	{
		//$this->authorize('update', $dept);
		//return view('tenant.depts.edit', compact('dept'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateReceiptRequest $request, Receipt $receipt)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Receipt $receipt)
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
		$this->authorize('export', Receipt::class);

		$data = DB::select("SELECT id, receive_date, rcv_type, pol_id, warehouse_id, receiver_id, qty, notes, status, created_by, created_at, updated_by, updated_at, FROM receipts
		");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('receipts', $dataArray);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(Receipt $receipt)
	{
		$this->authorize('cancel', Receipt::class);
		
		$receipt_id = $receipt->id;

		Log::debug('Value of receipt_id=' . $receipt_id);

		try {
			$receipt = Receipt::where('id', $receipt_id)->firstOrFail();

			//Log::debug('Value of receipt_id 22222=' . $receipt_id);

			if ($receipt->status->value <> ReceiptStatusEnum::RECEIVED->value) {
				return back()->withError("You can only cancel Receipt with status received!")->withInput();
			}
	
			// update pol rcv quantity
			$pol 				= Pol::where('id', $receipt->pol_id)->firstOrFail();
			$pol->received_qty	= $pol->received_qty - $receipt->qty;
			$pol->save();
			
		
			// update budget and project level summary 
			$po = Po::where('id', $pol->po_id)->first();
			// Po dept budget grs amount update
			$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
			$dept_budget->amount_grs = $dept_budget->amount_grs - $receipt->fc_amount;
			$dept_budget->save();

			// Po project budget used
			$project = Project::where('id', $po->project_id)->firstOrFail();
			$project->amount_grs = $project->amount_grs - $receipt->fc_amount;
			$project->save();

			// run job to Sync Budget
			RecordDeptBudgetUsage::dispatch(EntityEnum::RECEIPT->value, $receipt->id, EventEnum::CANCEL->value, $receipt->fc_amount);
			ConsolidateBudget::dispatch($dept_budget->budget_id);

			// Cancel Receipt
			Receipt::where('id', $receipt_id)
				->update([
					'qty' 				=> 0,
					'price' 			=> 0,
					'amount'			=> 0,
					'fc_exchange_rate'	=> 0,
					'fc_amount'			=> 0,
					'status' 			=> ReceiptStatusEnum::CANCELED->value
					]);

			// Write to Log
			EventLog::event('receipt', $receipt_id, 'cancel', 'id', $receipt_id);
	
			return redirect()->route('receipts.index')->with('success', 'Receipts canceled successfully.');
		
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("Receipt #".$receipt_id." not Found!")->withInput();
		}
	}

	// populate functions currency columns in PO header nad lines
	public static function updateReceiptFcValues($receipt_id)
	{

		$setup 			= Setup::first();
		$receipt		= Receipt::with('pol.po')->where('id', $receipt_id)->firstOrFail();
		$po_currency 	= $receipt->pol->po->currency;

		Log::debug('updateReceiptFcValues =' . $po_currency.$setup->currency);

		// populate fc columns for receipt lines
		if ($po_currency == $setup->currency){
			$rate = 1;
			DB::statement("UPDATE receipts SET 
				-- fc_sub_total	= sub_total,
				-- fc_tax			= tax,
				-- fc_gst			= gst,
				fc_amount		= amount
				WHERE id = ".$receipt->id."");
		} else {
			$rate = round(ExchangeRate::getRate($po_currency, $setup->currency),6);
			// update all pols fc columns
			// update pr fc columns
			// ERROR rate not found 
			if ($rate == 0){
				Log::error('receipt.updateReceiptFcValues rate not found currency=' . $po_currency.' fc_currency='.$setup->currency);
				return false;
			}

			DB::statement("UPDATE receipts SET 
				fc_amount		= round(amount * ". $rate .",2)
				WHERE id = ".$receipt->id."");
		}

		return true;
	}


}
