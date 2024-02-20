<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;



use App\Models\Tenant\Lookup\Designation;
use App\Http\Requests\Tenant\Lookup\StoreDesignationRequest;
use App\Http\Requests\Tenant\Lookup\UpdateDesignationRequest;

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
		return view('tenant.lookup.designations.show', compact('designation'));
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
		$designation->update($request->all());

		// Write to Log
		EventLog::event('designation', $designation->id, 'update', 'name', $designation->name);
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
