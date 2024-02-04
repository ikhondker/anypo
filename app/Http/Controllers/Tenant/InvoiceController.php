<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\User;

use App\Models\Tenant\Invoice;
use App\Http\Requests\Tenant\StoreInvoiceRequest;
use App\Http\Requests\Tenant\UpdateInvoiceRequest;


use App\Models\Tenant\Po;

# Enums
use App\Enum\EntityEnum;
use App\Enum\UserRoleEnum;
use App\Enum\InvoiceStatusEnum;
use App\Enum\PaymentStatusEnum;
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\FileUpload;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Log;


class InvoiceController extends Controller
{
		/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Models\Pol  $pol
	 * @return \Illuminate\Http\Response
	 */
	public function createForPo($po_id)
	{

		$this->authorize('create', Invoice::class);
				
		$po = Po::where('id', $po_id)->first();
		$pocs	= User::Tenant()->get();

		return view('tenant.invoices.create-for-po', with(compact('po','pocs')));
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Invoice::class);

		$invoices = Invoice::query();
		if (request('term')) {
			$invoices->where('name', 'Like', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
			case UserRoleEnum::BUYER->value:
				// buyer can see all invoice of all his po's
				$invoices = $invoices->ByPoBuyer(auth()->user()->id)->paginate(10);
				break;
			case UserRoleEnum::HOD->value:
				$invoices = $invoices->ByPoDept(auth()->user()->dept_id)->paginate(10);
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$invoices = $invoices->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$invoices = $invoices->ByUserAll()->paginate(10);
				Log::debug("invoice.index Other roles!");
		}
		return view('tenant.invoices.index', compact('invoices'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Po $po)
	{
		$this->authorize('create', Invoice::class);
		Log::debug('Value of PO id in create=' . $po->id);		
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
		
		//Log::debug('inside invoice .store');

		$invoice = Invoice::create($request->all());

		// update PO header
		$po 					= Po::where('id', $invoice->po_id)->firstOrFail();
		$po->amount_invoiced	= $po->amount_invoiced + $invoice->amount;
		$po->save();

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $invoice->id ]);
			$request->merge(['entity'		=> EntityEnum::INVOICE->value ]);
			$attid = FileUpload::upload($request);
		}

		// Write to Log
		EventLog::event('invoice', $invoice->id, 'create');
		return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Invoice $invoice)
	{
		$this->authorize('view', $invoice);
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
	public function destroy(Invoice $invoice)
	{
		//
	}

	public function export()
	{
		$this->authorize('export', Invoice::class);

		$data = DB::select("SELECT id, pay_date, payee_id, po_id, bank_account_id, cheque_no, currency, amount, fc_currency, fc_exchange_rate, fc_amount, for_entity, notes, status, created_by, created_at, updated_by, updated_at, FROM invoices
		");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('invoices', $dataArray);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function getCancelInvNum()
	{

		//$this->authorize('cancel',Invoice::class);
		
		return view('tenant.invoices.cancel');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(StoreInvoiceRequest $request)
	{
		
		$this->authorize('cancel',Invoice::class);
		
		$invoice_id = $request->input('invoice_id');

		try {
			$invoice = Invoice::where('id', $invoice_id)->firstOrFail();
			
			if ($invoice->payment_status <> PaymentStatusEnum::UNPAID->value) {
				return back()->withError("You can not cancel a paid Invoice! Please void Payments first!")->withInput();
			}
	
			//  Reverse PO Invoiced amount
			$po 				= Po::where('id', $invoice->po_id)->firstOrFail();
			$po->amount_invoiced			= $po->amount_invoiced - $invoice->amount;
			$po->save();

			// cancel Invoice
			Invoice::where('id', $invoice->id)
				->update(['status' => InvoiceStatusEnum::CANCELED->value]);
	
			// Write to Log
			EventLog::event('Invoice', $invoice->id, 'cancel', 'id', $invoice->id);
	
			return redirect()->route('invoices.index')->with('success', 'Invoice canceled successfully.');
		
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("Invoice #".$invoice_id." not Found!")->withInput();
		}
	}

}
