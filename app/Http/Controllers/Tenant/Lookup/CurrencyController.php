<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			CurrencyController.php
* @brief		This file contains the implementation of the CurrencyController
* @path			\App\Http\Controllers\Tenant\Lookup
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Lookup\Currency;
use App\Http\Requests\Tenant\Lookup\StoreCurrencyRequest;
use App\Http\Requests\Tenant\Lookup\UpdateCurrencyRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
# 4. Notifications
# 5. Jobs
use App\Jobs\Tenant\ImportAllRate;
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Seeded
use DB;
use Illuminate\Support\Facades\Log;
# 12. FUTURE 

class CurrencyController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Currency::class);

		$currencies = Currency::query();
		if (request('term')) {
			$currencies->where('currency', 'Like', '%' . request('term') . '%');
		}
		$currencies = $currencies->orderBy('enable', 'DESC')->orderBy('currency', 'ASC')->paginate(25);
		return view('tenant.lookup.currencies.index', compact('currencies'));

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Currency::class);

		return view('tenant.lookup.currencies.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCurrencyRequest $request)
	{
		$this->authorize('create', Currency::class);
		$request->merge(['enable'	=> true ]);
		$currency = Currency::create($request->all());
		// Write to Log
		EventLog::event('currency', $currency->currency, 'create');

		return redirect()->route('currencies.index')->with('success', 'Currency created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Currency $currency)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Currency $currency)
	{
		$this->authorize('update', $currency);

		return view('tenant.lookup.currencies.edit', compact('currency'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCurrencyRequest $request, Currency $currency)
	{
		$this->authorize('update', $currency);

		//$request->validate();
		$request->validate([
		]);
		$currency->update($request->all());

		// Write to Log
		EventLog::event('currency', $currency->name, 'update', 'name', $request->name);

		return redirect()->route('currencies.index')->with('success', 'Currency information updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Currency $currency)
	{
		$this->authorize('delete', $color);
		$currency->fill(['enable' => !$currency->enable]);
		$currency->update();

		// Write to Log
		EventLog::event('currency', $currency->currency, 'update', 'enable', $currency->enable);

		// import rate for newly enabled currency
		if ($currency->enable) {
			//dispatch(new App\Jobs\ImportAllRate());
			ImportAllRate::dispatch();
			Log::debug("tenant.currency.destroy Rates importing for ".$currency->currency);
		}

		return redirect()->route('currencies.index')->with('success', 'Currency status updated successfully.');
	}

	public function export()
	{
		$this->authorize('export', Currency::class);

		$data = DB::select("SELECT currency, name, country, IF(enable, 'Yes', 'No') AS enable
		FROM currencies
		ORDER BY currency;
		");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('currencies', $dataArray);
	}

}
