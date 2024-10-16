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
use App\Models\Landlord\Manage\Config;

// Seeded
use Str;
use Illuminate\Support\Facades\Log;


class AccountsArchive implements ShouldQueue
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
		Log::debug('Inside Accounts Archive. Write your code here');
		$Config = Config::first();

		$accounts = Account::
			where('status_code', AccountStatusEnum::ACTIVE->value)
			->where('next_bill_generated', true )
			->where('end_date', '>', now()->subDays($Config->days_archive))
			->orderBy('id', 'ASC')
			->get();

		foreach ($accounts as $account) {
			//
			Log::debug('Checking for archival for Account id = ' . $account->id);
		}

		//

	}
}
