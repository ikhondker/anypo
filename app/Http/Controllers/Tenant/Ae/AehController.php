<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			AehController.php
* @brief		This file contains the implementation of the AehController
* @path			\app\Http\Controllers\Tenant\Ae
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

namespace App\Http\Controllers\Tenant\Ae;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Ae\Aeh;
use App\Http\Requests\StoreAehRequest;
use App\Http\Requests\UpdateAehRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Exception;
# 13. FUTURE 


class AehController extends Controller
{
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
	public function store(StoreAehRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Aeh $aeh)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Aeh $aeh)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateAehRequest $request, Aeh $aeh)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Aeh $aeh)
	{
		//
	}
}
