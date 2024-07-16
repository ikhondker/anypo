<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			AehController.php
* @brief		This file contains the implementation of the AehController
* @path			\app\Http\Controllers\Tenant\Ae
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

namespace App\Http\Controllers\Tenant\Ae;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Ae\Aeh;
use App\Http\Requests\Tenant\Ae\StoreAehRequest;
use App\Http\Requests\Tenant\Ae\UpdateAehRequest;

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
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Exception;
# 13. FUTURE


class AehController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Aeh::class);
		$aehs = Aeh::query();

		Log::debug('tenant.ae.aeh.index Value of action = ' . request('action'));

		// TODO CHECK
		if (request('start_date') && tenant()) {
			$start_date = 	request('start_date');
			$end_date	=	request('end_date');
			Log::debug('tenant.ae.aeh.index Value of start_date = ' . request('start_date'));
			Log::debug('tenant.ae.aeh.index Value of end_date = ' . request('end_date'));
		}

		switch (request('action')) {
			case 'search':
				// Search model
				$aehs->whereBetween('accounting_date', [$start_date, $end_date ]);
				break;
			case 'export':
				// Export model
				$sql = "
					SELECT id, source, entity, event, accounting_date, ac_code, line_description,
					fc_currency currency, fc_dr_amount dr_amount, fc_cr_amount cr_amount,
					po_id, reference
					FROM aehs
					WHERE DATE(accounting_date) BETWEEN '".$start_date."' AND '".$end_date."'
				";
				//Log::debug('tenant.ae.ael.export'.$sql);

				$data = DB::select($sql);
				$dataArray = json_decode(json_encode($data), true);
				// used Export Helper
				return Export::csv('aehs', $dataArray);
				break;
		}

		// if (request('term')) {
		// 	$aels->where('po_id', 'Like', '%' . request('term') . '%');
		// }

		$aehs = $aehs->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.ae.aehs.index', compact('aehs'));
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
	public function store(StoreAehRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Aeh $aeh)
	{
		$this->authorize('view', $aeh);

		return view('tenant.ae.aehs.show', compact('aeh'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Aeh $aeh)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateAehRequest $request, Aeh $aeh)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Aeh $aeh)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function manual()
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function manualAeh()
	{
		abort(403);
	}
}
