<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\Oem;
use App\Http\Requests\Tenant\Lookup\StoreOemRequest;
use App\Http\Requests\Tenant\Lookup\UpdateOemRequest;

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


class OemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Oem::class);

		$oems = Oem::query();
		if (request('term')) {
			$oems->where('name', 'Like', '%' . request('term') . '%');
		}
		$oems = $oems->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.oems.index', compact('oems'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Oem::class);

		return view('tenant.lookup.oems.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreOemRequest $request)
	{
		$this->authorize('create', Oem::class);

		$oem = Oem::create($request->all());
		// Write to Log
		EventLog::event('oem', $oem->id, 'create');

		return redirect()->route('oems.index')->with('success', 'Oem created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Oem $oem)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Oem $oem)
	{
		$this->authorize('update', $oem);
		return view('tenant.lookup.oems.edit', compact('oem'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateOemRequest $request, Oem $oem)
	{
		$this->authorize('update', $oem);

		//$request->validate();
		$request->validate([

		]);
		$oem->update($request->all());

		// Write to Log
		EventLog::event('oem', $oem->id, 'update', 'name', $oem->name);
		return redirect()->route('oems.index')->with('success', 'Oem updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Oem $oem)
	{
		$this->authorize('delete', $oem);

		$oem->fill(['enable' => !$oem->enable]);
		$oem->update();

		// Write to Log
		EventLog::event('oem', $oem->id, 'status', 'enable', $oem->enable);

		return redirect()->route('oems.index')->with('success', 'Oem status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Oem::class);
		$data = DB::select("SELECT id, name, IF(enable, 'Yes', 'No') as Enable
			FROM oems");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('oems', $dataArray);
	}
}
