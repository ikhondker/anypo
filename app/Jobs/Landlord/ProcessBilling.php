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
use App\Enum\Tenant\InvoiceStatusEnum;
use App\Enum\Landlord\AccountStatusEnum;

# Job
use App\Jobs\Landlord\CreateMonthlyInvoice;


// Helpers

// Seeded
use Str;
use Illuminate\Support\Facades\Log;

class ProcessBilling implements ShouldQueue
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

		Log::channel('bo')->info('Jobs.Landlord.Billing.handle running at '. now());
		//Log::debug('Jobs.Landlord.Billing.handle Scheduled Cron Job running at '. now());

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

		// save lines into processes and pass to invoice creation
		$process			= new Process();
		$process->job_code	= 'BILLING';
		$process->parameter	= 'ALL';
		$process->status	= 'Submitted';
		$process->save();

		Log::channel('bo')->info('Jobs.Landlord.ProcessBilling.handle process_id = '. $process->id);
		Log::channel('bo')->info('Jobs.Landlord.ProcessBilling.handle config->days_gen_bill = '. $config->days_gen_bill);
		Log::channel('bo')->info('Jobs.Landlord.ProcessBilling.handle end date before  = '. now()->addDays($config->days_gen_bill));

		$accounts = Account::where('status_code', AccountStatusEnum::ACTIVE->value)
			->where('next_bill_generated', false)
			//->where('id', 1005 )
			->orderBy('id', 'ASC')
			->get();

		foreach ($accounts as $account) {
			//Log::debug('Jobs.Landlord.Billing.handleInvoice account_id = ' . $account->id);
			// Generate invoice 5 days before expire
			$diff = now()->diffInDays($account->end_date);
			if ($diff <= $config->days_gen_bill) {
				Log::channel('bo')->info('Jobs.ProcessBilling.handle Generating Invoice for account_id = ' . $account->id);
				CreateMonthlyInvoice::dispatch($account->id, 1, $process->id);
			} else {
				Log::channel('bo')->info('Jobs.ProcessBilling.handle Skipping account_id = ' . $account->id. " as days remains ". $diff);
			}
		}
	}
}
