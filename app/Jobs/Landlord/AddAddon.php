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
use App\Helpers\Bo;
use App\Helpers\LandlordEventLog;

use Illuminate\Support\Facades\Log;

class AddAddon implements ShouldQueue
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
		Log::debug('Jobs.Landlord.AddAddon 0. Processing Site='.$checkout->site);

		// create service	
		Log::debug('Jobs.Landlord.AddAddon 1. Calling createCheckoutService');
		$service_id = bo::createCheckoutService($this->checkout_id);

		// generate first invoice for this account and notify
		Log::debug('Jobs.Landlord.AddAddon 2. Calling createCheckoutInvoice');
		$invoice_id = bo::createCheckoutInvoice($this->checkout_id);
		if ($invoice_id == 0){
			Log::error('Jobs.Landlord.AddAddon.createCheckoutInvoice ERROR  Invoice Could not generated!');
			exit;
		} else {
			$checkout->invoice_id	= $invoice_id;
			$checkout->save();
		}

		// pay this first invoice and notify
		//$payment_id = self::payInvoice($invoice_id);
		Log::debug('Jobs.Landlord.AddAddon 3. Calling payCheckoutInvoice');
		$payment_id = bo::payCheckoutInvoice($checkout->invoice_id );

		// update account

		// update addon sold_qty column
		$addon			= Product::where('id', $checkout->product_id )->first();
		$addon->sold_qty	= $addon->sold_qty+1;
		$addon->save();

		// update account with user+GB+service name
		$account			= Account::where('id', $checkout->account_id)->first();
		$account->user		= $account->user + $addon->user;
		$account->gb		= $account->gb + $addon->gb;
		$account->price		= $account->price + $addon->price;
		$account->save();
		Log::channel('bo')->info('Account qty updated for account_id=' .  $account->id);

		// mark checkout as complete
		$checkout->status_code = LandlordCheckoutStatusEnum::COMPLETED->value;
		$checkout->update();
		Log::debug('Jobs.Landlord.AddAddon 4. Done');
	}
}
