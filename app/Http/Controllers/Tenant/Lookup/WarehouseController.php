<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			WarehouseController.php
* @brief		This file contains the implementation of the WarehouseController
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


use App\Models\Tenant\Lookup\Warehouse;
use App\Http\Requests\Tenant\Lookup\StoreWarehouseRequest;
use App\Http\Requests\Tenant\Lookup\UpdateWarehouseRequest;

# 1. Models
use App\Models\Tenant\Lookup\Country;
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
use Str;
# 12. FUTURE 


class WarehouseController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Warehouse::class);

		$warehouses = Warehouse::query();
		if (request('term')) {
			$warehouses->where('name', 'Like', '%' . request('term') . '%');
		}
		$warehouses = $warehouses->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.warehouses.index', compact('warehouses'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Warehouse::class);

		$countries = Country::All();

		return view('tenant.lookup.warehouses.create', compact('countries'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreWarehouseRequest $request)
	{
		$this->authorize('create', Warehouse::class);

		$request->merge([
			'state' 			=> Str::upper($request['state']),
		]);

		$warehouse = Warehouse::create($request->all());

		// Write to Log
		EventLog::event('warehouse', $warehouse->id, 'create');

		return redirect()->route('warehouses.index')->with('success', 'Warehouse created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Warehouse $warehouse)
	{
		$this->authorize('view', $warehouse);

		return view('tenant.lookup.warehouses.show', compact('warehouse'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Warehouse $warehouse)
	{
		$this->authorize('update', $warehouse);
		$countries = Country::primary()->get();
		return view('tenant.lookup.warehouses.edit', compact('warehouse', 'countries'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
	{
		$this->authorize('update', $warehouse);

		$request->merge([
			'state' 			=> Str::upper($request['state']),
		]);
		
		//$request->validate();
		$request->validate([

		]);
		
		// Write to Log
		EventLog::event('warehouse', $warehouse->id, 'update', 'name', $warehouse->name);
		$warehouse->update($request->all());
		
		return redirect()->route('warehouses.index')->with('success', 'Warehouse updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Warehouse $warehouse)
	{
		$this->authorize('delete', $warehouse);

		$warehouse->fill(['enable' => !$warehouse->enable]);
		$warehouse->update();

		// Write to Log
		EventLog::event('warehouse', $warehouse->id, 'status', 'enable', $warehouse->enable);

		return redirect()->route('warehouses.index')->with('success', 'Warehouse status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Warehouse::class);

		$data = DB::select("SELECT id, name, contact_person, cell, address1, address2, city, zip, state, country, IF(enable, 'Yes', 'No') as enable
		FROM warehouses");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('warehouses', $dataArray);
	}
}
