<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			ExchangeRate.php
* @brief		This file contains the implementation of the ExchangeRate
* @path			\app\Helpers\Tenant
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Helpers\Tenant;

use File;

use Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

// Enums
use Carbon\Carbon;
use App\Models\Tenant\Lookup\Rate;
use App\Models\Tenant\Admin\Setup;
use App\Helpers\EventLog;

use DB;

// called from PrController.submit and PoController.submit
// $rate = ExchangeRate::getRate($pr->currency, $setup->currency);

// called form Dashboard.index Setup.freeze
// called form CurrencyController.destroy 
// ImportAllRate::dispatch();


class ExchangeRate
{
	// called for pr.submit and po.submit
	public static function getRate($currency, $fc_currency)
	{
		Log::debug('Helpers.Tenant.ExchangeRate.getRate getting rate for currency = ' . $currency.' fc_currency = '.$fc_currency);
		// check if rate exists
		$rate = 0;
		try {
			$rate = Rate::where('rate_date', Carbon::now()->startOfMonth())
				->where('currency', $currency)
				->where('fc_currency', $fc_currency)
				->firstOrFail();
			Log::debug('Helpers.Tenant.ExchangeRate.getRate Rate Found = '.$rate->rate);
			return $rate->rate;
		} catch (\Exception $exception) {
			// General Exception class which is the parent of all Exceptions
			//Log::debug('ExchangeRate.getRate Still rate not found after importing data');
			Log::error('Helpers.Tenant.ExchangeRate.getRate rate not found currency = ' . $currency.' fc_currency = '.$fc_currency);
			return 0;
		}
	}

	// called form Job ImportAllRate
	public static function importRates()
	{
		// download rates

		$setup = Setup::first();
		$fc_currency = $setup->currency;
		Log::debug("Helpers.Tenant.ExchangeRate.importRates fc_currency = ".$fc_currency);

		$apikey			= 'be73b7dba663446bb6214e87048df5e0';
		$fc_currency	= urlencode($fc_currency);

		// Note: openexchangerates always return USD as base currency
		// https://openexchangerates.org/api/latest.json?app_id=be73b7dba663446bb6214e87048df5e0&base=USD
		$url		= 'https://openexchangerates.org/api/latest.json?app_id='.$apikey.'&base=USD';
		$response 	= Http::get($url);

		// Exclude TOO SMALL
		//"BTC": 0.000033653167,
		$exclude = array("BTC", "XAU", "XPD", "XPT");

		if ($response->ok()) {

			$json = $response->json();

			// Always USD
			// oe stand for openexchange
			$oe_base = $json['base'];
			Log::debug('Helpers.Tenant.ExchangeRate.importRates Openexchangerates Base Currency = '. $oe_base);

			//get all rates data
			$rates = $json['rates'];

			// USD to tenant fc currency exchange rate
			$usd_to_fc = (float) $rates[$fc_currency];
			Log::debug('Helpers.Tenant.ExchangeRate.importRates USD to tenant FC currency '.$setup->currency." = ". $usd_to_fc);

			//$currencies = Currency::primary()->orderBy('id', 'DESC');

			$sql= "SELECT currency
				FROM currencies c
				WHERE c.enable = true
				AND c.currency NOT IN (SELECT r.currency
					FROM rates r
					WHERE 1 = 1
					AND r.fc_currency = '".$setup->currency."'
					AND DATE(now()) NOT BETWEEN DATE(r.from_date) and DATE(r.to_date))
				";
			// Log::debug('Helpers.Tenant.ExchangeRate.importRates sql = '.$sql);
			$currencies = DB::select($sql);

			Log::debug('Helpers.Tenant.ExchangeRate.importRates looping in all Enabled Currencies ...');
			foreach ($currencies as $currency) {
				Log::debug('Helpers.Tenant.ExchangeRate.importRates Inserting rate for Currency = '. $currency->currency);
				$cur_currency 		= $currency->currency;
				$usd_to_currency 	= (float) $rates[$cur_currency];
				//Log::debug('usd_to_currency = '. $usd_to_currency);
				$base_rate			= (float) $usd_to_currency / $usd_to_fc;
				//Log::debug('base_rate='. $base_rate);

				// insert in exchange table

				$rate				= new Rate();
				$rate->rate_date	= Carbon::now()->startOfMonth();
				$rate->fc_currency	= $fc_currency;
				$rate->currency		= $cur_currency;
				$rate->from_date	= Carbon::now()->startOfMonth();
				$rate->to_date		= Carbon::now()->endOfMonth();
				$rate->rate			= round(1 / $base_rate, 8);
				$rate->inverse_rate	= round($base_rate, 8);
				$rate->save();
				Log::debug("Helpers.Tenant.ExchangeRate.importRates base=".$rate->currency.' to_currency='.$rate->fc_currency.' rate='.$rate->rate .' inv rate='.$rate->inverse_rate );
			}
			Log::debug('Helpers.Tenant.ExchangeRate.importRates looping complete for all Enabled Currencies.');

			// set back the last rate import date
			$setup = Setup::first();
			$setup->last_rate_date = Carbon::now()->startOfMonth();
			$setup->save();
			Log::debug('Helpers.Tenant.ExchangeRate.importRates updating setup->last_rate_date with '.$setup->last_rate_date);

			// Write to Log
			EventLog::event('rates', $setup->id, 'import');

			return true;
		} else {
			Log::warning("Helpers.Tenant.ExchangeRate.importRates Http::get Response ERROR. Please Try again.");
			return false;
		}
	}
}
