<?php

namespace App\Jobs\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

//use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\PaymentStatusEnum;
//use App\Enum\Tenant\PaymentStatusEnum;

use App\Models\Tenant\Invoice;
use App\Models\Tenant\Payment;

use Illuminate\Support\Facades\Log;

use Str;
use DB;

class CloseInvoice implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $payment_id;
	//protected $fc_amount;		// This is needed for canceled invoices
	//protected $cancel;

	/**
	 * Create a new job instance.
	 */
	public function __construct($payment_id)
	{
		$this->payment_id 	= $payment_id;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{

		Log::debug('Jobs.Tenant.CloseInvoice check Invoice close from payment_id = ' . $this->payment_id);

		$payment	= Payment::with('invoice')->where('id', $this->payment_id)->firstOrFail();

		//'status')->default(InvoiceStatusEnum::DRAFT->value);
		//$table->string('payment_status')->default(PaymentStatusEnum::DUE->value);
		Log::debug('Jobs.Tenant.CloseInvoice payment->status = ' . $payment->status);

		if ($payment->status == PaymentStatusEnum::CANCELED->value){
			// make PAID invoice DUE if not already
			Log::debug('Jobs.Tenant.CloseInvoice opening invoice_id = ' . $payment->invoice_id);
			Invoice::where('id', $payment->invoice_id)
				->where('payment_status', PaymentStatusEnum::PAID->value)
				->update(['payment_status'=> PaymentStatusEnum::DUE->value]);
			return;
		}

		// check if invoice is full paid
		$sum_paid_amount	= Payment::where('invoice_id',$payment->invoice_id)->sum('amount');
		if ( $payment->invoice->amount == $sum_paid_amount) {
			// total invoice amount paid
			Log::debug('Jobs.Tenant.CloseInvoice full paid closing invoice_id = ' . $payment->invoice_id);
			Invoice::where('id', $payment->invoice_id)
				->where('payment_status', PaymentStatusEnum::DUE->value)
				->update(['payment_status'=> PaymentStatusEnum::PAID->value]);
		}
	}
}
