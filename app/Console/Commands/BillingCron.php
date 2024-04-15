<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Jobs\Landlord\Billing;

class BillingCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::channel('bo')->info('Commands.BillingCron.handle bo Cron Job running at '. now());
        Log::debug('Commands.BillingCron.handle Cron Job running at '. now());
        //Billing::dispatch();
    }
}
