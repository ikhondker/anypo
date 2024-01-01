<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        GetRate.php
 * @brief       This file contains the implementation of the GetRate Helper.
 * @author      Iqbal H. Khondker
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
*/
namespace App\Helpers;

use File;

use Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

// $table->enum('role', ['emp','tl','hr','finance','hradmin','management','support','admin','system'])->default('emp');
// Enums
use App\Enum\UserRoleEnum;
use Carbon\Carbon;
use App\Models\Exchange;

class GetRate
{

	public static function getRate($base_currency, $to_currency) {

		// check if budget for this year exists
		$mnth = Carbon::now()->format('m-Y');
		$base_currency='USD';
		$to_currency='EUR';
		$rate = 0;
		try {
			$ex = Exchange::where('rate_date', Carbon::now()->startOfMonth())
				->where('base_currency', $base_currency)
				->where('to_currency', $to_currency)
				->firstOrFail();
			Log::debug("Rate Found EUR=".$ex->rate);
		} catch (\Exception $exception) {
			// General Exception class which is the parent of all Exceptions
			// download rates
			//$response = Http::get('https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR');
			Log::debug("Exception Hit");

			$apikey = 'fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ';
			$from_Currency = urlencode($base_currency);
			$to_Currency = urlencode($to_currency);

			$url= 'https://api.freecurrencyapi.com/v1/latest?apikey='.$apikey.'&currencies='.$to_currency.'&base_currency='.$base_currency.'';
			Log::debug("URL=".$url);
			//$response = Http::get(urlencode($url));
			//$response = Http::get('https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR&base_currency=CAD');

			//if ($response->ok()){
			if ( true){
				//$jsonData = $response->json();
				//$data= $jsonData['data'];
				//$rate = $data[$to_currency];
				$rate ='.9876';
				Log::debug("EUR=".$rate);

				// insert in rate table
				$ex					= new Exchange;
				$ex->rate_date		= Carbon::now()->startOfMonth();
				$ex->base_currency	= $base_currency;
				$ex->to_currency	= $to_currency;
				$ex->from_date		= Carbon::now()->startOfMonth();
				$ex->to_date		= Carbon::now()->endOfMonth();
				$ex->rate			= $rate;
				$ex->inverse_rate	= 1/$rate;
				$ex->save();
				$ex_id				= $ex->id;

			} else {
				Log::debug("Http::get Response ERROR");
			}
			return $rate;
		}



		// https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR%2CUSD&base_currency=CAD
		// {
		//     "data": {
		//       "EUR": 0.6794070148,
		//       "USD": 0.7479654271
		//     }
		// }

		// https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR%2CUSD%2CCAD
		// {
		//     "data": {
		//       "CAD": 1.3369601907,
		//       "EUR": 0.9083401321,
		//       "USD": 1
		//     }
		// }

		//https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR&base_currency=CAD
		// $response = Http::get('https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR');
		// $jsonData = $response->json();
		// $data= $jsonData['data'];

		// Log::debug("EUR=".$data['EUR']);
		// Log::debug("response->ok()=".$response->ok());
		// Log::debug("response->successful()=".$response->successful());
		// Log::debug("response->serverError()=".$response->serverError() );

		// [2023-08-08 18:27:40] local.DEBUG: EUR=0.9083401321
		// [2023-08-08 18:27:40] local.DEBUG: response->ok()=1
		// [2023-08-08 18:27:40] local.DEBUG: response->successful()1
		// [2023-08-08 18:27:40] local.DEBUG: response->serverError()


		// Boolean checks on the response
		// $response->ok() : bool;
		// $response->clientError(): bool;
		// $response->successful() : bool;
		// $response->serverError() : bool;
		// $response->clientError() : bool;

		// $amount = ($request->amount)?($request->amount):(1);
		// $apikey = 'fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ';
		// $from_Currency = urlencode($request->from_currency);
		// $to_Currency = urlencode($request->to_currency);
		// $query = "{$from_Currency}_{$to_Currency}";
   	}

}