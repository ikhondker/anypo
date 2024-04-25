<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			AelController.php
* @brief		This file contains the implementation of the AelController
* @path			\app\Http\Controllers\Tenant
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

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Ael;
use App\Http\Requests\Tenant\StoreAelRequest;
use App\Http\Requests\Tenant\UpdateAelRequest;

# 1. Models
use App\Models\Tenant\Admin\Setup;

# 2. Enums
use App\Enum\EntityEnum;

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
use Illuminate\Http\Request;

class AelController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Ael::class);
		$aels = Ael::query();

		Log::debug('tenant.ael.index Value of action=' . request('action'));

		// TODO CHECK 
		if (request('start_date') && tenant()) {
			$start_date = 	request('start_date');
			$end_date	=	request('end_date');
			Log::debug('tenant.ael.index Value of start_date=' . request('start_date'));
			Log::debug('tenant.ael.index  Value of end_date=' . request('end_date'));
		}

		switch (request('action')) {
			case 'search':
				// Search model
				$aels->whereBetween('accounting_date', [$start_date, $end_date ]);
				break;
			case 'export':
				// Export model
				$sql = "
					SELECT id, source, entity, event, accounting_date, ac_code, line_description, 
					fc_currency currency, fc_dr_amount dr_amount, fc_cr_amount cr_amount, 
					po_id, reference
					FROM aels 
					WHERE DATE(accounting_date) BETWEEN '".$start_date."' AND '".$end_date."'
				";
				//Log::debug('tenant.ael.export'.$sql);

				$data = DB::select($sql);
				$dataArray = json_decode(json_encode($data), true);
				// used Export Helper
				return Export::csv('aels', $dataArray);
				break;
		}
	
		// if (request('term')) {
		// 	$aels->where('po_id', 'Like', '%' . request('term') . '%');
		// }

		$aels = $aels->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.aels.index', compact('aels'));
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
	public function store(StoreAelRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Ael $ael)
	{
		$this->authorize('view', $ael);

		return view('tenant.aels.show', compact('ael'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Ael $ael)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateAelRequest $request, Ael $ael)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Ael $ael)
	{
		//
	}

	public function xxexport()
	{
		$this->authorize('export', Ael::class);

		if (request('start_date') && request('end_date') ) {
			$start_date=request('start_date');
			$end_date=request('end_date');
			Log::debug('tenant.ael.export Value of start_date=' . request('start_date'));
			Log::debug('tenant.ael.export  Value of end_date=' . request('end_date'));
		} else {
			Log::debug('tenant.ael.export  EMPTY');
		}

		
		if (request('start_date')) {
			Log::debug('ee Value of start_date=' . request('start_date'));
		}
		if (request('end_date')) {
			Log::debug('ee Value of end_date=' . request('end_date'));
		}
	}

	public function exportForPo($id)
	{
		$this->authorize('export', Ael::class);

		$data = DB::select("
			SELECT id, source, entity, event, accounting_date, ac_code, line_description, 
			fc_currency currency, fc_dr_amount dr_amount, fc_cr_amount cr_amount, 
			po_id, reference
			FROM aels 
			WHERE po_id = ".$id."");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('aels-po-'.$id, $dataArray);
	}
}
