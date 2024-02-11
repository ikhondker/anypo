<?php
namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\Warehouse;
use App\Http\Requests\Tenant\Lookup\StoreWarehouseRequest;
use App\Http\Requests\Tenant\Lookup\UpdateWarehouseRequest;

# Models
use App\Models\Tenant\Lookup\Country;
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


class WarehouseController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$warehouses = Warehouse::query();
		if (request('term')) {
			$warehouses->where('name', 'Like', '%' . request('term') . '%');
		}
		$warehouses = $warehouses->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.warehouses.index', compact('warehouses'))->with('i', (request()->input('page', 1) - 1) * 10);
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

		//$request->validate();
		$request->validate([

		]);
		$warehouse->update($request->all());

		// Write to Log
		EventLog::event('warehouse', $warehouse->id, 'update', 'name', $warehouse->name);
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
		$data = DB::select("SELECT id, name, contact_person, cell, address1, address2, city, zip, state, country, website, email, IF(enable, 'Yes', 'No') as enable
		FROM warehouses");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('warehouses', $dataArray);
	}
}
