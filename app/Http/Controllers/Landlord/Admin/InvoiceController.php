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
use App\Models\Landlord\Lookup\Product;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;
use App\Models\Landlord\Manage\Config;
use App\Models\Landlord\Account;
use App\Models\Landlord\Manage\Checkout;
# 2. Enums
use App\Enum\Landlord\InvoiceTypeEnum;
use App\Enum\Landlord\InvoiceStatusEnum;
use App\Enum\Landlord\CheckoutStatusEnum;
use App\Enum\Landlord\PaymentMethodEnum;
use App\Enum\Landlord\PaymentStatusEnum;

# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
use App\Jobs\Landlord\SubscriptionInvoicePaid;
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Str;
use Exception;
use Illuminate\Support\Facades\Log;
# 13. FUTURE


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
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
		// TODOP2 Manual Invoice Create TODOP2
		//$this->authorize('create', Invoice::class);
		//return view('landlord.admin.invoices.create');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all(Account $account = null)
	{

		// backend invoice list
		$this->authorize('viewAll',Invoice::class);

		if ($account == '') {
			// here the parameter doesn't exist
			$invoices = Invoice::with('account')->with('status')->orderBy('id', 'DESC')->paginate(10);
		} else {
			$invoices = Invoice::with('account')->with('status')
			->where('account_id',$account->id)
			->orderBy('id', 'DESC')->paginate(10);
		}


		return view('landlord.admin.invoices.all', compact('invoices'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function generate()
	{

		$this->authorize('generate', Invoice::class);

		if (auth()->user()->account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not generate Invoice as no valid Account Found!');
		}

		$account = Account::where('id', auth()->user()->account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('landlord.invoice.create Unpaid invoice exists for Account #' . $account->id . ' Invoice not created.');
			return redirect()->route('invoices.index')->with('error', 'An unpaid Invoice exists for Account: ' . $account->name . '! Unable to create new Invoice!');
		}

		$config = Config::with('relCountry')->where('id', config('bo.CONFIG_ID'))->first();

		return view('landlord.admin.invoices.generate', compact('account', 'config'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreInvoiceRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreInvoiceRequest $request)
	{

        abort(403);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreInvoiceRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function oldstore(StoreInvoiceRequest $request)
	{

		Log::debug('landlord.invoice.store I AM HERE!');
		exit;

		//
		//abort(404);


		// Create future Invoice Manually by user+admin
		$this->authorize('create', Invoice::class);

		$period 		= $request->period;
		$account_id 	= auth()->user()->account_id;

		Log::debug('landlord.invoice.store generating invoice for period = ' . $period);

		if ( $account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not generate Invoice as no valid Account Found!');
		}

		$account = Account::where('id', auth()->user()->account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('landlord.invoice.store Unpaid invoice exists for Account id = ' . $account->id . ' Invoice not created.');
			return redirect()->route('invoices.index')->with('error', 'Unpaid invoice exists for this Account! Can not create more Invoices.');
		}

		try {
			// Create invoice
			Log::channel('bo')->info('landlord.invoice.store Generating Invoice for Account id = ' . $account_id);
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

		$config 	= Config::with('relCountry')->where('id', config('bo.CONFIG_ID'))->first();
		$account 	= Account::with('relCountry')->where('id', $invoice->account_id)->first();

		$entity = static::ENTITY;
		return view('landlord.admin.invoices.show', compact('invoice', 'entity','account','config'));
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
		return view('landlord.admin.invoices.edit',compact('invoice'));
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
		$invoice->update($request->all());
		EventLog::event('invoice',$invoice->id,'update','summary', $request->summary);
		return redirect()->route('invoices.show',$invoice->id)->with('success','Invoice updated successfully.');

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function discount(Invoice $invoice)
	{
		$this->authorize('discount', $invoice);
		// check if invoice is unpaid else show error
		if ($invoice->status_code <> InvoiceStatusEnum::DUE->value){
		   return redirect()->route('invoices.show',$invoice->id)->with('error', 'Sorry, discount can only be applied to DUE Invoices!');
		}
		return view('landlord.admin.invoices.discount',compact('invoice'));
	}

	public function applyDiscount(UpdateInvoiceRequest $request, Invoice $invoice)
	{

		$this->authorize('discount', $invoice);
		Log::debug("landlord.Invoice.applyDiscount applying invoice level discount for invoice_id= ".$invoice->id);

		$request->merge(['org_amount'=> $invoice->amount]);
		$request->merge(['amount'=> $invoice->amount * (100 - $request->input('discount'))/100 ]);		// apply discount
		$request->merge(['discount_date'=> now()]);
		$request->merge(['discount_by'  => auth()->user()->id ]);
		Log::debug("landlord.Invoice.applyDiscount discount %  = ".$request->input('discount'));
		if ($request->input('discount') <> 0){
			$request->merge(['notes'=> $invoice->notes .'<br>Added discount '. $request->input('discount') .'%' ]);
		}
		$invoice->update($request->all());
		EventLog::event('invoice',$invoice->id,'discount','discount', $invoice->discount);
		return redirect()->route('invoices.show',$invoice->id)->with('success','Invoice Discount Applied successfully.');
	}

	public function pwop(Invoice $invoice)
	{
		$this->authorize('pwop', $invoice);
		// check if invoice is unpaid else show error
		if ($invoice->status_code <> InvoiceStatusEnum::DUE->value){
		   return redirect()->route('invoices.show',$invoice->id)->with('error', 'Sorry, you can Pay without Payment only for DUE Invoices!');
		}
		return view('landlord.admin.invoices.pwop',compact('invoice'));
	}

	public function payPwop(UpdateInvoiceRequest $request, Invoice $invoice)
	{
		$this->authorize('pwop', $invoice);

		// check if invoice is unpaid else show error
		if ($invoice->status_code <> InvoiceStatusEnum::DUE->value){
		   return redirect()->route('invoices.show',$invoice->id)->with('error', 'Sorry, you can Pay without Payment only for DUE Invoices!');
		}

		Log::debug("landlord.Invoice.payPwop updating invoice with PWOP for invoice_id= ".$invoice->id);
		$request->merge(['pwop'			=> true]);
		$request->merge(['pwop_date'	=> now()]);
		$request->merge(['pwop_paid_by' => auth()->user()->id ]);
		$invoice->update($request->all());		// internal notes
		EventLog::event('invoice',$invoice->id,'pwop','pwop', $request->pwop);
		Log::debug("landlord.Invoice.payPwop PWOP creating payment record for invoice_id = ".$invoice->id);

		// create payment
		$payment						= new Payment;
		$payment->pwop					= true;			// here difference
		$payment->session_id			= Str::uuid()->toString();
		$payment->pay_date				= date('Y-m-d H:i:s');
		$payment->invoice_id			= $invoice->id;
		$payment->account_id			= $invoice->account_id;
		$payment->summary				= $invoice->summary;
		$payment->payment_method_code	= PaymentMethodEnum::CARD->value;
		$payment->amount				= $invoice->amount;
		$payment->ip					= $request->ip();
		$payment->owner_id				= auth()->user()->id;
		$payment->status_code			= PaymentStatusEnum::DRAFT->value;
		$payment->save();

		if ($payment->status_code == PaymentStatusEnum::DRAFT->value) {
			Log::debug("landlord.Invoice.payPwop paying PWOP payment_id= ".$payment->id);
			SubscriptionInvoicePaid::dispatch($payment->id);
		}
		return redirect()->route('invoices.show',$invoice->id)->with('success','Invoice Paid without Actual Payment.');
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


	public function export()
	{
		$this->authorize('export', Invoice::class);

		if (auth()->user()->isSeeded()){
			$data = DB::select("
				SELECT i.invoice_no, i.summary, i.invoice_type, a.name account_name, i.invoice_date,
				i.from_date, i.to_date, i.currency, i.amount
				FROM invoices i,accounts a
				WHERE i.account_id=a.id
				");
		} else if (auth()->user()->isAdmin()){
			$data = DB::select("
				SELECT i.invoice_no, i.summary, i.invoice_type, a.name account_name, i.invoice_date,
				i.from_date, i.to_date, i.currency, i.amount
				FROM invoices i,accounts a
				WHERE i.account_id=a.id
				AND i.account_id = ".auth()->user()->account_id
				);
		} else {
			$data = DB::select("
				SELECT i.invoice_no, i.summary, i.invoice_type, a.name account_name, i.invoice_date,
				i.from_date, i.to_date, i.currency, i.amount
				FROM invoices i,accounts a
				WHERE i.account_id=a.id
				AND i.owner_id = ".auth()->user()->id
				);
		}

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('invoices', $dataArray);
	}

}
