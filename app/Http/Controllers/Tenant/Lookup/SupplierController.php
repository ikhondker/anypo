<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			SupplierController.php
* @brief		This file contains the implementation of the SupplierController
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


use App\Models\Tenant\Lookup\Supplier;
use App\Http\Requests\Tenant\Lookup\StoreSupplierRequest;
use App\Http\Requests\Tenant\Lookup\UpdateSupplierRequest;

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
use Str;
# 12. FUTURE


class SupplierController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Supplier::class);

		$suppliers = Supplier::query();
		if (request('term')) {
			$suppliers->where('name', 'Like', '%' . request('term') . '%');
		}
		$suppliers = $suppliers->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.suppliers.index', compact('suppliers'));
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

		$request->merge([
			'state' 			=> Str::upper($request['state']),
		]);

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
	 * Display the specified resource.
	 */
	public function timestamp(Supplier $supplier)
	{
		$this->authorize('view', $supplier);

		return view('tenant.lookup.suppliers.timestamp', compact('supplier'));
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
		$request->merge([
			'state' 			=> Str::upper($request['state']),
		]);

		// $request->validate();
		$request->validate([

		]);

		// Write to Log
		EventLog::event('supplier', $supplier->id, 'update', 'name', $supplier->name);
		$supplier->update($request->all());


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

	/**
	 * Display a listing of the resource.
	 */
	public function spends()
	{
		$this->authorize('spends',Supplier::class);

		$suppliers = Supplier::query();
		if (request('term')) {
			$suppliers->where('name', 'Like', '%' . request('term') . '%');
		}
		$suppliers = $suppliers->orderBy( DB::raw("(amount_pr_booked + amount_pr + amount_po_booked + amount_po)") , 'DESC')->paginate(10);

		return view('tenant.lookup.suppliers.spends', compact('suppliers'));
	}

	/**
	 * Display the specified resource.
	 */
	public function po(Supplier $supplier)
	{
		$this->authorize('view', $supplier);
		return view('tenant.lookup.suppliers.po', compact('supplier'));
	}


	public function export()
	{
		$this->authorize('export', Supplier::class);

		$data = DB::select("SELECT id, name, address1, address2, contact_person, cell, city, zip, state, country, website, email, IF(enable, 'Yes', 'No') as Enable
			FROM suppliers");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('suppliers', $dataArray);
	}
}
