<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			AelController.php
* @brief		This file contains the implementation of the AelController
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

use App\Models\Tenant\Ae\Ael;
use App\Http\Requests\Tenant\Ae\StoreAelRequest;
use App\Http\Requests\Tenant\Ae\UpdateAelRequest;

# 1. Models
use App\Models\Tenant\Admin\Setup;

# 2. Enums
use App\Enum\EntityEnum;

# 3. Helpers
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

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

		Log::debug('tenant.ae.ael.index Value of action = ' . request('action'));

		// TODO CHECK
		if (request('start_date') && tenant()) {
			$start_date = 	request('start_date');
			$end_date	=	request('end_date');
			Log::debug('tenant.ae.ael.index Value of start_date = ' . request('start_date'));
			Log::debug('tenant.ae.ael.index Value of end_date = ' . request('end_date'));
		}

		switch (request('action')) {
			case 'search':
				// Search model
				$aels->whereBetween('accounting_date', [$start_date, $end_date ]);
				break;
			case 'export':
				// Export model
				break;
		}

		$aels = $aels->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.ae.aels.index', compact('aels'));
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
		//abort(403);
		$this->authorize('view', $ael);
		return view('tenant.ae.aels.show', compact('ael'));
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
		abort(403);
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
	public function manualAel()
	{
		abort(403);
	}



}
