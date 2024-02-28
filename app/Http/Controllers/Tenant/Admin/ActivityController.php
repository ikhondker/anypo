<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ActivityController.php
* @brief		This file contains the implementation of the ActivityController
* @path			\App\Http\Controllers\Tenant\Admin
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

namespace App\Http\Controllers\Tenant\Admin;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Admin\Activity;
use App\Http\Requests\Tenant\Admin\StoreActivityRequest;
use App\Http\Requests\Tenant\Admin\UpdateActivityRequest;

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
use App\Enum\UserRoleEnum;

# Helpers
use App\Helpers\Export;
# Notifications
# Mails
# Packages
# Seeded
use DB;

# Exceptions
# Events


class ActivityController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{

		$this->authorize('viewAny', Activity::class);

		$activities = Activity::query();
		if (request('term')) {
			$activities->where('object_name', 'Like', '%' . request('term') . '%');
		}
		
		if(auth()->user()->role->value == UserRoleEnum::SYSTEM->value) {
			$activities = $activities->with('user')->orderBy('id', 'DESC')->paginate(50);
		} else {
			$activities = $activities->primary()->with('user')->orderBy('id', 'DESC')->paginate(50);
		}

		return view('tenant.admin.activities.index', compact('activities'));
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
	public function store(StoreActivityRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Activity $activity)
	{
		$this->authorize('view', $activity);

		return view('tenant.admin.activities.show', compact('activity'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Activity $activity)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateActivityRequest $request, Activity $activity)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Activity $activity)
	{
		abort(403);
	}

	/**
	 * Export selected column to csv format
	 */
	public function export()
	{
		$this->authorize('export', Activity::class);
		
		//$data = Uom::all()->toArray();
		$data = DB::select('SELECT a.id, a.object_name, a.object_id, a.event_name, a.column_name, a.prior_value, u.name,a.role, a.created_at
			FROM activities a, users u
			WHERE a.user_id = u.id
			AND a.user_id >= 1003  
			');

		$dataArray = json_decode(json_encode($data), true);

		// export to CSV
		return Export::csv('activities', $dataArray);
	}
}
