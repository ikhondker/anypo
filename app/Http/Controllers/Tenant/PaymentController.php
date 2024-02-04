<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Payment;
use App\Models\Tenant\Po;
use App\Models\Tenant\Invoice;

use App\Models\Tenant\Lookup\BankAccount;
use App\Http\Requests\Tenant\StorePaymentRequest;
use App\Http\Requests\Tenant\UpdatePaymentRequest;
# Enums
use App\Enum\EntityEnum;
use App\Enum\UserRoleEnum;
use App\Enum\PaymentStatusEnum;
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\FileUpload;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Payment::class);

		$payments = Payment::query();
		if (request('term')) {
			$payments->where('name', 'Like', '%' . request('term') . '%');
		}
		switch (auth()->user()->role->value) {
			case UserRoleEnum::BUYER->value:
				// buyer can see all payment of all his po's
				$payments = $payments->ByPoBuyer(auth()->user()->id)->paginate(10);
				break;
			case UserRoleEnum::HOD->value:
				$payments = $payments->ByPoDept(auth()->user()->dept_id)->paginate(10);
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$payments = $payments->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$payments = $payments->ByUserAll()->paginate(10);
				Log::debug("payment.index Other roles!");
		}
		return view('tenant.payments.index', compact('payments'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Invoice $invoice)
	{
		$this->authorize('create', Payment::class);
				
		$po = Po::where('id', $invoice->po_id)->first();
			
		$bank_accounts = BankAccount::primary()->get();

		return view('tenant.payments.create-for-po', with(compact('po','invoice','bank_accounts')));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StorePaymentRequest $request)
	{
		$this->authorize('create', Payment::class);

		$request->merge(['payee_id'	=> 	auth()->user()->id ]);
		$payment = Payment::create($request->all());

		// update Invoice  header
		$invoice 				= Invoice::where('id', $payment->invoice_id)->firstOrFail();
		$invoice->paid_amount	= $invoice->paid_amount + $payment->amount;
		$invoice->save();

		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $payment->id ]);
			$request->merge(['entity'		=> EntityEnum::PAYMENT->value ]);
			$attid = FileUpload::upload($request);
		}

		// Write to Log
		EventLog::event('payment', $payment->id, 'create');
		return redirect()->route('payments.create',$invoice->id)->with('success', 'Payment created successfully.');
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

	/**
	 * Show the form for creating a new resource.
	 */
	public function getCancelPayNum()
	{

		//$this->authorize('cancel',Payment::class);
		
		return view('tenant.payments.cancel');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	// public function cancel(StorePaymentRequest $request)
	public function cancel(Payment $payment)
	{
	
		$this->authorize('cancel',Payment::class);
		$payment_id = $payment->id;

		try {
			$payment = Payment::where('id', $payment_id)->firstOrFail();

			if ($payment->status->value <> PaymentStatusEnum::PAID->value) {
				return back()->withError("You can only cancel payment with status paid!")->withInput();
			}
	
			//  Reverse Invoice Payment
			$invoice 				= Invoice::where('id', $payment->invoice_id)->firstOrFail();
			$invoice->paid_amount	= $invoice->paid_amount - $payment->amount;
			$invoice->save();

			// cancel Payment
			Payment::where('id', $payment->id)
				->update([
					'amount' => 0,
					'status' => PaymentStatusEnum::VOID->value
				]);
	
			// Write to Log
			EventLog::event('payment', $payment->id, 'void', 'id', $payment->id);
	
			return redirect()->route('payments.index')->with('success', 'Payment canceled successfully.');
		
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			return back()->withError("Payment #".$payment_id." not Found!")->withInput();
		}
	}


}
