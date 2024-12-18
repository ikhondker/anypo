<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			CountryController.php
* @brief		This file contains the implementation of the CountryController
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



use App\Models\Tenant\Lookup\Country;
use App\Http\Requests\Tenant\Lookup\StoreCountryRequest;
use App\Http\Requests\Tenant\Lookup\UpdateCountryRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Seeded
use Illuminate\Support\Facades\Log;
use DB;
# 12. FUTURE
# 1. Disable all country by default, enable only USA and based on active user will be able to select country in Any Address

class CountryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Country::class);

		$countries = Country::query();
		if (request('term')) {
			$countries->where('name', 'Like', '%'.request('term').'%');
		}
		$countries = $countries->orderBy('enable', 'DESC')->orderBy('country', 'ASC')->paginate(25);

		return view('tenant.lookup.countries.index', compact('countries'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Country::class);

		return view('tenant.lookup.countries.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCountryRequest $request)
	{
		$this->authorize('create', Country::class);
		$country = Country::create($request->all());
		// Write to Log
		EventLog::event('country', $country->country, 'create');

		return redirect()->route('countries.index')->with('success', 'Country created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Country $country)
	{
		$this->authorize('view', $country);

		return view('tenant.lookup.countries.show', compact('country'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Country $country)
	{
		$this->authorize('update', $country);

		return view('tenant.lookup.countries.edit', compact('country'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCountryRequest $request, Country $country)
	{
		$this->authorize('update', $country);

		//$request->validate();
		$request->validate([
		]);

		// Write to Log
		EventLog::event('country', $country->name, 'update', 'name', $request->name);
		$country->update($request->all());

		return redirect()->route('countries.index')->with('success', 'Country information updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Country $country)
	{

		$this->authorize('delete', $country);
		$country->fill(['enable' => ! $country->enable]);
		$country->update();

		// Write to Log
		EventLog::event('country', $country->country, 'update', 'enable', $country->enable);

		return redirect()->route('countries.index')->with('success', 'Country status Updated successfully.');
	}

	public function export()
	{
		$this->authorize('export', Country::class);

		$data = DB::select("SELECT country, name, IF(enable, 'Yes', 'No') AS enable
		FROM countries");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper

		return Export::csv('countries', $dataArray);
	}
}
