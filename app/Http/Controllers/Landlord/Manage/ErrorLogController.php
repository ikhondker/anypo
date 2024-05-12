<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ErrorLogController.php
* @brief		This file contains the implementation of the ErrorLogController
* @path			\app\Http\Controllers\Landlord\Manage
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

namespace App\Http\Controllers\Landlord\Manage;
use App\Http\Controllers\Controller;

use App\Models\Landlord\Manage\ErrorLog;
use App\Http\Requests\Landlord\Manage\StoreErrorLogRequest;
use App\Http\Requests\Landlord\Manage\UpdateErrorLogRequest;

class ErrorLogController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$errorLogs = ErrorLog::latest()->orderBy('id', 'asc')->paginate(20);
		return view('landlord.manage.error-logs.index', compact('errorLogs'));
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
	public function store(StoreErrorLogRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(ErrorLog $errorLog)
	{
		return view('landlord.manage.error-logs.show', compact('errorLog'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(ErrorLog $errorLog)
	{
		//$this->authorize('update', $product);
		//$owners = User::getOwners($product->account_id);
		return view('landlord.manage.error-logs.edit', compact('errorLog'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateErrorLogRequest $request, ErrorLog $errorLog)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(ErrorLog $errorLog)
	{
		//
	}
}
