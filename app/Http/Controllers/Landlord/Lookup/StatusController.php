<?php

namespace App\Http\Controllers\Landlord\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Landlord\Lookup\Status;

use App\Http\Requests\Landlord\Lookup\StoreStatusRequest;
use App\Http\Requests\Landlord\Lookup\UpdateStatusRequest;

use Illuminate\Support\Facades\Log;

// Helpers
use App\Helpers\LandlordEventLog;


class StatusController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$statuses = Status::latest()->orderBy('code', 'asc')->get();
		//dd($statuses);
		return view('landlord.lookup.statuses.index', compact('statuses'));
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
	public function store(StoreStatusRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Status $status)
	{
		//$this->authorize('view', $tenant);
		return view('landlord.lookup.statuses.show', compact('status'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Status $status)
	{
		//$this->authorize('update', $status);
		return view('landlord.lookup.statuses.edit', compact('status'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateStatusRequest $request, Status $status)
	{
		//$this->authorize('update', $status);


		//$request->validate();
		$request->validate([]);

		
		// $request->validate([
		// 	'title '  => 'required|max:200',
        // ]);


		$status->update($request->all());


		LandlordEventLog::event('status', $status->id, 'update', 'name', $request->name);

		return redirect()->route('statuses.index')->with('success', 'Statuses updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Status $status)
	{
		//
	}
}
