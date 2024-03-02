<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			StatusController.php
* @brief		This file contains the implementation of the StatusController
* @path			\App\Http\Controllers\Tenant\Manage
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

namespace App\Http\Controllers\Tenant\Manage;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Manage\Status;

use App\Http\Requests\Tenant\Manage\StoreStatusRequest;
use App\Http\Requests\Tenant\Manage\UpdateStatusRequest;


# 1. Models
//use App\Models\Tenant\Lookup\Dept;
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
# 13. TODO 



class StatusController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Status::class);

		// $statuses = Status::query();
		// if (request('term')) {
		// 	$statuses->where('raw_route_name', 'Like', '%'.request('term').'%');
		// }
		// $statuses = $statuses->orderBy('entity', 'ASC')->paginate(4);

		// dd($statuses);

		$statuses = Status::latest()->orderBy('name', 'asc')->paginate(15);
		return view('tenant.manage.statuses.index', compact('statuses'));

		//return view('tenant.manage.statuses.index', compact('statuses'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Status::class);

		return view('tenant.manage.statuses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreStatusRequest $request)
	{
		$this->authorize('create', Status::class);

		$status = Status::create($request->all());
		// Write to Log
		EventLog::event('status', $status->id, 'create');

		return redirect()->route('statuses.index')->with('success', 'Status created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Status $status)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Status $status)
	{
		$this->authorize('update', $status);

		return view('tenant.manage.statuses.edit', compact('status'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateStatusRequest $request, Status $status)
	{
		$this->authorize('update', $status);

		//$request->validate();
		$status->update($request->all());

		// Write to Log
		EventLog::event('status', $status->code, 'update', 'name', $request->name);

		return redirect()->route('statuses.index')->with('success', 'Status updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Status $status)
	{
		$this->authorize('delete', $status);

		$status->fill(['enable' => ! $status->enable]);
		$status->update();
		// Write to Log
		EventLog::event('status', $status->code, 'status', 'enable', $status->enable);

		return redirect()->route('statuses.index')->with('success', 'Status status Updated successfully');
	}
	public function export()
	{
		$this->authorize('export', Status::class);

		$data = DB::select("
			SELECT code, name, badge, icon, IF(enable, 'Yes', 'No') as Enable, created_by, created_at, updated_by, updated_at FROM statuses
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('statuses', $dataArray);
	}

}
