<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\User;

use App\Models\Tenant\Invoice;
use App\Http\Requests\Tenant\StoreInvoiceRequest;
use App\Http\Requests\Tenant\UpdateInvoiceRequest;


use App\Models\Tenant\Po;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Payment;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Admin\Setup;

# Enums
use App\Enum\EntityEnum;
use App\Enum\EventEnum;
use App\Enum\UserRoleEnum;
use App\Enum\InvoiceStatusEnum;
use App\Enum\ClosureStatusEnum;
use App\Enum\PaymentStatusEnum;
use App\Enum\AuthStatusEnum;

# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\FileUpload;
use App\Helpers\ExchangeRate;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Log;

#Jobs
use App\Jobs\Tenant\ConsolidateBudget;
use App\Jobs\Tenant\RecordDeptBudgetUsage;

use DB;

class InvoiceController extends Controller
{
	
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Invoice::class);

		$invoices = Invoice::query();
		if (request('term')) {
			$invoices->where('invoice_no', 'Like', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
			case UserRoleEnum::BUYER->value:
				// buyer can see all invoice of all his po's
				$invoices = $invoices->with('status_badge')->with('pay_status_badge')->ByPoBuyer(auth()->user()->id)->paginate(10);
				break;
			case UserRoleEnum::HOD->value:
				$invoices = $invoices->with('status_badge')->with('pay_status_badge')->ByPoDept(auth()->user()->dept_id)->paginate(10);
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$invoices = $invoices->with('status_badge')->with('pay_status_badge')->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$invoices = $invoices->with('status_badge')->with('pay_status_badge')->ByUserAll()->paginate(10);
				Log::warning("tenant.invoice.index Other roles!");
		}
		return view('tenant.invoices.index', compact('invoices'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Po $po)
	{
		
		$this->authorize('create', Invoice::class);

		if ($po->auth_status <> AuthStatusEnum::APPROVED->value) {
			return redirect()->route('pos.show', $po->id)->with('error', 'You can create Invoices only for APPROVED Purchase Order!');
		}

		if ($po->status <> ClosureStatusEnum::OPEN->value) {
			return redirect()->route('pos.show', $po->id)->with('error', 'You can create Invoices only for OPEN Purchase Order!');
		}


		Log::debug('tenant.invoices.create Value of PO id in create=' . $po->id);		
		//$po = Po::where('id', $po_id)->first();
		$pocs	= User::Tenant()->get();

		return view('tenant.invoices.create-for-po', with(compact('po','pocs')));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreInvoiceRequest $request)
	{
		$this->authorize('create', Invoice::class);
		
		// get PO 
		$po = Po::where('id', $request->input('po_id'))->first();
		$request->merge(['supplier_id'	=> 	$po->supplier_id ]);

		// $request->merge(['invoice_date'		=> date('Y-m-d H:i:s')]);
		$invoice = Invoice::create($request->all());
		
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $invoice->id ]);
			$request->merge(['entity'		=> EntityEnum::INVOICE->value ]);
			$attid = FileUpload::upload($request);
		}
		
		// Write to Log
		EventLog::event('invoice', $invoice->id, 'create');
		return redirect()->route('invoices.show',$invoice->id)->with('success', 'Invoice created successfully. Please POST the invoice.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Invoice $invoice) 
	{
		
		// $this->authorize('view', $invoice);
	
		return view('tenant.invoices.show', compact('invoice'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Invoice $invoice)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateInvoiceRequest $request, Invoice $invoice)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function post(Invoice $invoice)
	{
		$this->authorize('delete', $invoice);

		if ($invoice->status <> InvoiceStatusEnum::DRAFT->value) {
			//return redirect()->route('pos.cancel')->with('error', 'Please delete DRAFT Requisition if needed!');
			return back()->withError("You can only post DRAFT Invoices!")->withInput();
		}

		// update budget and project level summary 
		$po = Po::where('id', $invoice->po_id)->first();
		if ($po->status <> ClosureStatusEnum::OPEN->value) {
			return redirect()->route('pos.show', $po->id)->with('error', 'You can post Invoices only for OPEN Purchase Order!');
		}

		$invoice->fill(['status' => InvoiceStatusEnum::POSTED->value]);
		$invoice->update();

		// 	Populate functional currency values
		$result = self::updateInvoiceFcValues($invoice->id);
		if (! $result) {
			return redirect()->route('pos.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
		}

		// Reupload 
		$invoice = Invoice::where('id', $invoice->id)->first();
		
		// Po dept budget grs amount update
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_invoice = $dept_budget->amount_invoice + $invoice->fc_amount;
		$dept_budget->save();

		// Po project budget used
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_invoice = $project->amount_invoice + $invoice->fc_amount;
		$project->save();

		// PO header update
		$po->amount_invoice = $po->amount_invoice + $invoice->amount;
		$po->fc_amount_invoice = $po->fc_amount_invoice + $invoice->fc_amount;
		$po->save();
				
		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::INVOICE->value, $invoice->id, EventEnum::POST->value, $invoice->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);
					
		// Write to Log
		EventLog::event('invoice', $invoice->id, 'post');

		return redirect()->route('invoices.index')->with('success', 'Invoice Posted successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Invoice $invoice)
	{
		//
	}

	public function export()
	{
		$this->authorize('export', Invoice::class);

		$data = DB::select("
		SELECT id, pay_date, payee_id, po_id, bank_account_id, cheque_no, currency, amount, 
		fc_currency, fc_exchange_rate, fc_amount, for_entity, notes, status, created_by, created_at, updated_by, updated_at 
		FROM invoices
		");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('invoices', $dataArray);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(Invoice $invoice)
	{
		
		$this->authorize('cancel', Invoice::class);
		
		$invoice_id = $invoice->id;

		try {
			$invoice = Invoice::where('id', $invoice_id)->firstOrFail();
			
			if ($invoice->payment_status <> PaymentStatusEnum::UNPAID->value) {
				return back()->withError("You can not cancel a paid Invoice! Please void Payments first!")->withInput();
			}

			$sum_payments		   = Payment::where('invoice_id',$invoice_id)->sum('amount');
			if ($sum_payments <> 0) {
				return back()->withError("Payment Exists! Please void Payments first!")->withInput();
			}
		

			// update budget and project level summary 
			$po = Po::where('id', $invoice->po_id)->first();

			// update budget and project level summary 
			$po = Po::where('id', $invoice->po_id)->first();
			if ($po->status <> ClosureStatusEnum::OPEN->value) {
				return redirect()->route('pos.show', $po->id)->with('error', 'You can cancel Invoices only for OPEN Purchase Order!');
			}

			// Po dept budget grs amount update
			$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
			$dept_budget->amount_invoice = $dept_budget->amount_invoice - $invoice->fc_amount;
			$dept_budget->save();

			// Po project budget used
			$project = Project::where('id', $po->project_id)->firstOrFail();
			$project->amount_invoice = $project->amount_invoice - $invoice->fc_amount;
			$project->save();

			//  Reverse PO Invoiced amount
			$po 				= Po::where('id', $invoice->po_id)->firstOrFail();
			$po->amount_invoice			= $po->amount_invoice - $invoice->amount;
			$po->fc_amount_invoice			= $po->fc_amount_invoice - $invoice->fc_amount;
			$po->save();

			// run job to Sync Budget
			RecordDeptBudgetUsage::dispatch(EntityEnum::INVOICE->value, $invoice->id, EventEnum::CANCEL->value, $invoice->fc_amount);
			ConsolidateBudget::dispatch($dept_budget->budget_id);

			// cancel Invoice
			Invoice::where('id', $invoice->id)
				->update([
					'sub_total' 	=> 0,
					'tax' 			=> 0,
					'gst' 			=> 0,
					'amount' 		=> 0,
					'fc_sub_total' 	=> 0,
					'fc_tax' 		=> 0,
					'fc_gst' 		=> 0,
					'fc_amount' 	=> 0,
					'paid_amount' 	=> 0,
					'status' 		=> InvoiceStatusEnum::CANCELED->value
				]);
	
			// Write to Log
			EventLog::event('invoice', $invoice->id, 'cancel', 'id', $invoice->id);
	
			return redirect()->route('invoices.index')->with('success', 'Invoice canceled successfully.');
		
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("Invoice #".$invoice_id." not Found!")->withInput();
		}
	}

	// populate functions currency columns in PO header nad lines
	public static function updateInvoiceFcValues($receipt_id)
	{

		$setup 			= Setup::first();
		$invoice		= Invoice::with('po')->where('id', $receipt_id)->firstOrFail();
		Log::debug('updateInvoiceFcValues =' . $invoice->currency.$setup->currency);

		// populate fc columns for receipt lines
		if ($invoice->currency == $setup->currency){
			$rate = 1;
			DB::statement("UPDATE invoices SET 
				fc_sub_total	= sub_total,
				fc_tax			= tax,
				fc_gst			= gst,
				fc_amount		= amount
				WHERE id = ".$invoice->id."");
		} else {
			$rate = round(ExchangeRate::getRate($invoice->currency, $setup->currency),6);
			// update all pols fc columns
			// update pr fc columns
			// ERROR rate not found 
			if ($rate == 0){
				Log::error('receipt.updateInvoiceFcValues rate not found currency=' . $invoice->currency.' fc_currency='.$setup->currency);
				return false;
			}

			DB::statement("UPDATE invoices SET 
				fc_sub_total	= round(sub_total * ". $rate .",2),
				fc_tax			= round(tax * ". $rate .",2),
				fc_gst			= round(gst * ". $rate .",2),
				fc_amount		= round(amount * ". $rate .",2)
				WHERE id = ".$invoice->id."");
		}

		return true;
	}

}
