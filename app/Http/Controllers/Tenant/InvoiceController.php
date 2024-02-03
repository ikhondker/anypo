<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Invoice;
use App\Http\Requests\Tenant\StoreInvoiceRequest;
use App\Http\Requests\Tenant\UpdateInvoiceRequest;


use App\Models\Tenant\Po;

# Enums
use App\Enum\EntityEnum;
use App\Enum\UserRoleEnum;
use App\Enum\InvoiceStatusEnum;
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
	
		return view('tenant.invoices.create-for-po', with(compact('po')));
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
				// buyer can see all payment of all his po's
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
				Log::debug("payment.index Other roles!");
		}
		return view('tenant.invoices.index', compact('invoices'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreInvoiceRequest $request)
	{
		$this->authorize('create', Invoice::class);

		$request->merge(['payee_id'	=> 	auth()->user()->id ]);
		$payment = Invoice::create($request->all());

		// update PO header
		$po 				= Po::where('id', $payment->po_id)->firstOrFail();
		$po->amount			= $po->amount_paid + $payment->amount;
		$po->save();

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $payment->id ]);
			$request->merge(['entity'		=> EntityEnum::PAYMENT->value ]);
			$attid = FileUpload::upload($request);
		}

		// Write to Log
		EventLog::event('payment', $payment->id, 'create');
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
	public function getCancelPayNum()
	{

		//$this->authorize('cancel',Invoice::class);
		
		return view('tenant.invoices.cancel');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function cancel(StorePaymentRequest $request)
	{
		
		$this->authorize('cancel',Invoice::class);
		
		$payment_id = $request->input('payment_id');

		try {
			$payment = Invoice::where('id', $payment_id)->firstOrFail();

			
			if ($payment->status <> PaymentStatusEnum::PAID->value) {
				return back()->withError("You can only cancel payment with status paid!")->withInput();
			}
	
			//  Reverse PO Invoice
			$po 				= Po::where('id', $payment->po_id)->firstOrFail();
			$po->amount			= $po->amount_paid - $payment->amount;
			$po->save();

			// cancel Invoice
			Invoice::where('id', $payment->id)
				->update(['status' => PaymentStatusEnum::VOID->value]);
	
			// Write to Log
			EventLog::event('Invoice', $payment->id, 'void', 'id', $payment->id);
	
			return redirect()->route('invoices.index')->with('success', 'Invoice canceled successfully.');
		
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("Invoice #".$payment_id." not Found!")->withInput();
		}
	}

}
