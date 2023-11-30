<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        ProcessController.php
 * @brief       This file contains the implementation of the ProcessController class.
 * @author      Iqbal H. Khondker
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
 */

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\StoreProcessRequest;
use App\Http\Requests\Landlord\UpdateProcessRequest;

// Controller
//use App\Http\Controllers\Landlord\ProvisionController;

#Jobs
use App\Jobs\Landlord\GenerateAllSubscriptionInvoice;
use App\Jobs\Landlord\AccountsArchive;

// Seeded
use Str;
use Illuminate\Support\Facades\Log;

class ProcessController extends Controller
{
	

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('landlord.admin.processes.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreProcessRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreProcessRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Process  $process
	 * @return \Illuminate\Http\Response
	 */
	public function show(Process $process)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Process  $process
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Process $process)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateProcessRequest  $request
	 * @param  \App\Models\Process  $process
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateProcessRequest $request, Process $process)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Process  $process
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Process $process)
	{
		//
	}


	public function updateService()
	{
		return redirect()->route('processes.index')->with('success', 'Process run successfully.');
	}

	public function genInvoiceAll()
	{

		// Run process
		Log::debug('Running process to generate all invoices.');
		GenerateAllSubscriptionInvoice::dispatch();
		
		return redirect()->route('processes.index')->with('success','Invoice Generation Process submitted successfully.');
	}

	public function accountsArchive()
	{

		// Run process
		Log::debug('Running process to generate all invoices.');
		AccountsArchive::dispatch();
		
		return redirect()->route('processes.index')->with('success','Accounts Archive Process submitted successfully.');
	}
}
