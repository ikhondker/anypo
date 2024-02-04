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
use Illuminate\Support\Facades\Log;

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
	public function addLine($po_id)
	{
		//$this->authorize('update',$pr);
		// Write Event Log
		//LogEvent('template',$template->id,'edit','template',$template->id);

		$po = Po::where('id', $po_id)->first();

		$items = Item::primary()->get();
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
		$this->authorize('create', Pol::class);

		
		Log::debug('po_id= ' . $request->input('po_id'));
		// get Po detail 
		$po 				= Po::where('id', $request->input('po_id'))->firstOrFail();

		//dd($po);
		// get max line num for the
		$line_num 						= Pol::where('po_id', '=',$po->id)->max('line_num');
		$request->merge(['line_num'		=> $line_num +1]);
		//$request->merge(['sub_total'	=> $request->input('pol_amount')]);
		//$request->merge(['amount'		=> $request->input('pol_amount')]);
		
		$request->merge(['dept_id'		=> $po->dept_id]);
		$request->merge(['requestor_id'	=> $po->requestor_id]);
		//$request->merge(['pr_date'	=> date('Y-m-d H:i:s')]);

		$pol = Pol::create($request->all());

		Log::debug('I AM HERE 1');

		// Write to Log
		EventLog::event('Pol', $pol->id, 'create');

		// update PO Header value
		$result = Po::updatePoHeaderValue($pol->po_id);
		Log::debug('I AM HERE 2');

		// $pol_sum 			= Pol::where('po_id', '=', $po->id)->sum('amount');
		// $po->amount			= $pol_sum;
		// $po->save();
		Log::debug('I AM HERE 3');
		return redirect()->route('pos.show', $pol->po_id)->with('success', 'Purchase Order line added successfully');

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Pol $pol)
	{
		//$this->authorize('view', $pol);

		return view('tenant.pols.show', compact('pol'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Pol $pol)
	{
		$this->authorize('update', $pol);
		// Write Event Log
		//LogEvent('template',$template->id,'edit','template',$template->id);

		$po = Po::where('id', $pol->po_id)->first();
		$items = Item::getAll();
		$uoms = Uom::primary()->get();

		return view('tenant.pols.edit', with(compact('po', 'pol', 'items','uoms')));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePolRequest $request, Pol $pol)
	{
		$this->authorize('update', $pol);

		//$request->merge(['sub_total'	=> $request->input('prl_amount')]);
		//$request->merge(['amount'		=> $request->input('amount')]);
		$request->merge(['amount'		=> $request->input('sub_total')+$request->input('tax')+$request->input('gst')]);

		//$request->validate();
		$request->validate([

		]);
		$pol->update($request->all());

		// Write to Log
		EventLog::event('Pol', $pol->id, 'edit');

		// 	update PO Header value
		$result = Po::updatePoHeaderValue($pol->po_id);

		// Write to Log
		EventLog::event('pol', $pol->id, 'update', 'summary', $pol->summary);

		return redirect()->route('pos.show', $pol->po_id)->with('success', 'Purchase Order Line updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Pol $pol)
	{
		//
	}
}
