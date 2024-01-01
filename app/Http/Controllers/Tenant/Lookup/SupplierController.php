<?php
namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\Supplier;
use App\Http\Requests\Tenant\Lookup\StoreSupplierRequest;
use App\Http\Requests\Tenant\Lookup\UpdateSupplierRequest;

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


class SupplierController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$suppliers = Supplier::query();
		if (request('term')) {
			$suppliers->where('name', 'Like', '%' . request('term') . '%');
		}
		$suppliers = $suppliers->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.suppliers.index', compact('suppliers'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Supplier::class);
		return view('tenant.lookup.suppliers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreSupplierRequest $request)
	{
		$this->authorize('create', Supplier::class);
		$supplier = Supplier::create($request->all());
		// Write to Log
		EventLog::event('supplier', $supplier->id, 'create');

		return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Supplier $supplier)
	{
		$this->authorize('view', $supplier);
		return view('tenant.lookup.suppliers.show', compact('supplier'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Supplier $supplier)
	{
		$this->authorize('update', $supplier);
		return view('tenant.lookup.suppliers.edit', compact('supplier'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateSupplierRequest $request, Supplier $supplier)
	{
		$this->authorize('update', $supplier);
		// $request->validate();
		$request->validate([

		]);
		$supplier->update($request->all());

		// Write to Log
		EventLog::event('supplier', $supplier->id, 'update', 'name', $supplier->name);
		return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Supplier $supplier)
	{
		$this->authorize('delete', $supplier);

		$supplier->fill(['enable' => !$supplier->enable]);
		$supplier->update();

		// Write to Log
		EventLog::event('supplier', $supplier->id, 'status', 'enable', $supplier->enable);

		return redirect()->route('suppliers.index')->with('success', 'Supplier status Updated successfully');
	}

	public function export()
	{
		$data = DB::select("SELECT id, name, address1, address2, contact_person, cell, city, zip, state, country, website, email, IF(enable, 'Yes', 'No') as Enable 
			FROM suppliers");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('suppliers', $dataArray);
	}
}
