<?php

namespace App\Jobs\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Helpers\ExchangeRate;

class ImportAllRate implements ShouldQueue, ShouldBeUnique
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
		// Called from CurrencyController.php: and DashboardController.php
		// Import exchange rate for all current enabled currency
		Log::debug("Jobs.tenant.ImportAllRateJob.handle calling ExchangeRate::importRates()");
		$x = ExchangeRate::importRates();
	}
}
