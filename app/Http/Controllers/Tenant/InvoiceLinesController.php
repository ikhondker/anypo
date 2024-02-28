<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			InvoiceLinesController.php
* @brief		This file contains the implementation of the InvoiceLinesController
* @path			\App\Http\Controllers\Tenant
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

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\InvoiceLines;
use App\Http\Requests\Tenant\StoreInvoiceLinesRequest;
use App\Http\Requests\Tenant\UpdateInvoiceLinesRequest;

# 1. Models
# 2. Enums
# 3. Helpers
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Seeded
# 12. TODO 


class InvoiceLinesController extends Controller
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
	public function store(StoreInvoiceLinesRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(InvoiceLines $invoiceLines)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(InvoiceLines $invoiceLines)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateInvoiceLinesRequest $request, InvoiceLines $invoiceLines)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(InvoiceLines $invoiceLines)
	{
		//
	}
}
