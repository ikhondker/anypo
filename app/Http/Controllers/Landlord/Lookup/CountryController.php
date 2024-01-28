<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			CountryController.php
* @brief		This file contains the implementation of the CountryController
* @path			\app\Http\Controllers\Landlord\Lookup
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

namespace App\Http\Controllers\Landlord\Lookup;

use App\Http\Controllers\Controller;

use App\Models\Landlord\Lookup\Country;
use App\Http\Requests\Landlord\Lookup\StoreCountryRequest;
use App\Http\Requests\Landlord\Lookup\UpdateCountryRequest;

use App\Helpers\LandlordEventLog;

use Str;

class CountryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Country::class);

		$countries = Country::query();
		if (request('term')) {
			 $countries->where('name', 'Like', '%'.request('term').'%');
		}
		$countries = $countries->orderBy('name', 'ASC')->paginate(40);
 
		 return view('landlord.lookup.countries.index', compact('countries'))->with('i', (request()->input('page', 1) - 1) * 40);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCountryRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Country $country)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Country $country)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCountryRequest $request, Country $country)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Country $country)
	{
		$this->authorize('delete', $user);

		$country->fill(['enable'=>!$country->enable]);
		$country->update();

		// Write to Log
		LandlordEventLog::event('country',$country->country,'status','enable',$country->enable);

		return redirect()->route('countries.index')->with('success','Country Status Updated successfully');
	}
}
