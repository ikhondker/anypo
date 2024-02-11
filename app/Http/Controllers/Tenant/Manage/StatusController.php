<?php
namespace App\Http\Controllers\Tenant\Manage;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Manage\Status;
use App\Models\Tenant\Lookup\Dept;
use App\Http\Requests\Tenant\Manage\StoreStatusRequest;
use App\Http\Requests\Tenant\Manage\UpdateStatusRequest;

use Illuminate\Support\Facades\Log;
class StatusController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Status::class);

		// $statuses = Status::query();
		// if (request('term')) {
		// 	$statuses->where('raw_route_name', 'Like', '%'.request('term').'%');
		// }
		// $statuses = $statuses->orderBy('entity', 'ASC')->paginate(4);

		// dd($statuses);

		$statuses = Status::latest()->orderBy('name', 'asc')->paginate(15);
		return view('tenant.manage.statuses.index', compact('statuses'));

		//return view('tenant.manage.statuses.index', compact('statuses'))->with('i', (request()->input('page', 1) - 1) * 4);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Status::class);

		return view('tenant.manage.statuses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreStatusRequest $request)
	{
		$this->authorize('create', Status::class);
		$menu = Status::create($request->all());
		// Write to Log
		EventLog::event('menu', $menu->id, 'create');

		return redirect()->route('statuses.index')->with('success', 'Status created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Status $status)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Status $status)
	{
		//$this->authorize('update', $status);

		return view('tenant.manage.statuses.edit', compact('status'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateStatusRequest $request, Status $status)
	{
		$this->authorize('update', $status);

		//$request->validate();
		$status->update($request->all());

		// Write to Log
		EventLog::event('statusmenu', $status->code, 'update', 'name', $request->name);

		return redirect()->route('statuses.index')->with('success', 'Status updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Status $status)
	{
		$this->authorize('delete', $menu);

		$menu->fill(['enable' => ! $menu->enable]);
		$menu->update();
		// Write to Log
		EventLog::event('menu', $menu->id, 'status', 'enable', $menu->enable);

		return redirect()->route('statuses.index')->with('success', 'Status status Updated successfully');
	}
}
