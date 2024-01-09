<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ActivityController.php
* @brief		This file contains the implementation of the ActivityController
* @path			\app\Http\Controllers\Landlord\Admin
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

namespace App\Http\Controllers\Landlord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Admin\StoreActivityRequest;
use App\Http\Requests\Landlord\Admin\UpdateActivityRequest;

// Models
use App\Models\Landlord\Admin\Activity;

// Enums
use App\Enum\UserRoleEnum;

// Helpers
// Seeded
use Illuminate\Support\Facades\Log;
use DB;

class ActivityController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		switch (auth()->user()->role->value) {
			case UserRoleEnum::ADMIN->value:
				$activities = Activity::byAccount()->orderBy('id', 'desc')->paginate(25);
				break;
			default:
				$activities = Activity::byUser()->orderBy('id', 'desc')->paginate(25);
		}
		return view('landlord.admin.activities.index', compact('activities'))->with('i', (request()->input('page', 1) - 1) * 10);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{
		
		$this->authorize('viewAll',Activity::class);
		$activities = Activity::latest()->orderBy('id', 'desc')->paginate(25);
		return view('landlord.admin.activities.all', compact('activities'))->with('i', (request()->input('page', 1) - 1) * 10);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreActivityRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreActivityRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Activity  $activity
	 * @return \Illuminate\Http\Response
	 */
	public function show(Activity $activity)
	{
		$this->authorize('view', $activity);
		return view('landlord.admin.activities.show', compact('activity'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Activity  $activity
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Activity $activity)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateActivityRequest  $request
	 * @param  \App\Models\Activity  $activity
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateActivityRequest $request, Activity $activity)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Activity  $activity
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Activity $activity)
	{
		abort(403);
	}

	/**
	 *
	 * Export selected column to csv format
	 *
	 */
	public function export()
	{

		//$data = Uom::all()->toArray();
		$data = DB::select("SELECT a.id, a.object_name, a.object_id, a.event_name ,a.column_name, a.prior_value, a.url,a.role, a.user_id, a.created_at
				 FROM activities a
				 ");

		$dataArray = json_decode(json_encode($data), true);

		// export to CSV
		return exportCSV('activities', $dataArray);
	}
}
