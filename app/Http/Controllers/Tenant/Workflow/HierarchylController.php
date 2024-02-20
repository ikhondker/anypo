<?php

namespace App\Http\Controllers\Tenant\Workflow;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Workflow\Hierarchyl;
use App\Http\Requests\Tenant\Workflow\StoreHierarchylRequest;
use App\Http\Requests\Tenant\Workflow\UpdateHierarchylRequest;

class HierarchylController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		abort(403);
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
	public function store(StoreHierarchylRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Hierarchyl $hierarchyl)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Hierarchyl $hierarchyl)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateHierarchylRequest $request, Hierarchyl $hierarchyl)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Hierarchyl $hierarchyl)
	{
		abort(403);
	}
}
