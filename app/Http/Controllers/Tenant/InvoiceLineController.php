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

use App\Http\Requests\Tenant\StoreInvoiceLineRequest;
use App\Http\Requests\Tenant\UpdateInvoiceLineRequest;

# 1. Models
use App\Models\Tenant\Invoice;
use App\Models\Tenant\InvoiceLine;
use App\Models\Tenant\Manage\CustomError;
# 2. Enums
use App\Enum\UserRoleEnum;
use App\Enum\Tenant\AuthStatusEnum;
# 3. Helpers
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
# 13. FUTURE


class InvoiceLineController extends Controller
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
	public function store(StoreInvoiceLineRequest $request)
	{
		$this->authorize('create', InvoiceLine::class);

		// get max line num for the
		$line_num 						= InvoiceLine::where('invoice_id', '=',$request->input('invoice_id'))->max('line_num');
		$request->merge(['line_num'		=> $line_num +1]);

		$request->merge(['sub_total'	=> $request->input('qty') * $request->input('price')]);
		$request->merge(['tax'			=> $request->input('tax')]);
		$request->merge(['gst'			=> $request->input('gst')]);
		$request->merge(['amount'		=> ($request->input('qty')*$request->input('price'))+$request->input('tax')+ $request->input('gst') ]);

		$invoiceLine = InvoiceLine::create($request->all());

		// Write to Log
		EventLog::event('InvoiceLine', $invoiceLine->id, 'create');

		// 	Update Invoice Header value and Populate functional currency values
		Log::debug('tenant.invoiceLine.store calling syncInvoiceValues for invoice_id = '. $invoiceLine->invoice_id);
		$result = Invoice::syncInvoiceValues($invoiceLine->invoice_id);
		Log::debug('tenant.invoiceLine.store syncInvoiceValues return value = '. $result);

		if ($result == '') {
			Log::debug('tenant.invoiceLine.store syncInvoiceValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.invoiceLine.store syncInvoiceValues invoice_id = '.$invoiceLine->invoice_id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
			//return redirect()->route('invoices.index')->with('error', 'Exchange Rate not found for today. System will automatically import it in background. Please try after sometime.');
		}

		if($request->has('add_row')) {
			//Checkbox checked
			return redirect()->route('invoice-lines.add-line', $invoiceLine->invoice_id)->with('success', 'Line added to Invoice #'. $invoiceLine->invoice_id.' successfully.');
		} else {
			//Checkbox not checked
			return redirect()->route('invoices.show', $invoiceLine->invoice_id)->with('success', 'Lined added to Invoice #'. $invoiceLine->invoice_id.' successfully.');
		}

	}

	/**
	 * Display the specified resource.
	 */
	public function show(InvoiceLine $invoiceLine)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(InvoiceLine $invoiceLine)
	{
		$this->authorize('update', $invoiceLine);

		$invoice = Invoice::where('id', $invoiceLine->invoice_id)->first();
		$invoiceLines = InvoiceLine::where('invoice_id', $invoiceLine->invoice_id)->get()->all();

		return view('tenant.invoice-lines.edit', with(compact('invoice', 'invoiceLines', 'invoiceLine')));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateInvoiceLineRequest $request, InvoiceLine $invoiceLine)
	{
		$this->authorize('update', $invoiceLine);

		//$request->validate();
		$request->validate([

		]);
		// Write to Log
		EventLog::event('invoiceLine', $invoiceLine->id, 'update', 'summary', $invoiceLine->summary);
		$invoiceLine->update($request->all());

		// 	Update Invoice Header value and Populate functional currency values. Currency Might change
		Log::debug('tenant.invoiceLine.update calling syncInvoiceValues for invoice_id = '. $invoiceLine->invoice_id);
		$result = Invoice::syncInvoiceValues($invoiceLine->invoice_id);
		Log::debug('tenant.invoiceLine.update syncInvoiceValues return value = '. $result);

		if ($result == '') {
			Log::debug('tenant.invoiceLine.update syncInvoiceValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.invoiceLine.update syncInvoiceValues invoice_id = '.$invoiceLine->invoice_id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}

		return redirect()->route('invoices.show', $invoiceLine->invoice_id)->with('success', 'Invoice Line Line updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(InvoiceLine $invoiceLine)
	{
		$invoice = Invoice::where('id', $invoiceLine->invoice_id)->first();

		if ($invoice->status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('invoices.show',$invoice->id)->with('error', 'You can delete line in Invoice with only status '. strtoupper($invoice->status) .' !');
		}

		Log::debug('tenant.invoiceLine.destroy deleting invoice_id = '. $invoiceLine->invoice_id);
		// check if allowed by policy
		$this->authorize('delete', $invoiceLine);

		$invoiceLine->delete();

		// 	update Invoice Header value
		Log::debug('tenant.invoiceLine.destroy calling syncInvoiceValues for invoice_id = '. $invoiceLine->invoice_id);
		$result = Invoice::syncInvoiceValues($invoiceLine->invoice_id);
		Log::debug('tenant.invoiceLine.destroy syncInvoiceValues return value = '. $result);

		if ($result == '') {
			Log::debug('tenant.invoiceLine.destroy syncInvoiceValues completed.');
		} else {
			$customError = CustomError::where('code', $result)->first();
			Log::error(tenant('id'). 'tenant.invoiceLine.destroy syncInvoiceValues invoice_id = '.$invoiceLine->invoice_id. ' ERROR_CODE = '.$customError->code.' Error Message = '.$customError->message);
		}

		// Write to Log
		EventLog::event('invoiceLine', $invoiceLine->id, 'delete', 'id', $invoiceLine->id);

		return redirect()->route('invoices.show', $invoiceLine->invoice_id)->with('success', 'Invoice Line deleted successfully');
	}

	public function addLine(Invoice $invoice)
	{
		//$invoice = Invoice::where('id', $invoice_id)->first();

		if ($invoice->status <> AuthStatusEnum::DRAFT->value) {
			return redirect()->route('invoices.show',$invoice->id)->with('error', 'You can only add line to Invoice with status '. strtoupper(AuthStatusEnum::DRAFT->value) .' !');
		}

		$this->authorize('update',$invoice);	// << =============

		$invoiceLines = InvoiceLine::with('invoice')->where('invoice_id', $invoice->id)->get()->all();

		return view('tenant.invoice-lines.create', with(compact('invoice','invoiceLines')));
	}


}
