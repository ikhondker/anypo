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
use App\Models\Landlord\Manage\Config;
use App\Models\Landlord\Account;
use App\Models\Landlord\Manage\Checkout;
# 2. Enums
use App\Enum\LandlordInvoiceTypeEnum;
use App\Enum\LandlordCheckoutStatusEnum;

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

		$period 		= $request->period;
		Log::debug('landlord.invoice.store of period = ' . $period);

		// allowed periods
		$periods = array("1", "3", "6", "12");
		if ( ! in_array($period, $periods)) {
			return redirect()->route('invoices.index')->with('error', 'Sorry, Allowed period to generate invoice is 1, 3, 6, and 12!');
		}
		
		$account_id 	= auth()->user()->account_id;
		Log::channel('bo')->info('landlord.invoice.store generating advance invoice for account_id = '. $account_id . ' period=' . $period);

		if (auth()->user()->account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not generate Invoice as no valid Account Found!');
		}

		// Check if any unpaid invoice exists!
		$account	= Account::where('id', $account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('landlord.invoice.create Unpaid invoice exists for Account #' . $account->id . ' Invoice not created.');
			return redirect()->route('invoices.index')->with('error', 'Unpaid invoice exists for Account id=' . $account->id . '! Can not create more Invoices.');
		}

		// try {
		// 	// Create invoice
		// 	Log::channel('bo')->info('landlord.invoice.store Generating Invoice for Account id=' . $account_id);
		// 	$invoice_id = self::createSubscriptionInvoice($account_id, $period);
		// } catch (Exception $e) {
		// 	// Log the message locally OR use a tool like Bugsnag/Flare to log the error
		// 	Log::error('landlord.invoice.store '. $e->getMessage());
		// 	$invoice_id = 0;
		// }

		// if ($invoice_id <> 0) {
		// 	return redirect()->route('invoices.index')->with('success', 'Invoice #' . $invoice_id . ' created successfully.');
		// } else {
		// 	return redirect()->route('invoices.index')->with('error', 'Invoice creation Failed!');
		// }


		// get product
		$product = Product::where('id', $account->primary_product_id)->first();
		$config = Config::where('id', config('bo.CONFIG_ID'))->first();

		switch ($period) {
			case '1':
				$price = $account->price;
				break;
			case '3':
				$price = round(3 * $account->price * (100 - $config->discount_pc_3)/100,2);
				break;
			case '6':
				$price = round (6 * $account->price * (100 - $config->discount_pc_6)/100,2);
				break;
			case '12':
				$price = round( 12 * $account->price * (100 - $config->discount_pc_12)/100,2);
				break;
			default:
				$price = $account->price;
		}


		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

		$lineItems = [];
		$lineItems[] = [
			'price_data' => [
				'currency' => 'usd',
				'product_data' => [
					'name' => $product->name,
					// 'images' => [$product->image]
				],
				'unit_amount' => $price * 100,
			],
			'quantity' => 1,
		];

		$session = \Stripe\Checkout\Session::create([
			'line_items' => $lineItems,
			'mode' => 'payment',
			'success_url' => route('checkout.success-advance', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'cancel_url' => route('checkout.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'metadata' 	=> ['trx_type' => 'ADVANCE'],
		]);

		// create checkout row
		$checkout					= new Checkout;
		$checkout->invoice_type		= LandlordInvoiceTypeEnum::ADVANCE->value;
		$checkout->session_id		= $session->id;
		$checkout->checkout_date	= date('Y-m-d H:i:s');

		$checkout->site				= $account->site;
		$checkout->account_id		= $account->id;
		$checkout->account_name		= $account->name;

		$checkout->existing_user	= true;
		$checkout->owner_id			= auth()->user()->id;
		$checkout->email			= auth()->user()->email;
		$checkout->address1			= auth()->user()->address1;
		$checkout->address2			= auth()->user()->address2;
		$checkout->city				= auth()->user()->city;
		$checkout->state			= auth()->user()->state;
		$checkout->zip				= auth()->user()->zip;
		$checkout->country			= auth()->user()->country;

		// get product
		$checkout->product_id		= $product->id;
		$checkout->product_name		= $product->name;
		$checkout->tax				= $product->tax;
		$checkout->vat				= $product->vat;
		$checkout->price			= $price;									// < ===============
		$checkout->mnth				= $period;									// < ===============
		$checkout->user				= $product->user;
		$checkout->gb				= $product->gb;

		$checkout->start_date		= $account->end_date;						// < ===============
		$checkout->end_date			= $account->end_date->addMonth($period);	// < ===============

		$checkout->status_code		= LandlordCheckoutStatusEnum::DRAFT->value;
		$checkout->ip				= '127.0.0.1';

		$checkout->save();

		return redirect($session->url);
	
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreInvoiceRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function org_store(StoreInvoiceRequest $request)
	{

		// 
		abort(404);


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
