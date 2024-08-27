<?php


/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			InvoiceLineController.php
* @brief		This file contains the implementation of the InvoiceLineController
* @path			\app\Http\Controllers\Tenant
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 26-AUG-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/


namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\InvoiceLine;
use App\Http\Requests\Tenant\StoreInvoiceLineRequest;
use App\Http\Requests\Tenant\UpdateInvoiceLineRequest;

# 1. Models
use App\Models\Tenant\Invoice;

# 2. Enums
use App\Enum\AuthStatusEnum;
# 3. Helpers
//use App\Helpers\Export;
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
# 13. FUTURE 



class InvoiceLineController extends Controller
{

    public function addLine(Invoice $invoice)
	{
		//$pr = Pr::where('id', $pr_id)->first();

		//dd($pr);
		// Write Event Log
		//LogEvent('template',$template->id,'edit','template',$template->id);

		if ($invoice->auth_status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('invoices.show',$invoice->id)->with('error', 'You can only add line to Invoice with status '. strtoupper(AuthStatusEnum::DRAFT->value) .' !');
		}

		$this->authorize('update',$invoice);	// << =============

		//$items = Item::primary()->get();
		//$uoms = Uom::getAllClient();
		//$uoms = Uom::primary()->get();

		//$prls = Prl::with('item')->with('uom')->where('pr_id', $pr->id)->get()->all();
        $invoiceLines = InvoiceLine::with('invoice')->where('invoice_id', $invoice->id)->get()->all();

		return view('tenant.invoice-lines.create', with(compact('invoiceLines')));
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
    public function store(StoreInvoiceLineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceLineRequest $request, InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceLine $invoiceLine)
    {
        //
    }
}
