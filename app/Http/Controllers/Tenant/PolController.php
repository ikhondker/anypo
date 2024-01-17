<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Http\Requests\Tenant\StorePolRequest;
use App\Http\Requests\Tenant\UpdatePolRequest;

# Models
# Models
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;

use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
# Enums
use App\Enum\EntityEnum;
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

class PolController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Models\Pol  $pol
	 * @return \Illuminate\Http\Response
	 */
	public function addLine($pr_id)
	{
		//$this->authorize('update',$pr);
		// Write Event Log
		//LogEvent('template',$template->id,'edit','template',$template->id);

		$po = Po::where('id', $pr_id)->first();

		$items = Item::getAll();
		//$uoms = Uom::getAllClient();
		$uoms = Uom::primary()->get();

		return view('tenant.pols.create', with(compact('po','items','uoms')));
	}


	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
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
	public function store(StorePolRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Pol $pol)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Pol $pol)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePolRequest $request, Pol $pol)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Pol $pol)
	{
		//
	}
}
