<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Dbu;
use App\Http\Requests\StoreDbuRequest;
use App\Http\Requests\UpdateDbuRequest;

class DbuController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Dbu::class);

		//liveware
		//return view('dbus.index');

		$dbus = Dbu::query();
		if (request('term')) {
			$dbus->where('name', 'Like', '%' . request('term') . '%');
		}

		$dbus = $dbus->with('dept')->with('deptBudget.budget')->with('project')->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.dbus.index', compact('dbus'))->with('i', (request()->input('page', 1) - 1) * 10);
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
	public function store(StoreDbuRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Dbu $dbu)
	{
		$this->authorize('view', $dbu);

		return view('tenant.dbus.show', compact('dbu'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Dbu $dbu)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateDbuRequest $request, Dbu $dbu)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Dbu $dbu)
	{
		//
	}
}
