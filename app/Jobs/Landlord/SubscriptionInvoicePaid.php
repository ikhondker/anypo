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
use App\Models\Landlord\Manage\Checkout;

// Enums
use App\Enum\Landlord\CheckoutStatusEnum;
use App\Enum\Landlord\PaymentStatusEnum;
use App\Enum\Landlord\InvoiceStatusEnum;
use App\Enum\Landlord\PaymentMethodEnum;


// Helpers
use App\Helpers\EventLog;
use App\Helpers\Landlord\Bo;

// notification
use Notification;
use App\Notifications\Landlord\InvoicePaid;

// Seeded
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SubscriptionInvoicePaid implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $checkout_id;

	/**
	 * Create a new job instance.
	 */
	public function __construct($checkout_id)
	{
		$this->checkout_id = $checkout_id;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{

        // mark checkout as processing
		$checkout = Checkout::where('id', $this->checkout_id )->first();
		$checkout->status_code = CheckoutStatusEnum::PROCESSING->value ;
		$checkout->update();

		Log::debug('Jobs.Landlord.SubscriptionInvoicePaid 0. Processing Site = '.$checkout->site);
        Log::debug('Jobs.Landlord.SubscriptionInvoicePaid 0. Processing invoice_id = '.$checkout->invoice_id);

       // pay this invoice and notify
        // pay this invoice and notify
		// TODO check if payment is successful
		Log::debug('Jobs.Landlord.AddAdvance 1. Calling bo::payCheckoutInvoice');
		$payment_id = bo::payCheckoutInvoice($checkout->invoice_id );

		// $payment						= new Payment;
		// $payment->session_id			= $checkout->session_id;
		// $payment->pay_date				= date('Y-m-d H:i:s');
		// $payment->invoice_id			= $invoice->id;
		// $payment->account_id			= $invoice->account_id;
		// $payment->summary				= $invoice->summary;
		// $payment->payment_method_code	= PaymentMethodEnum::CARD->value;
		// $payment->amount				= $invoice->amount;
        // $payment->status_code = PaymentStatusEnum::PAID->value;         // mark payment as paid
        // if (auth()->check()) {
        //     $payment->owner_id			= auth()->user()->id;
		// } else {
        //     //
		// }
        // $payment->ip					= request()->ip();
		// $payment->save();
		// EventLog::event('payment', $payment->id, 'create');

		// mark invoice as paid
		// $invoice->amount_paid = $payment->amount;
		// $invoice->status_code = InvoiceStatusEnum::PAID->value ;
		// $invoice->update();
		// Log::debug('jobs.Landlord.SubscriptionInvoicePaid invoice end_date = ' . $invoice->to_date);

		// extend account validity and end_date
        // create payment from invoice
        Log::debug('Jobs.Landlord.SubscriptionInvoicePaid 1. Calling bo::extendAccountValidity');
		$payment_id = bo::payCheckoutInvoice($checkout->invoice_id );
		$account_id= bo::extendAccountValidity($checkout->invoice_id);


        // mark checkout as complete
		$checkout->status_code = CheckoutStatusEnum::COMPLETED->value;
		$checkout->update();
		Log::debug('Jobs.Landlord.SubscriptionInvoicePaid 4. Done');


	}
}
