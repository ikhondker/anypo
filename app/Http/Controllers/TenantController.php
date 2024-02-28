<?php

namespace App\Http\Controllers;


use App\Models\Tenant;

use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;


# 1. Models
# 2. Enums
# 3. Helpers
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
# 13. TODO 



class TenantController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$tenants = Tenant::latest()->orderBy('id', 'asc')->paginate(20);
		return view('tenants.index', compact('tenants'))->with('i', (request()->input('page', 1) - 1) * 20);
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
	public function store(StoreTenantRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Tenant $tenant)
	{
		//$this->authorize('view', $tenant);

		
		return view('tenants.show', compact('tenant'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Tenant $tenant)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTenantRequest $request, Tenant $tenant)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Tenant $tenant)
	{
		//
	}

	/**
	 *
	 * Export selected column to csv format
	 *
	 */
	public function export()
	{

		//$data = Uom::all()->toArray();
		$data = DB::select("SELECT a.id, a.object_name, a.object_id, a.event_name ,a.column_name, a.prior_value, a.url,a.role, a.user_id, a.created_at
				 FROM activities a
				 ");

		$dataArray = json_decode(json_encode($data), true);

		// export to CSV
		return exportCSV('activities', $dataArray);
	}
}
