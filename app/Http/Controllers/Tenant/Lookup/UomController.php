<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\Uom;
use App\Http\Requests\Tenant\Lookup\StoreUomRequest;
use App\Http\Requests\Tenant\Lookup\UpdateUomRequest;

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


class UomController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$uoms = Uom::query();
		if (request('term')) {
			$uoms->where('name', 'Like', '%' . request('term') . '%');
		}
		$uoms = $uoms->orderBy('id', 'DESC')->paginate(20);
		return view('tenant.lookup.uoms.index', compact('uoms'))->with('i', (request()->input('page', 1) - 1) * 20);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Uom::class);
		return view('tenant.lookup.uoms.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreUomRequest $request)
	{
		$this->authorize('create', Uom::class);
		$uom = Uom::create($request->all());
		// Write to Log
		EventLog::event('uom', $uom->id, 'create');

		return redirect()->route('uoms.index')->with('success', 'Uom created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Uom $uom)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Uom $uom)
	{
		$this->authorize('update', $uom);
		
		return view('tenant.lookup.uoms.edit', compact('uom'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateUomRequest $request, Uom $uom)
	{
		$this->authorize('update', $uom);

		//$request->validate();
		$request->validate([

		]);
		$uom->update($request->all());

		// Write to Log
		EventLog::event('uom', $uom->id, 'update', 'name', $uom->name);
		return redirect()->route('uoms.index')->with('success', 'Uom updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Uom $uom)
	{
		$this->authorize('delete', $uom);

		$uom->fill(['enable' => !$uom->enable]);
		$uom->update();

		// Write to Log
		EventLog::event('uom', $uom->id, 'status', 'enable', $uom->enable);

		return redirect()->route('uoms.index')->with('success', 'Uom status Updated successfully');
	}

	public function export()
	{
		$data = DB::select("SELECT id, name, IF(enable, 'Yes', 'No') as Enable
		FROM uoms");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('uoms', $dataArray);
	}
}
