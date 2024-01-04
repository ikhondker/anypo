<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			StatusController.php
* @brief		This file contains the implementation of the StatusController
* @path			\app\Http\Controllers\Landlord\Lookup
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
		// 	'title ' => 'required|max:200',
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
		//$this->authorize('delete', $user);

		$status->fill(['enable'=>!$status->enable]);
		$status->update();

		// Write to Log
		LandlordEventLog::event('status',$status->id,'status','enable',$status->enable);

		return redirect()->route('statuses.index')->with('success','Status Status Updated successfully');
	}
}
