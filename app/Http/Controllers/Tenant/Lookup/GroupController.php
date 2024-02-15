<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\Group;
use App\Http\Requests\Tenant\Lookup\StoreGroupRequest;
use App\Http\Requests\Tenant\Lookup\UpdateGroupRequest;

# Models
# Enums
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
# Notifications
# Mails
# Packages
# Seeded
use DB;

# Exceptions
# Events


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
		//
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
		$data = DB::select("SELECT id, name, email, cell, role, enable 
			FROM users");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}

}
