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

namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Manage\StoreActivityRequest;
use App\Http\Requests\Landlord\Manage\UpdateActivityRequest;

# 1. Models
use App\Models\Landlord\Manage\Activity;
# 2. Enums
use App\Enum\UserRoleEnum;
# 3. Helpers
use App\Helpers\Export;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Support\Facades\Log;
use DB;
# 13. FUTURE


class ActivityController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{


		$this->authorize('viewAll',Activity::class);
		$activities = Activity::query();
		$activities = $activities->with('user')->byAccount();
		Log::debug('landlord.Activity.index Value of action = ' . request('action'));

		if (request('start_date') && request('end_date') ) {
			$start_date=request('start_date');
			$end_date=request('end_date');
			Log::debug('landlord.activity.index Value of start_date = ' . request('start_date'));
			Log::debug('landlord.activity.index Value of end_date = ' . request('end_date'));
		}

		switch (request('action')) {
			case 'search':
				// Search model
				$activities = $activities->whereBetween('created_at', [$start_date, $end_date ]);
				break;
			case 'export':
				// Export model
				$sql = "
					SELECT a.id, a.object_name, a.object_id, a.event_name ,a.column_name, a.prior_value, a.url,a.role, a.user_id, a.created_at
					FROM activities a
					WHERE a.account_id=".auth()->user()->account_id."
					AND DATE(a.created_at) BETWEEN '".$start_date."' AND '".$end_date."'
				";
				Log::debug('landlord.activity.export'.$sql);

				$data = DB::select($sql);
				$dataArray = json_decode(json_encode($data), true);
				// used Export Helper
				return Export::csv('aels', $dataArray);
				break;
		}

		$activities = $activities->orderBy('id', 'DESC')->paginate(25);
		return view('landlord.manage.activities.index', compact('activities'));

		// switch (auth()->user()->role->value) {
		// 	case UserRoleEnum::ADMIN->value:
		// 		$activities = Activity::with('user')->byAccount()->orderBy('id', 'desc')->paginate(25);
		// 		break;
		// 	default:
		// 		$activities = Activity::with('user')->byUser()->orderBy('id', 'desc')->paginate(25);
		// }
		// return view('landlord.manage.activities.index', compact('activities'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{
		$this->authorize('viewAll',Activity::class);
		$activities = Activity::with('user')->latest()->orderBy('id', 'desc')->paginate(25);
		return view('landlord.manage.activities.all', compact('activities'));
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
		return view('landlord.manage.activities.show', compact('activity'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Activity  $activity
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Activity $activity)
	{
		$this->authorize('update', $activity);
        return view('landlord.manage.activities.edit', compact('activity'));
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
		$this->authorize('update', $activity);

		$request->validate([]);
		$activity->update($request->all());

		return redirect()->route('activities.index')->with('success', 'Activity updated successfully');
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

    public function export()
	{
		$this->authorize('export', Activity::class);

		if (auth()->user()->isSeeded()){
			$data = DB::select("
                SELECT *
                FROM activities a
                ");
		} else if (auth()->user()->isAdmin()){
			$data = DB::select("
                SELECT a.id, a.object_name, a.object_id, a.event_name, u.name user_name, a.created_at
                FROM activities a, users u
                WHERE a.user_id=u.id
       		    AND a.account_id = ".auth()->user()->account_id
				);
		} else {
			$data = DB::select("
				SELECT id, object_name, object_id, event_name, user_id, created_at
                FROM activities a, users u
                WHERE a.user_id=u.id
				AND a.user_id = ".auth()->user()->id
				);
		}

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('activities', $dataArray);
    }

}
