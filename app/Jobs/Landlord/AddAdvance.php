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
use App\Enum\LandlordCheckoutStatusEnum;

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
		$checkout->status_code = LandlordCheckoutStatusEnum::PROCESSING->value ;
		$checkout->update();
		Log::debug('Jobs.Landlord.AddAdvance 0. Processing Site = '.$checkout->site);

		// generate first invoice for this account and notify
		Log::debug('Jobs.Landlord.AddAdvance 1. Calling createInvoiceForCheckout');
		$invoice_id = bo::createInvoiceForCheckout($this->checkout_id);
		if ($invoice_id == 0){
			Log::error('Jobs.Landlord.AddAdvance.createCheckoutInvoice ERROR. Invoice Could not generated!');
			exit;
		} else {
			$checkout->invoice_id	= $invoice_id;
			$checkout->save();
		}

		// pay this invoice and notify
		// TODO check if payment is successful
		Log::debug('Jobs.Landlord.AddAdvance 3. Calling payCheckoutInvoice');
		$payment_id = bo::payCheckoutInvoice($checkout->invoice_id );

		//extend account validity and end_date
		$account_id= bo::extendAccountValidity($invoice_id);

		// mark checkout as complete
		$checkout->status_code = LandlordCheckoutStatusEnum::COMPLETED->value;
		$checkout->update();
		Log::debug('Jobs.Landlord.AddAdvance 4. Done');
	}
}
