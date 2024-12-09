<?php

namespace App\Jobs\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Models

// Helpers

// Seeded
use Illuminate\Support\Facades\Log;

use App\Models\Tenant;

class SyncLandlord implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $checkout_id;

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
		// TODO loop all tenant
		$tenants = Tenant::all();
		foreach ($tenants as $tenant) {
			Log::debug('Jobs.Landlord.SyncLandlord $tenant->id = '.$tenant->id);
			$setup = $tenant->run(function(){
					return \App\Models\Tenant\Admin\Setup::first();
				}
			);
			Log::debug('Jobs.Landlord.SyncLandlord setup_id = '.$setup->id);
			Log::debug('Jobs.Landlord.SyncLandlord setup_name = '.$setup->name);
			// update account based on this
		}
		//Log::debug('Jobs.Landlord.SyncLandlord 0. Processing Site = ');
	}
}
