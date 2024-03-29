<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			InvoiceController.php
* @brief		This file contains the implementation of the InvoiceController
* @path			\app\Http\Controllers\Landlord\Admin
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

namespace App\Http\Controllers\Landlord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Admin\StoreInvoiceRequest;
use App\Http\Requests\Landlord\Admin\UpdateInvoiceRequest;

# 1. Models
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Manage\Setup;
use App\Models\Landlord\Account;
# 2. Enums
# 3. Helpers
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Exception;
use Illuminate\Support\Facades\Log;
# 13. TODO 


class InvoiceController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY	= 'INVOICE';


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// front end invoice list
		$invoices = Invoice::with('account')->with('status')->byAccount()->orderBy('id', 'DESC')->paginate(10);
		return view('landlord.admin.invoices.index', compact('invoices'));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{
		// backend invoice list
		$this->authorize('viewAll',Invoice::class);
		$invoices = Invoice::with('account')->with('status')->orderBy('id', 'DESC')->paginate(10);
		return view('landlord.admin.invoices.all', compact('invoices'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function generate()
	{

		//$this->authorize('generate', Invoice::class);

		if (auth()->user()->account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not generate Invoice as no valid Account Found!');
		}

		$account = Account::where('id', auth()->user()->account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('landlord.invoice.create Unpaid invoice exists for Account #' . $account->id . ' Invoice not created.');
			return redirect()->route('invoices.index')->with('error', 'Unpaid invoice exists for Account id=' . $account->id . '! Can not create more Invoices.');
		}

		$setup = Setup::with('relCountry')->where('id', config('bo.SETUP_ID'))->first();

		return view('landlord.admin.invoices.generate', compact('account', 'setup'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreInvoiceRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreInvoiceRequest $request)
	{

		// Create future Invoice Manually by user+admin
		$this->authorize('create', Invoice::class);

		$period 		= $request->period;
		$account_id 	= auth()->user()->account_id;

		if ( $account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not generate Invoice as no valid Account Found!');
		}

		$account = Account::where('id', auth()->user()->account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('landlord.invoice.store Unpaid invoice exists for Account id=' . $account->id . ' Invoice not created.');
			return redirect()->route('invoices.index')->with('error', 'Unpaid invoice exists for this Account! Can not create more Invoices.');
		}

		try {
			// Create invoice
			Log::channel('bo')->info('landlord.invoice.store Generating Invoice for Account id=' . $account_id);
			$invoice_id = self::createSubscriptionInvoice($account_id, $period);
		} catch (Exception $e) {
			// Log the message locally OR use a tool like Bugsnag/Flare to log the error
			Log::error('landlord.invoice.store '. $e->getMessage());
			$invoice_id = 0;
		}


		if ($invoice_id <> 0) {
			return redirect()->route('invoices.index')->with('success', 'Invoice #' . $invoice_id . ' created successfully.');
		} else {
			return redirect()->route('invoices.index')->with('error', 'Invoice creation Failed!');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function show(Invoice $invoice)
	{
		$this->authorize('view', $invoice);

		$entity = static::ENTITY;
		return view('landlord.admin.invoices.show', compact('invoice', 'entity'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Invoice $invoice)
	{
		$this->authorize('update', $invoice);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateInvoiceRequest $request, Invoice $invoice)
	{
		$this->authorize('update', $invoice);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Invoice $invoice)
	{
		//
	}


}
