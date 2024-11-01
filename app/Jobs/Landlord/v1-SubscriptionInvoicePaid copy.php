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
use App\Enum\Landlord\InvoiceStatusEnum;
use App\Enum\Landlord\PaymentStatusEnum;

// Helpers
use App\Helpers\EventLog;
use App\Helpers\Landlord\Bo;

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

		// mark payment as paid
		$payment->status_code = PaymentStatusEnum::PAID->value;
		$payment->update();
		EventLog::event('payment', $payment->id, 'create');

		// mark invoice as paid
		$invoice = Invoice::where('id', $payment->invoice_id)->first();
		$invoice->amount_paid = $payment->amount;
		$invoice->status_code = InvoiceStatusEnum::PAID->value ;
		$invoice->update();
		Log::debug('jobs.Landlord.SubscriptionInvoicePaid invoice end_date = ' . $invoice->to_date);

		// extend account validity and end_date
		Log::debug('jobs.Landlord.SubscriptionInvoicePaid calling extendAccountValidity for invoice_id = ' . $invoice->id);
		$account_id= bo::extendAccountValidity($invoice->id);

		// Invoice Paid Notification
		$user = User::where('id', $invoice->owner_id)->first();
		$user->notify(new InvoicePaid($user, $invoice, $payment));
	}
}
