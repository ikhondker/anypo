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
use App\Models\User;
use App\Models\Landlord\Lookup\Product;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;
use App\Models\Landlord\Manage\Config;
use App\Models\Landlord\Account;
use App\Models\Landlord\Manage\Checkout;
# 2. Enums
use App\Enum\EntityEnum;
use App\Enum\Landlord\InvoiceTypeEnum;
use App\Enum\Landlord\InvoiceStatusEnum;

# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
use App\Helpers\Landlord\Bo;
use App\Helpers\Landlord\FileUpload;
# 4. Notifications
use App\Notifications\Landlord\InvoiceCreated;
# 5. Jobs
//use App\Jobs\Landlord\SubscriptionInvoicePaid;
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Http\Request;
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
		// three type setup, amc, support
		// not subscription
		// Manual Invoice Create
		$this->authorize('create', Invoice::class);
		$accounts		= Account::primary()->get();
		return view('landlord.admin.invoices.create', compact('accounts'));
	}

/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreInvoiceRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreInvoiceRequest $request)
	{

		$this->authorize('create', Invoice::class);

		$account_id 	= $request->input('account_id');
		$invoice_type 	= $request->input('invoice_type');
		$qty 			= $request->input('qty');

		$config = Config::first();
		$account = Account::where('id', $account_id)->first();

		// allowed periods
		// $periods = array("1", "3", "6", "12");
		// if ( ! in_array($period, $periods)) {
		// 	return redirect()->route('invoices.index')->with('error', 'Sorry, Allowed period to generate invoice is 1, 3, 6, and 12!');
		// }

		switch ($invoice_type) {
			case InvoiceTypeEnum::SETUP->value:
				$product = Product::where('id', 1008)->first();
				$notes			= 'Add-hoq Configuration Invoice for Account #' . $account->id . ' For ' . $account->site .'.'. config('app.domain');
				break;
			case InvoiceTypeEnum::SUPPORT->value:
				$product = Product::where('id', 1009)->first();
				$notes			= 'Add-hoq Priority Support Invoice for Account #' . $account->id . ' For ' . $account->site .'.'. config('app.domain');

				break;
			case InvoiceTypeEnum::AMC->value:
				$product = Product::where('id', 1010)->first();
				$notes			= 'Add-hoq AMC Invoice for Account #' . $account->id . ' For ' . $account->site .'.'. config('app.domain');

				break;
			default:
				Log::error('landlord.invoice.store generating Invalid Invoice Type = ' . $invoice_type);
				return redirect()->route('invoices.create')->with('error', 'Invalid Invoice Type!');
		}

		// Save invoice
		$request->merge(['invoice_no'	=>  Bo::getInvoiceNo() ]);
		$request->merge(['qty'			=> $qty ]);
		$request->merge(['price'		=> $product->price ]);
		$request->merge(['subtotal'		=> $product->price * $qty ]);
		$request->merge(['amount'		=> $product->price * $qty ]);

		$request->merge(['notes'		=> $notes ]);
		$request->merge(['from_date'	=> now() ]);
		$request->merge(['to_date'		=> now() ]);
		$request->merge(['due_date'		=> now()->addDay(7) ]);

		$request->merge(['account_id'	=> $account_id ]);
		$request->merge(['owner_id'		=> $account->owner_id ]);
		$request->merge(['requestor_id'	=> auth()->user()->id ]);
		$request->merge(['invoice_date'	=> date('Y-m-d H:i:s')]);
		$request->merge(['status_code'	=> InvoiceStatusEnum::DRAFT->value]);  // // Ensure manually DUE/posted
		$request->merge(['currency'		=> 'USD']);
		//$request->merge(['posted'		=> false]);		// Ensure manually posted

		$invoice = Invoice::create($request->all());

		// Write to Log
		Log::channel('bo')->info('landlord.invoice.crate Manual Invoice Generated invoice_id = ' . $invoice->id);
		EventLog::event('invoice', $invoice->id, 'manual-create');

		// if ($file = $request->file('file_to_upload')) {
		// 	$request->merge(['article_id'	=> $invoice->id ]);
		// 	$request->merge(['entity'		=> EntityEnum::INVOICE->value ]);
		// 	$attid = FileUpload::aws($request);
		// }

		// identify user to notify
		$user = User::where('id', $account->owner_id)->first();
		// Invoice Created Notification
		$user->notify(new InvoiceCreated($user, $invoice));

		return redirect()->route('invoices.show', $invoice->id)->with('success', 'INVOICE #'. $invoice->id.' created. Please review and POST.');
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
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Invoice $invoice)
	{
		//
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

		// can update discount % multiple time. org_amount is the original invoice amount
		// can remove discount which is wrongly applied

		$request->merge(['discount_date'=> now()]);
		$request->merge(['discount_by' => auth()->user()->id ]);
		Log::debug("landlord.Invoice.applyDiscount discount % = ".$request->input('discount'));

		if ($request->input('discount') <> 0){
			// applying discount first time
			if ($invoice->org_amount == 0 )  {
				$request->merge(['org_amount'=> $invoice->amount]);
			}
			$request->merge(['amount'=> round($invoice->amount * (100 - $request->input('discount'))/100,2) ]);			// apply discount
			$request->merge(['notes'=> $invoice->notes .'<br>Added discount '. $request->input('discount') .'%' ]);
			// $table->decimal('amount',19, 2)->default(0);
			// $table->decimal('org_amount',19, 2)->default(0);	// before apply any discount
		} else {
			// TODOP2  either no change or reset discount

		}

		// update record
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
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all(Request $request)
	{
		// backend invoice list
		$this->authorize('viewAll',Invoice::class);

		// Log::debug('landlord.invoice.all type = ' . $type);
		// Log::debug('landlord.invoice.all status = ' . $status);
		// Log::debug('landlord.invoice.all account = ' . $account);

		$invoices = Invoice::with('account')->with('status');

		// https://www.reddit.com/r/PHPhelp/comments/1d1ekju/multiple_optional_parameters_in_laravel_11_problem/
		if ($request->has('type')) {
			$invoices->where('invoice_type', $request->query('type'));
		}

		if ($request->has('status')) {
			$invoices->where('status_code', $request->query('status'));
		}

		if ($request->has('account')) {
			$invoices->where('account_id', $request->query('account'));
		}

		$invoices = $invoices->orderBy('id', 'DESC')->paginate(10);

		return view('landlord.admin.invoices.all', compact('invoices'));
	}


	public function post(Invoice $invoice)
	{

		if ($invoice->status_code <> InvoiceStatusEnum::DRAFT->value){
			return redirect()->route('invoices.show',$invoice->id)->with('error', 'Sorry, you can only POST draft Invoices !');
		}

		$invoice->status_code	= InvoiceStatusEnum::DUE->value;
		$invoice->save();
		Log::debug('landlord.invoice.post Invoice Posted invoice_id = ' . $invoice->id);
		EventLog::event('invoice', $invoice->id, 'post');
		return redirect()->route('invoices.show', $invoice->id)->with('success', 'INVOICE #'. $invoice->id.' Posted successfully.');
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
	public function oldstore(StoreInvoiceRequest $request)
	{


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


	public function export()
	{
		$this->authorize('export', Invoice::class);

		if (auth()->user()->isBackend()){
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
