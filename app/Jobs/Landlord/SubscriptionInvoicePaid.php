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
        Log::debug('Jobs.Landlord.SubscriptionInvoicePaid 1. Calling bo::payCheckoutInvoice');
        $payment_id = bo::payCheckoutInvoice($checkout->invoice_id );
        if ( $payment_id == 0){
            Log::error('Jobs.Landlord.SubscriptionInvoicePaid bo::payCheckoutInvoice FAIL. Stop.');
        } else {
            //extend account validity and end_date
            Log::debug('Jobs.Landlord.SubscriptionInvoicePaid 4. Calling bo::extendAccountValidity');
            $account_id = bo::extendAccountValidity($checkout->invoice_id);

            if ( $account_id == 0){
                Log::error('Jobs.Landlord.SubscriptionInvoicePaid bo::extendAccountValidity FAIL. Stop');
            } else {
                // mark checkout as complete
                $checkout->status_code = CheckoutStatusEnum::COMPLETED->value;
                $checkout->update();
                Log::debug('Jobs.Landlord.SubscriptionInvoicePaid 4. Done');
            }
        }
	}
}
