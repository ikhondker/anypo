<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			DesignationController.php
* @brief		This file contains the implementation of the DesignationController
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



use App\Models\Tenant\Lookup\Designation;
use App\Http\Requests\Tenant\Lookup\StoreDesignationRequest;
use App\Http\Requests\Tenant\Lookup\UpdateDesignationRequest;

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


class DesignationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Designation::class);

		$designations = Designation::query();
		if (request('term')) {
			$designations->where('name', 'Like', '%' . request('term') . '%');
		}
		$designations = $designations->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.designations.index', compact('designations'));

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Designation::class);

		return view('tenant.lookup.designations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreDesignationRequest $request)
	{
		$this->authorize('create', Designation::class);

		$designation = Designation::create($request->all());
		// Write to Log
		EventLog::event('designation', $designation->id, 'create');

		return redirect()->route('designations.index')->with('success', 'Designation created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Designation $designation)
	{
		$this->authorize('view', $designation);

		return view('tenant.lookup.designations.show', compact('designation'));
	}


        /**
	 * Display the specified resource.
	 */
	public function timestamp(Designation $designation)
	{
		$this->authorize('view', $designation);

		return view('tenant.lookup.designations.timestamp', compact('designation'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Designation $designation)
	{
		$this->authorize('update', $designation);

		return view('tenant.lookup.designations.edit', compact('designation'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateDesignationRequest $request, Designation $designation)
	{
		$this->authorize('update', $designation);

		//$request->validate();
		$request->validate([

		]);

		// Write to Log
		EventLog::event('designation', $designation->id, 'update', 'name', $designation->name);
		$designation->update($request->all());
		return redirect()->route('designations.index')->with('success', 'Designation updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Designation $designation)
	{
		$this->authorize('delete', $designation);

		$designation->fill(['enable' => !$designation->enable]);
		$designation->update();

		// Write to Log
		EventLog::event('designation', $designation->id, 'status', 'enable', $designation->enable);

		return redirect()->route('designations.index')->with('success', 'Designation status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Designation::class);

		$data = DB::select("SELECT id, name, IF(enable, 'Yes', 'No') as enable
		FROM designations");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('designations', $dataArray);

	}
}
