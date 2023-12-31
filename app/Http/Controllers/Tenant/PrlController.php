<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Http\Requests\Tenant\StorePrlRequest;
use App\Http\Requests\Tenant\UpdatePrlRequest;

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
use Illuminate\Support\Facades\Log;
# Exceptions
# Events
use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;

use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;

class PrlController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Models\Prl  $prl
	 * @return \Illuminate\Http\Response
	 */
	public function createLine($id)
	{
		//$this->authorize('update',$pr);
		// Write Event Log
		//LogEvent('template',$template->id,'edit','template',$template->id);

		$pr = Pr::where('id', $id)->first();

		$items = Item::getAll();
		//$uoms = Uom::getAllClient();

		return view('tenant.prls.create', with(compact('pr', 'items')));
	}


	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$prls = Prl::query();
		if (request('term')) {
			$prls->where('name', 'Like', '%'.request('term').'%');
		}
		$prls = $prls->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.prls.index', compact('prls'))->with('i', (request()->input('page', 1) - 1) * 10);
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
	public function store(StorePrlRequest $request)
	{
		$this->authorize('create', Prl::class);

		$request->merge(['sub_total'	=> $request->input('prl_amount')]);
		$request->merge(['amount'		=> $request->input('prl_amount')]);

		//$request->merge(['pr_date'     => date('Y-m-d H:i:s')]);
		$prl = Prl::create($request->all());
		// Write to Log
		EventLog::event('Prl', $prl->id, 'create');

		// update PR header
		$pr = Pr::where('id', $prl->pr_id)->firstOrFail();
		$prl_sum = Prl::where('pr_id', '=', $pr->id)->sum('amount');
		$pr->sub_total		= $prl_sum;
		$pr->tax			= $request->input('tax');
		$pr->shipping		= $request->input('shipping');
		$pr->discount		= $request->input('discount');
		$pr->amount			= $prl_sum + $request->input('tax') + $request->input('shipping') - $request->input('discount');
		$pr->save();

		return redirect()->route('prs.show', $prl->pr_id)->with('success', 'Requisition line added successfully');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Prl $prl)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Prl $prl)
	{

		$this->authorize('update', $prl);
		// Write Event Log
		//LogEvent('template',$template->id,'edit','template',$template->id);

		$pr = Pr::where('id', $prl->pr_id)->first();

		$items = Item::getAll();
		//$uoms = Uom::getAllClient();

		return view('tenant.prls.edit', with(compact('pr', 'prl', 'items')));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePrlRequest $request, Prl $prl)
	{
		$this->authorize('update', $prl);

		$request->merge(['sub_total'	=> $request->input('prl_amount')]);
		$request->merge(['amount'		=> $request->input('prl_amount')]);

		//$request->validate();
		$request->validate([

		]);
		$prl->update($request->all());

		// Write to Log
		EventLog::event('Prl', $prl->id, 'edit');

		// update PR header
		$pr				= Pr::where('id', $prl->pr_id)->firstOrFail();
		$prl_sum		= Prl::where('pr_id', '=', $prl->pr_id)->sum('amount');
		$pr->sub_total	= $prl_sum;
		$pr->tax		= $request->input('tax');
		$pr->shipping	= $request->input('shipping');
		$pr->discount	= $request->input('discount');
		$pr->amount		= $prl_sum + $request->input('tax') + $request->input('shipping') - $request->input('discount');
		$pr->save();

		// Write to Log
		EventLog::event('prl', $prl->id, 'update', 'summary', $prl->summary);

		return redirect()->route('prs.show', $pr->id)->with('success', 'PR Line updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Prl $prl)
	{

		$this->authorize('delete', $prl);

		Log::debug("prl_id = ".$prl->id);

		// update PR header
		$pr = Pr::where('id', $prl->pr_id)->firstOrFail();
		$pr->sub_total		=  $pr->sub_total -  $prl->amount;
		$pr->amount			=  $pr->amount -  $prl->amount;
		$pr->save();

		// Write to Log
		EventLog::event('prl', $prl->id, 'delete', 'id', $prl->id);
		$prl->delete();

		return redirect()->route('prs.show', $prl->pr_id)->with('success', 'PR Line deleted successfully');
	}
}
