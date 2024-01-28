<?php

namespace App\Jobs\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Models
use App\Models\User;
use App\Models\Landlord\Account;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;

// Enums
use App\Enum\LandlordInvoiceStatusEnum;
use App\Enum\LandlordPaymentStatusEnum;

// Helpers
use App\Helpers\LandlordEventLog;

// notification
use Notification;
use App\Notifications\Landlord\InvoicePaid;

// Seeded
use Illuminate\Support\Facades\Log;

class SubscriptionInvoicePaid implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $payment_id;

	/**
	 * Create a new job instance.
	 */
	public function __construct($payment_id)
	{
		$this->payment_id = $payment_id;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		$payment = Payment::where('id', $this->payment_id)->first();

		// mark invoice as paid
		$invoice = Invoice::where('id', $payment->invoice_id)->first();
		$invoice->amount_paid = $payment->amount;
		$invoice->status_code = LandlordInvoiceStatusEnum::PAID->value ;
		$invoice->update();

		// mark payment as paid
		$payment->status_code = LandlordPaymentStatusEnum::PAID->value;
		$payment->update();
		LandlordEventLog::event('payment', $payment->id, 'create');

		// Invoice Paid Notification
		$user = User::where('id', $invoice->owner_id)->first();
		$user->notify(new InvoicePaid($user, $invoice, $payment));

		//extend account validity end_date
		$account = Account::where('id', $invoice->account_id)->first();
		$account->next_bill_generated	= false;
		$account->next_invoice_no		= 0;
		$account->end_date				= $invoice->end_date;

		$account->save();
		Log::debug('jobs.SubscriptionInvoicePaid Account validity extended =' . $account->id);
	}
}
