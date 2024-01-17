<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Payment;
use App\Models\Tenant\Po;

use App\Models\Tenant\Lookup\BankAccount;
use App\Http\Requests\Tenant\StorePaymentRequest;
use App\Http\Requests\Tenant\UpdatePaymentRequest;
# Enums
use App\Enum\EntityEnum;
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\FileUpload;



class PaymentController extends Controller
{

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Models\Pol  $pol
	 * @return \Illuminate\Http\Response
	 */
	public function createForPo($po_id)
	{

		$this->authorize('view', Payment::class);

		
		$po = Po::where('id', $po_id)->first();
	
		
		$bank_accounts = BankAccount::primary()->get();

		return view('tenant.payments.create-for-po', with(compact('po','bank_accounts')));
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Payment::class);

		$payments = Payment::query();
		if (request('term')) {
			$payments->where('name', 'Like', '%' . request('term') . '%');
		}
		$payments = $payments->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.payments.index', compact('payments'))->with('i', (request()->input('page', 1) - 1) * 10);
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
	public function store(StorePaymentRequest $request)
	{
		$this->authorize('create', Payment::class);

		$request->merge(['payee_id'	=> 	auth()->user()->id ]);
		$payment = Payment::create($request->all());

		// update PR header
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
		return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Payment $payment)
	{
		$this->authorize('view', $payment);
		return view('tenant.payments.show', compact('payment'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Payment $payment)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePaymentRequest $request, Payment $payment)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Payment $payment)
	{
		//
	}

	public function export()
	{
		$this->authorize('export', Payment::class);

		$data = DB::select("SELECT id, pay_date, payee_id, po_id, bank_account_id, cheque_no, currency, amount, fc_currency, fc_exchange_rate, fc_amount, for_entity, notes, status, created_by, created_at, updated_by, updated_at, FROM payments
		");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('payments', $dataArray);
	}


}
