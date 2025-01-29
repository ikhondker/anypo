<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ReceiptController.php
* @brief		This file contains the implementation of the ReceiptController
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


use App\Models\Tenant\Receipt;
use App\Http\Requests\Tenant\StoreReceiptRequest;
use App\Http\Requests\Tenant\UpdateReceiptRequest;

# 1. Models
use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Lookup\Warehouse;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Supplier;

use App\Models\Tenant\Admin\Setup;
# 2. Enums
use App\Enum\UserRoleEnum;
use App\Enum\EntityEnum;
use App\Enum\Tenant\EventEnum;
use App\Enum\Tenant\ReceiptStatusEnum;
use App\Enum\Tenant\AuthStatusEnum;

use App\Enum\Tenant\ClosureStatusEnum;
# 3. Helpers
use App\Helpers\EventLog;
use App\Helpers\Tenant\FileUpload;
use App\Helpers\Tenant\ExchangeRate;
# 4. Notifications
# 5. Jobs
use App\Jobs\Tenant\AehReceipt;
use App\Jobs\Tenant\ConsolidateBudget;
use App\Jobs\Tenant\RecordDeptBudgetUsage;
use App\Jobs\Tenant\ClosePo;
# 6. Mails
# 7. Rules
use App\Rules\Tenant\OverReceiptRule;
# 8. Packages
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
# 9. Exceptions
use Illuminate\Database\Eloquent\ModelNotFoundException;
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
# 13. FUTURE


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
			case UserRoleEnum::HOD->value:
				$receipts = $receipts->with('pol')->with('warehouse')->with('receiver')->with('status_badge')->ByPoDept(auth()->user()->dept_id)->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYS->value:
				// buyer can see all payment of all his po's
				$receipts = $receipts->with('pol')->with('warehouse')->with('receiver')->with('status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$receipts = $receipts->with('pol')->with('warehouse')->with('receiver')->with('status_badge')->ByUserAll()->paginate(10);
				Log::warning(tenant('id'). 'tenant.receipt.index Other role = '. auth()->user()->role->value);
		}

		//$receipts = $receipts->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.receipts.index', compact('receipts'));
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}



	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreReceiptRequest $request)
	{
		$this->authorize('createForPol', Receipt::class);

		$pol_id = $request->input('pol_id');
		$pol = Pol::where('id', $pol_id)->first();

		// Check over Receipt
		$request->validate([
			'qty' => [new OverReceiptRule ( $pol->id)],
		]);

		$request->merge(['receive_date'	=> date('Y-m-d H:i:s')]);
		$request->merge(['receiver_id'	=> 	auth()->user()->id ]);
		$request->merge(['price'		=> 	$pol->grs_price ]);									// <=============== NOTE
		$request->merge(['amount'		=> 	$request->input('qty') * $pol->grs_price ]);		// <=============== NOTE

		// save receipt
		$receipt = Receipt::create($request->all());

		// Create Accounting for this Receipt
		AehReceipt::dispatch($receipt->id, $receipt->amount);


		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $receipt->id ]);
			$request->merge(['entity'		=> EntityEnum::RECEIPT->value ]);
			$attid = FileUpload::aws($request);
		}

		// 	Populate functional currency values
		$result = self::updateReceiptFcValues($receipt->id);
		if (! $result) {
			return redirect()->route('receipts.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
		}
		// Reupload
		$receipt = Receipt::where('id', $receipt->id)->first();

		// update pol rcv quantity and Close pol line
		//$pol 	= Pol::where('id', $receipt->pol_id)->firstOrFail();
		$pol->received_qty	= $pol->received_qty + $receipt->qty;
		if ($pol->qty == $pol->received_qty){
			$pol->closure_status = ClosureStatusEnum::CLOSED->value;
		}
		$pol->save();



		// update budget, project and supplier level summary
		$po = Po::where('id', $pol->po_id)->first();

		// PO header update
		$po->amount_grs 	= $po->amount_grs + $receipt->amount;
		$po->fc_amount_grs 	= $po->fc_amount_grs + $receipt->fc_amount;
		$po->save();

		// Po dept budget grs amount update
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_grs 	= $dept_budget->amount_grs + $receipt->fc_amount;
		$dept_budget->count_grs 	= $dept_budget->count_grs + 1;
		$dept_budget->save();

		// Po project amount_grs
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_grs = $project->amount_grs + $receipt->fc_amount;
		$project->count_grs 	= $project->count_grs + 1;
		$project->save();

		// Supplier update amount_grs
		$supplier = Supplier::where('id', $po->supplier_id)->firstOrFail();
		$supplier->amount_grs = $supplier->amount_grs + $receipt->fc_amount;
		$supplier->count_grs 	= $supplier->count_grs + 1;
		$supplier->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::RECEIPT->value, $receipt->id, EventEnum::CREATE->value,$receipt->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		Log::debug('tenant.dashboards.index Submitting ClosePo::dispatch() for receipt_id = '.$receipt->id);
		ClosePo::dispatch($receipt->id);

		// Write to Log
		EventLog::event('receipt', $receipt->id, 'create');
		return redirect()->route('receipts.show',$receipt->id)->with('success', 'Receipt created successfully.');
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
		//$this->authorize('update', $receipt);
		//return view('tenant.depts.edit', compact('receipt'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateReceiptRequest $request, Receipt $receipt)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Receipt $receipt)
	{
		abort(403);
	}


    /**
	 * Display the specified resource.
	 */
	public function timestamp(Receipt $receipt)
	{
		$this->authorize('view', $receipt);

		return view('tenant.receipts.timestamp', compact('receipt'));
	}

    /**
	 * Display a listing of the resource.
	 */
	public function myReceipts()
	{

		$this->authorize('viewAny',Receipt::class);

		$receipts = Receipt::query();
		if (request('term')) {
			$receipts->where('name', 'Like', '%' . request('term') . '%');
		}
		$receipts = $receipts->with('pol')->with('warehouse')->with('receiver')->with('status_badge')->ByPoBuyer(auth()->user()->id)->paginate(10);

		return view('tenant.receipts.my-receipts', compact('receipts'));
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function createForPol(Pol $pol = null)
	{
		$this->authorize('createForPol', Receipt::class);

		$setup 	= Setup::first();
		if ($setup->readonly ){
			return redirect()->route('dashboards.index')->with('error', config('akk.MSG_READ_ONLY'));
		}

		$warehouses = Warehouse::primary()->get();

		if(empty($pol)){
			Log::debug('tenant.ReceiptController.createForPol No pol Selected!');
			$pols = Pol::receiptDue()->get();
			return view('tenant.receipts.create-for-pol', with(compact('pol','pols','warehouses')));
		} else {
			//check if PO is approved and open
			$po = Po::where('id', $pol->po_id)->first();
			if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
				return redirect()->route('pols.show', $pol->id)->with('error', 'You can Receive Goods only for APPROVED Purchase Order!');
			}
			if ($po->status <> ClosureStatusEnum::OPEN->value) {
				return redirect()->route('pols.show', $pol->id)->with('error', 'You can Receive Goods only for OPEN Purchase Order!');
			}

			return view('tenant.receipts.create-for-pol', with(compact('po','pol','warehouses')));
		}
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(Receipt $receipt)
	{
		$this->authorize('cancel', Receipt::class);

		$receipt_id = $receipt->id;

		Log::debug('tenant.receipt.cancel Value of receipt_id = ' . $receipt_id);

		try {
			$receipt = Receipt::where('id', $receipt_id)->firstOrFail();
			if ($receipt->status <> ReceiptStatusEnum::RECEIVED->value) {
				return back()->withError("You can only cancel Receipt with status received!")->withInput();
			}

			// update pol rcv quantity
			$pol 	= Pol::where('id', $receipt->pol_id)->firstOrFail();
			$po = Po::where('id', $pol->po_id)->first();
			if ($po->status <> ClosureStatusEnum::OPEN->value) {
				return redirect()->route('pos.show', $po->id)->with('error', 'You can cancel Receipt only for OPEN Purchase Order!');
			}
			$pol->received_qty	= $pol->received_qty - $receipt->qty;
			$pol->save();

			// reduce PO budget, project and supplier level summary
			$po->amount_grs 	= $po->amount_grs - $receipt->amount;
			$po->fc_amount_grs 	= $po->fc_amount_grs - $receipt->fc_amount;
			$po->save();

			// Po dept budget grs count and amount update
			$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
			$dept_budget->amount_grs = $dept_budget->amount_grs - $receipt->fc_amount;
			$dept_budget->count_grs = $dept_budget->count_grs -1;
			$dept_budget->save();

			// Reduce project reduce amount_grs
			$project = Project::where('id', $po->project_id)->firstOrFail();
			$project->amount_grs = $project->amount_grs - $receipt->fc_amount;
			$project->count_grs = $project->count_grs -1;
			$project->save();

			// Reduce Supplier reduce amount_grs
			$supplier = Supplier::where('id', $po->supplier_id)->firstOrFail();
			$supplier->amount_grs = $supplier->amount_grs - $receipt->fc_amount;
			$supplier->count_grs = $supplier->count_grs -1;
			$supplier->save();

			// run job to Sync Budget
			RecordDeptBudgetUsage::dispatch(EntityEnum::RECEIPT->value, $receipt->id, EventEnum::CANCEL->value, $receipt->fc_amount);
			ConsolidateBudget::dispatch($dept_budget->budget_id);

			// Create Reverse Accounting for this Receipt
			AehReceipt::dispatch($receipt->id, $receipt->amount, true);

			// Cancel Receipt
			Receipt::where('id', $receipt->id)
				->update([
					'qty' 				=> 0,
					'price' 			=> 0,
					'amount'			=> 0,
					'fc_exchange_rate'	=> 0,
					'fc_amount'			=> 0,
					'status' 			=> ReceiptStatusEnum::CANCELED->value
					]);

			Log::debug('tenant.dashboards.index Submitting ClosePo::dispatch() for receipt_id = '.$receipt->id);
			ClosePo::dispatch($receipt->id);

			// Write to Log
			EventLog::event('receipt', $receipt_id, 'cancel', 'id', $receipt_id);

			return redirect()->route('pols.show',$receipt->pol_id)->with('success', 'Receipts canceled successfully.');

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

		Log::debug('tenant.ReceiptController.updateReceiptFcValues po->currency = ' . $po_currency);
		Log::debug('tenant.ReceiptController.updateReceiptFcValues setup->currency = ' . $setup->currency);

		Log::debug('tenant.ReceiptController.updateReceiptFcValues receipt_id = ' . $receipt_id);
		Log::debug('tenant.ReceiptController.updateReceiptFcValues po->currency = ' . $po_currency);
		Log::debug('tenant.ReceiptController.updateReceiptFcValues setup->currency = ' . $setup->currency);

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
				Log::error(tenant('id'). 'receipt.updateReceiptFcValues rate not found currency = ' . $po_currency.' fc_currency = '.$setup->currency);
				return false;
			}

			DB::statement("UPDATE receipts SET
				fc_amount		= round(amount * ". $rate .",2)
				WHERE id = ".$receipt->id."");
		}

		return true;
	}

	public function ael(Receipt $receipt)
	{
		$this->authorize('view', $receipt);
		$po = Po::where('id', $receipt->pol->po_id)->get()->firstOrFail();
		return view('tenant.receipts.ael', compact('po','receipt'));
	}




}
