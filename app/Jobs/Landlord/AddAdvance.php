<?php

namespace App\Jobs\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Landlord\Lookup\Product;
use App\Models\Landlord\Manage\Checkout;
use App\Models\Landlord\Account;

// Enums
use App\Enum\Landlord\CheckoutStatusEnum;

// Helpers
use App\Helpers\Landlord\Bo;
use App\Helpers\EventLog;

use Illuminate\Support\Facades\Log;

class AddAdvance implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	public $timeout = 1200;
	public $failOnTimeout = true;

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
		Log::debug('Jobs.Landlord.AddAdvance 0. Processing Site = '.$checkout->site);

		// generate first invoice for this account and notify
		Log::debug('Jobs.Landlord.AddAdvance 1. Calling bo::createInvoiceForCheckout');
		$invoice_id = bo::createInvoiceForCheckout($this->checkout_id);
		if ($invoice_id == 0){
			Log::error('Jobs.Landlord.AddAdvance.createCheckoutInvoice ERROR. Invoice Could not generated!');
			exit;
		} else {
			$checkout->invoice_id	= $invoice_id;
			$checkout->save();
		}

		// pay this invoice and notify
		Log::debug('Jobs.Landlord.AddAdvance 3. bo::Calling payCheckoutInvoice');
		$payment_id = bo::payCheckoutInvoice($checkout->invoice_id );
		if ( $payment_id == 0){
			Log::error('Jobs.Landlord.AddAdvance payCheckoutInvoice FAIL. Stop.');
		} else {
			//extend account validity and end_date
			Log::debug('Jobs.Landlord.AddAdvance 4. Calling bo::extendAccountValidity');
			$account_id= bo::extendAccountValidity($invoice_id);
			if ( $account_id == 0){
				Log::error('Jobs.Landlord.AddAdvance extendAccountValidity FAIL. Stop');
			} else {
				// mark checkout as complete
				$checkout->status_code = CheckoutStatusEnum::COMPLETED->value;
				$checkout->update();
				Log::debug('Jobs.Landlord.AddAdvance 4. Done');
			}
		}

	}
}
