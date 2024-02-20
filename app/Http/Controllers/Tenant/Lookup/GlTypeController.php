<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Lookup\GlType;
use Illuminate\Http\Request;

class GlTypeController extends Controller
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
	public function store(Request $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(GlType $glType)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(GlType $glType)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, GlType $glType)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(GlType $glType)
	{
		//
	}
}
