<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			GroupController.php
* @brief		This file contains the implementation of the GroupController
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


use App\Models\Tenant\Lookup\Group;
use App\Http\Requests\Tenant\Lookup\StoreGroupRequest;
use App\Http\Requests\Tenant\Lookup\UpdateGroupRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Seeded
use DB;
# 12. FUTURE 



class GroupController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		
		$this->authorize('viewAny', Group::class);

		$groups = Group::query();
		if (request('term')) {
			$groups->where('name', 'Like', '%' . request('term') . '%');
		}
		$groups = $groups->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.groups.index', compact('groups'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		
		$this->authorize('create', Group::class);
		return view('tenant.lookup.groups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreGroupRequest $request)
	{
		
		$this->authorize('create', Group::class);
		$group = Group::create($request->all());
		// Write to Log
		EventLog::event('group', $group->id, 'create');

		return redirect()->route('groups.index')->with('success', 'Group created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Group $group)
	{
		$this->authorize('view', $group);

		return view('tenant.lookup.groups.show', compact('group'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Group $group)
	{
	
		$this->authorize('update', $group);
		return view('tenant.lookup.groups.edit', compact('group'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateGroupRequest $request, Group $group)
	{
		
		$this->authorize('update', $group);

		//$request->validate();
		$request->validate([

		]);
		$group->update($request->all());

		// Write to Log
		EventLog::event('group', $group->id, 'update', 'name', $group->name);
		return redirect()->route('groups.index')->with('success', 'Group updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Group $group)
	{
		
		$this->authorize('delete', $group);

		$group->fill(['enable' => !$group->enable]);
		$group->update();

		// Write to Log
		EventLog::event('group', $group->id, 'status', 'enable', $group->enable);

		return redirect()->route('groups.index')->with('success', 'Group status Updated successfully');
	}

	public function export()
	{
		
		$this->authorize('export', Group::class);

		$data = DB::select("SELECT id, name, email, cell, role, enable 
			FROM users");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}

}
