<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Dbu;
use App\Http\Requests\StoreDbuRequest;
use App\Http\Requests\UpdateDbuRequest;

class DbuController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Dbu::class);

		//liveware
		//return view('dbus.index');

		$dbus = Dbu::query();
		if (request('term')) {
			$dbus->where('name', 'Like', '%' . request('term') . '%');
		}

		$dbus = $dbus->with('dept')->with('deptBudget.budget')->with('project')->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.dbus.index', compact('dbus'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreDbuRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Dbu $dbu)
	{
		$this->authorize('view', $dbu);

		return view('tenant.dbus.show', compact('dbu'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Dbu $dbu)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateDbuRequest $request, Dbu $dbu)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Dbu $dbu)
	{
		//
	}

	public function export()
	{
		$this->authorize('export', Budget::class);
		$data = DB::select("
		SELECT u.id, u.entity, u.article_id, u.event, o.name user_name, d.name dept_name, p.name project_name, 
		u.amount_pr_booked, u.amount_pr_issued, u.amount_po_booked, u.amount_po_issued, u.amount_grs, u.amount_invoice, u.amount_payment, 
		u.created_at
		FROM dbus u,dept_budgets db,budgets b,depts d, projects p, users o
		WHERE u.dept_budget_id = db.id
		AND db.budget_id = b.id
		AND db.dept_id=d.id
		AND u.project_id=p.id
		AND u.user_id=o.id

		");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('dbus', $dataArray);
	}

}
