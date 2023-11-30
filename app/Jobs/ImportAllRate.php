<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Helpers\ExchangeRate;

class ImportAllRate implements ShouldQueue,  ShouldBeUnique
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
        //Called fomr CurrencyController.php: and  DashboardController.php
   
        // Import exchange rate for all current enabled currency
        $x = ExchangeRate::importRates();
        //$x = GetRate::getRate('USD','BDT');
        //echo $x;
        Log::debug("Inside handle of ImportAllRateJob!");
    }
}
