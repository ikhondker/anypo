<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			EntityController.php
* @brief		This file contains the implementation of the EntityController
* @path			\App\Http\Controllers\Tenant\Manage
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/
namespace App\Http\Controllers\Tenant\Manage;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Manage\Cp;
use App\Http\Requests\Tenant\Manage\StoreCpRequest;
use App\Http\Requests\Tenant\Manage\UpdateCpRequest;

class CpController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function changeLog()
	{
		//$this->authorize('viewAny',Oem::class);
		return view('tenant.manage.cps.changelog');
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
	public function store(StoreCpRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Cp $cp)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Cp $cp)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCpRequest $request, Cp $cp)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Cp $cp)
	{
		//
	}
}
