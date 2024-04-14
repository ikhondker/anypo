<?php

namespace App\Jobs\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


// Controller
use App\Http\Controllers\Landlord\InvoiceController;


// Models
use App\Models\User;
use App\Models\Landlord\Account;
use App\Models\Landlord\Admin\Invoice;

use App\Models\Landlord\Manage\Process;
use App\Models\Landlord\Manage\Config;

// Enums
use App\Enum\InvoiceStatusEnum;
use App\Enum\LandlordAccountStatusEnum;

# Job
use App\Jobs\Landlord\CreateInvoice;

// Helpers

// Seeded
use Str;
use Illuminate\Support\Facades\Log;


class Billing implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		$config = Config::first();

		// Create a blank invoice. Not model but Controller
		//$invoice = new InvoiceController();

		// end_date is approaching now()
		// and bill_from_date <> start_date i.e. next bill is generated
		// bill is generated always for next cycle

		// get all active account for which has bill_generated is false
		// $diff = now()->diffInDays($model->created_at);
		//$accounts= Account::where('bill_generated', false)->where('enable', true)->orderBy('id', 'ASC')->get();

		// all account where end_date is earlier than now()-7 dayss
		// 			->where('end_date', '<', now()->subDays(7))

		$accounts = Account::where('status_code', LandlordAccountStatusEnum::ACTIVE->value)
			->where('next_bill_generated', false)
			//->where('id', 1005 )
			->orderBy('id', 'ASC')
			->get();

		foreach ($accounts as $account) {
			// Generate invoice 5 days before expire
			$diff = now()->diffInDays($account->end_date);
			if ($diff <= $config->days_gen_bill) {
				Log::debug('Jobs.Billing.handle Generating Invoice for account_id=' . $account->id);
				CreateInvoice::dispatch($account->id, 1);
			} else {
				Log::debug('Jobs.Billing.handle skipping Account id=' . $account->id. ". Days remains ". $diff );
			}
		}
	}
}
