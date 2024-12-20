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
		$checkout->status_code = CheckoutStatusEnum::PROCESSING->value ;
		$checkout->update();
		Log::debug('Jobs.Landlord.AddAddon 0. Processing Site = '.$checkout->site);

		// create add service
		Log::debug('Jobs.Landlord.AddAddon 1. Calling bo::createServiceForCheckout');
		$service_id = bo::createServiceForCheckout($this->checkout_id);

		// generate invoice and notify
		Log::debug('Jobs.Landlord.AddAddon 2. Calling bo::createInvoiceForCheckout');
		$invoice_id = bo::createInvoiceForCheckout($this->checkout_id);
		if ($invoice_id == 0){
			Log::error('Jobs.Landlord.AddAddon.createCheckoutInvoice ERROR Invoice Could not generated!');
			exit;
		} else {
			$checkout->invoice_id	= $invoice_id;
			$checkout->save();
		}

		// pay this invoice and notify
		Log::debug('Jobs.Landlord.AddAddon 3. Calling bo::payCheckoutInvoice');
		$payment_id = bo::payCheckoutInvoice($checkout->invoice_id );

		// update product addon sold_qty column
		$addon				= Product::where('id', $checkout->product_id )->first();
		$addon->sold_qty	= $addon->sold_qty+1;
		$addon->save();

		// update account with user+GB+service name
		$account				= Account::where('id', $checkout->account_id)->first();
		$account->user			= $account->user + $addon->user;
		$account->gb			= $account->gb + $addon->gb;

		// increment monthly_addon and update account->price
		$account->monthly_addon	= $account->monthly_addon + $addon->price;
		$account->price			= $account->monthly_fee + $account->monthly_addon;
		$account->save();
		Log::channel('bo')->info('Jobs.Landlord.AddAddon Account qty updated for account_id = ' . $account->id);

		// mark checkout as complete
		$checkout->status_code = CheckoutStatusEnum::COMPLETED->value;
		$checkout->update();
		Log::debug('Jobs.Landlord.AddAddon 4. Done');

	}
}
