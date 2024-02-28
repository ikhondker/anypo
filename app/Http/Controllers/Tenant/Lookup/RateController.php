<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			RateController.php
* @brief		This file contains the implementation of the RateController
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


use App\Models\Tenant\Lookup\Rate;
use Illuminate\Http\Request;

# 1. Models
# 2. Enums
# 3. Helpers
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Seeded
# 12. TODO 


# Models
# Enums
# Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# Notifications
# Mails
# Packages
# Seeded
use DB;
use Illuminate\Support\Facades\Log;

# Exceptions
# Events

class RateController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Rate::class);

		$rates = Rate::query();
		if (request('term')) {
			$rates->where('to_currency', 'Like', '%' . request('term') . '%');
		}
		$rates = $rates->orderBy('rate_date', 'DESC')->paginate(25);
		return view('tenant.lookup.rates.index', compact('rates'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Rate $rate)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Rate $rate)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Rate $rate)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Rate $rate)
	{
		//
	}

	/**
	 * Export selected column to csv format
	 */
	public function export()
	{
		$this->authorize('export', Rate::class);
		
		//$data = Uom::all()->toArray();
		$data = DB::select('
		SELECT id, rate_date, currency, fc_currency, from_date, to_date, rate, inverse_rate FROM rates
			');

		$dataArray = json_decode(json_encode($data), true);

		// export to CSV
		return Export::csv('rates', $dataArray);
	}
}
