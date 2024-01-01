<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;

//Controller
use App\Http\Controllers\Landlord\ProvisionController;

// Models
use App\Models\Landlord\Service;
use App\Models\Landlord\Account;

use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;

use App\Models\Landlord\Lookup\Product;

use App\Models\Landlord\Manage\Checkout;


// Enums
use App\Enum\LandlordCheckoutStatusEnum;
use App\Enum\LandlordInvoiceStatusEnum;
use App\Enum\LandlordInvoiceTypeEnum;
use App\Enum\LandlordPaymentStatusEnum;
use App\Enum\LandlordServiceStatusEnum;

use App\Enum\PaymentMethodEnum;

// Helpers
use App\Helpers\LandlordEventLog;
// Notification

use Validator;
use Str;

// Mail

// Seeded
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

//use App\Http\Requests\StoreCheckoutRequest;

#Jobs
use App\Jobs\Landlord\CreateTenant;
use App\Jobs\Landlord\SubscriptionInvoicePaid;

class SslCommerzPaymentController extends Controller
{

	public function exampleEasyCheckout()
	{
		return view('exampleEasycheckout');
	}

	public function exampleHostedCheckout()
	{
		return view('exampleHosted');
	}

	public function index(Request $request)
	{
		 // create rows in checkout and then hosted payment
		// don't check unique email for existing logged-in user

		Validator::extend('without_spaces', function($attr, $value){
			return preg_match('/^\S*$/u', $value);
		});

		if (auth()->check()) {
			$request->validate([
				'site'			=> 'required|alpha_num:ascii|without_spaces|max:10|unique:accounts,site',
				//'name'		=> 'required|max:100',
				//'account_name'=> 'required|max:100|',
			],[
				'site.required' => 'Site Name is Required!',
				'site.unique'   => 'This site code is already in use. Please try another.',
				'site.without_spaces' => 'Whitespace not allowed.'
			]);
		} else {
			$request->validate([
				'site'			=> 'required|alpha_num:ascii|without_spaces|max:10|unique:accounts,site',
				//'name'		=> 'required|max:100',
				'email'			=> 'required|email|max:100|unique:users,email',
				'account_name'	=> 'required|max:100|',
			],[
				'site.required' => 'Site name is Required!',
				'site.unique'   => 'This site code is already in use. Please try another.',
				'site.without_spaces' => 'Whitespace not allowed.',
				'email.unique'  => 'This email is already registered. Please login first and the try to purchase service.',
			]);
		}

		 // create checkout row
		 $checkout					= new Checkout;
		 $checkout->checkout_date	= date('Y-m-d H:i:s');
		 $checkout->site			= Str::lower($request->input('site'));
		 $checkout->account_name	= $request->input('account_name');

		 if (auth()->check()) {
			$checkout->existing_user	= true;
			$checkout->owner_id			= auth()->user()->id;
			$checkout->email			= auth()->user()->email;
			$checkout->address1			= auth()->user()->address1;
			$checkout->address2			= auth()->user()->address2;
			$checkout->city				= auth()->user()->city;
			$checkout->state			= auth()->user()->state;
			$checkout->zip				= auth()->user()->zip;
			$checkout->country			= auth()->user()->country;
		} else {
			$checkout->existing_user	= false;
			$checkout->email			= $request->input('email');
		}

		// get product
		$product = Product::where('id', config('bo.DEFAULT_PRODUCT_ID') )->first();
		$checkout->product_id		= $product->id;
		$checkout->product_name		= $product->name;
		$checkout->tax				= $product->tax;
		$checkout->vat				= $product->vat;
		$checkout->price			= $product->price;
		$checkout->mnth				= $product->mnth;
		$checkout->user				= $product->user;
		$checkout->gb				= $product->gb;

		$checkout->start_date	= now();
		$checkout->end_date		= now()->addMonth($product->mnth);

		$checkout->status_code	= LandlordCheckoutStatusEnum::DRAFT->value;
		$checkout->ip			= $request->ip();
		
		$checkout->save();
		$checkout_id				= $checkout->id;

		 // Write to Log
		 //EventLog::event('addon',$newaddon_id,'buy');

		# Here you have to receive all the order data to initiate the payment.
		# Let's say, your oder transaction information are saving in a table called "orders"
		# In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

		$post_data = array();
		$post_data['total_amount']  = $checkout->price ; # IQBALYou cant not pay less than 10
		$post_data['currency']		= "USD";
		$post_data['tran_id']		= uniqid(); // tran_id must be unique

		# CUSTOMER INFORMATION
		$post_data['cus_name']		= $checkout->name;
		$post_data['cus_email']		= $checkout->email;
		$post_data['cus_add1']		= 'Customer Address';
		$post_data['cus_add2']		= "";
		$post_data['cus_city']		= "";
		$post_data['cus_state']		= "";
		$post_data['cus_postcode']	= "";
		$post_data['cus_country']	= "Bangladesh";
		$post_data['cus_phone'] 	= '8801XXXXXXXXX';
		$post_data['cus_fax']		= "";

		# SHIPMENT INFORMATION
		$post_data['ship_name']		= "Store Test";
		$post_data['ship_add1']		= "Dhaka";
		$post_data['ship_add2']		= "Dhaka";
		$post_data['ship_city']		= "Dhaka";
		$post_data['ship_state']	= "Dhaka";
		$post_data['ship_postcode']	= "1000";
		$post_data['ship_phone']	= "";
		$post_data['ship_country']	= "Bangladesh";

		$post_data['shipping_method']	= "NO";
		$post_data['product_name']		= "Computer";
		$post_data['product_category']	= "Goods";
		$post_data['product_profile']	= "physical-goods";

		# OPTIONAL PARAMETERS
		$post_data['value_a'] = "CHECKOUT";   /* IQBAL */
		$post_data['value_b'] = $checkout_id; /* IQBAL */
		$post_data['value_c'] = "ref003";
		$post_data['value_d'] = "ref004";

		$sslc = new SslCommerzNotification();
		# initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
		$payment_options = $sslc->makePayment($post_data, 'hosted');

		//TODO
		if (!is_array($payment_options)) {
			print_r($payment_options);
			$payment_options = array();
		}

	}

	// used to pay subscription invoice online
	public function payment(Request $request)
	{
		 // create rows in checkout and then hosted payment
		//Log::debug("I AM HERE INSIDE payment");

		// get invoice details
		$invoice = Invoice::where('id', $request->input('invoice_id') )->first();

		// check if invoice is already paid
		//Log::debug("invoice id=".$invoice->id);
		//Log::debug("invoice_no=".$invoice->invoice_no);
		//Log::debug("invoice status_code=".$invoice->status_code->value);
		
		if ($invoice->status_code->value <> LandlordInvoiceStatusEnum::DUE->value) {
			return redirect()->route('invoices.index')->with('error','Invoice #'.$invoice->invoice_no.' can not be paid!');
		}

		 // create payment
		 $payment						= new Payment;
		 $payment->pay_date				= date('Y-m-d H:i:s');
		 $payment->invoice_id			= $invoice->id;
		 $payment->account_id			= $invoice->account_id;
		 $payment->summary				= $invoice->summary;
		 $payment->payment_method_id	= PaymentMethodEnum::CARD->value;
		 $payment->amount				= $invoice->amount;
		 $payment->ip					= $request->ip();
		 if (auth()->check()) {
			$payment->owner_id			= auth()->user()->id;
		} else {
			//
		}
		$payment->status_code			= LandlordPaymentStatusEnum::DRAFT->value;
		$payment->save();
		$payment_id						= $payment->id;

		# Here you have to receive all the order data to initate the payment.
		# Let's say, your oder transaction informations are saving in a table called "orders"
		# In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

		$post_data = array();
		$post_data['total_amount']	= $payment->amount ; # IQBALYou cant not pay less than 10
		$post_data['currency']		= "USD";
		$post_data['tran_id']		= uniqid(); // tran_id must be unique

		# CUSTOMER INFORMATION
		$post_data['cus_name']		= 'TODO';  //TODO
		$post_data['cus_email']		= 'you@example.com';  //TODO
		$post_data['cus_add1']		= 'Customer Address';
		$post_data['cus_add2']		= "";
		$post_data['cus_city']		= "";
		$post_data['cus_state']		= "";
		$post_data['cus_postcode']	= "";
		$post_data['cus_country']	= "Bangladesh";
		$post_data['cus_phone']		= '8801XXXXXXXXX';
		$post_data['cus_fax']		= "";

		# SHIPMENT INFORMATION
		$post_data['ship_name']		= "Store Test";
		$post_data['ship_add1']		= "Dhaka";
		$post_data['ship_add2']		= "Dhaka";
		$post_data['ship_city']		= "Dhaka";
		$post_data['ship_state']	= "Dhaka";
		$post_data['ship_postcode']	= "1000";
		$post_data['ship_phone']	= "";
		$post_data['ship_country']	= "Bangladesh";

		$post_data['shipping_method']	= "NO";
		$post_data['product_name']		= "Computer";
		$post_data['product_category']	= "Goods";
		$post_data['product_profile']	= "physical-goods";

		# OPTIONAL PARAMETERS
		$post_data['value_a']		= "PAYMENT";   /* IQBAL */
		$post_data['value_b']		= $payment_id; /* IQBAL */
		$post_data['value_c']		= "ref003";
		$post_data['value_d']		= "ref004";

		$sslc = new SslCommerzNotification();
		# initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payment gateway here )
		$payment_options = $sslc->makePayment($post_data, 'hosted');

		if (!is_array($payment_options)) {
			print_r($payment_options);
			$payment_options = array();
		}
	}


	// used to pay for addon
	public function paymentaddon(Request $request)
	{
		 // create rows in checkout and then hosted payment
		//Log::debug("I AM HERE INSIDE payment");

		// get account
		$account		= Account::where('id', auth()->user()->account_id)->first();

		// get addon detail
		$addon = Product::where('id', $request->input('addon_id') )->first();

		$payable_addon =$request->input('payable_addon');

		//$invoice = Invoice::where('id', $request->input('invoice_id') )->first();

		// create service row
		$service				= new Service;

		$service->addon			= true;
		$service->product_id	= $addon->id;
		$service->name			= $addon->name;
		$service->account_id	= $account->id;
		$service->owner_id		= $account->owner_id;
		$service->mnth			= $addon->mnth;
		$service->user			= $addon->user;
		$service->gb			= $addon->gb;
		$service->price			= $payable_addon;
		$service->start_date	= now();
		$service->status_code	= LandlordServiceStatusEnum::DRAFT->value;
		$service->save();
		$service_id				= $service->id;

		Log::debug('New Service added =' . $service->id);
		LandlordEventLog::event('service', $service->id, 'created');

		 // Write to Log
		 //EventLog::event('addon',$newaddon_id,'buy');

		# Here you have to receive all the order data to initate the payment.
		# Let's say, your oder transaction informations are saving in a table called "orders"
		# In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

		$post_data = array();
		$post_data['total_amount']	= $payable_addon ; # IQBALYou cant not pay less than 10
		$post_data['currency']		= "USD";
		$post_data['tran_id']		= uniqid(); // tran_id must be unique

		# CUSTOMER INFORMATION
		$post_data['cus_name']		= 'TODO';  //TODO
		$post_data['cus_email']		= 'you@example.com';  //TODO
		$post_data['cus_add1']		= 'Customer Address';
		$post_data['cus_add2']		= "";
		$post_data['cus_city']		= "";
		$post_data['cus_state']		= "";
		$post_data['cus_postcode']	= "";
		$post_data['cus_country']	= "Bangladesh";
		$post_data['cus_phone']		= '8801XXXXXXXXX';
		$post_data['cus_fax']	= "";

		# SHIPMENT INFORMATION
		$post_data['ship_name']		= "Store Test";
		$post_data['ship_add1']		= "Dhaka";
		$post_data['ship_add2']		= "Dhaka";
		$post_data['ship_city']		= "Dhaka";
		$post_data['ship_state']	= "Dhaka";
		$post_data['ship_postcode']	= "1000";
		$post_data['ship_phone']	= "";
		$post_data['ship_country']	= "Bangladesh";

		$post_data['shipping_method']	= "NO";
		$post_data['product_name']		= "Computer";
		$post_data['product_category']	= "Goods";
		$post_data['product_profile']	= "physical-goods";

		# OPTIONAL PARAMETERS
		$post_data['value_a']		= "ADDON";   /* IQBAL */
		$post_data['value_b']		= $service_id; /* IQBAL */
		$post_data['value_c']		= "ref003";
		$post_data['value_d']		= "ref004";

		$sslc = new SslCommerzNotification();
		# initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
		$payment_options = $sslc->makePayment($post_data, 'hosted');

		if (!is_array($payment_options)) {
			print_r($payment_options);
			$payment_options = array();
		}
	}

	
	// when payment return success, landed here
	public function success(Request $request)
	{
		//$tran_id	= $request->input('tran_id');

		$trx_type	=  $request->input('value_a');
		$trx_id		=  $request->input('value_b');
		Log::debug("success: trx_type=".$trx_type." trx_id=".$trx_id);

		switch ($trx_type) {
			case "CHECKOUT":

				
				// Create new tenant
				Log::debug("Creating Tenant for checkout ID= ".$trx_id);
				CreateTenant::dispatch($trx_id);
				
				return view('landlord.pages.info')->with('title','Thank you for purchasing '.config('app.name').' service!')
					->with('msg','We have received your payment. We are currently preparing your service instance. 
					It’s an automated process and generally take 5-10 minutes. You will receive email notification with service instance login credential and other details shortly.
					Please check your email after few minutes. Thanks again.');
	
				break;

			case "PAYMENT":
				
				// Mark invoice as paid
				Log::debug("SubscriptionInvoicePaid payment_id= ".$trx_id);
				SubscriptionInvoicePaid::dispatch($trx_id);

				return view('landlord.pages.info')->with('title','Payment Successful')
					->with('msg','Thank you for your payment. We have received your payment.');

				break;
			default:
				Log::debug("Invalid transaction type!");
		}

		return view('landlord.pages.info')->with('title','Thank you for purchasing '.config('app.name').' service!')
			->with('msg','We have received your payment. We are currently preparing your service instance. 
			It’s an automated process and generally take 5-10 minutes. You will receive email notification with service instance login credential and other details shortly.
			Please check your email after few minutes. Thanks again.');

	}

	public function fail(Request $request)
	{

		//$tran_id = $request->input('tran_id');
		$trx_type =  $request->input('value_a');
		$trx_id =  $request->input('value_b');

		Log::debug("fail: trx_type=".$trx_type." trx_id=".$trx_id);

		switch ($trx_type) {
			case "CHECKOUT":
				$checkout = Checkout::where('id', $trx_id )->first();
				if ($checkout->status_code == LandlordCheckoutStatusEnum::DRAFT->value || $checkout->status == LandlordCheckoutStatusEnum::ERROR->value) {
					$checkout->status_code = LandlordCheckoutStatusEnum::FAILED->value;
					$checkout->update();
				}
			  break;
			case "PAYMENT":
				$payment = Payment::where('id', $trx_id )->first();
				if ($payment->status_code == LandlordPaymentStatusEnum::DRAFT->value) {
					$payment->status_code = LandlordPaymentStatusEnum::FAILED->value;
					$payment->update();
				}
			  break;
			default:
			  Log::debug("Invalid transaction type unknown!");
		  }



		// Provision the account
		//Provision::deploy($checkout->id);
		//return view('pages.failed',compact('checkout'));
		return view('landlord.pages.error')->with('title','Transaction failed!')->with('msg','Transaction failed!');

		// $tran_id = $request->input('tran_id');
		// $order_details = DB::table('orders')
		//     ->where('transaction_id', $tran_id)
		//     ->select('transaction_id', 'status', 'currency', 'amount')->first();

		// if ($order_details->status == 'Pending') {
		//     $update_product = DB::table('orders')
		//         ->where('transaction_id', $tran_id)
		//         ->update(['status' => 'Failed']);
		//     echo "Transaction is Failed";
		// } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
		//     echo "Transaction is already Successful";
		// } else {
		//     echo "Transaction is Invalid";
		// }

	}

	public function cancel(Request $request)
	{
		//$tran_id = $request->input('tran_id');

		$trx_type =  $request->input('value_a');
		$trx_id =  $request->input('value_b');
		Log::debug("fail: trx_type=".$trx_type." trx_id=".$trx_id);

		switch ($trx_type) {
		  case "CHECKOUT":
			$checkout = Checkout::where('id', $trx_id )->first();
			$checkout->status_code = LandlordCheckoutStatusEnum::CANCELED->value;
			$checkout->update();
			break;
		  case "PAYMENT":
			$payment = Payment::where('id', $trx_id)->first();
			$payment->status_code = LandlordPaymentStatusEnum::CANCELED->value;
			$payment->update();
			break;
		  default:
			Log::debug("Invalid transaction type is cancel!");
		}

		return view('landlord.pages.info')->with('title','Transaction Canceled!')->with('msg','Transaction canceled by user request!');

	}

	public function ipn(Request $request)
	{
		#Received all the payement information from the gateway
		if ($request->input('tran_id')) #Check transation id is posted or not.
		{

			$tran_id = $request->input('tran_id');

			#Check order status in order tabel against the transaction id or order id.
			$order_details = DB::table('orders')
				->where('transaction_id', $tran_id)
				->select('transaction_id', 'status', 'currency', 'amount')->first();

			if ($order_details->status == 'Pending') {
				$sslc = new SslCommerzNotification();
				$validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
				if ($validation == TRUE) {
					/*
					That means IPN worked. Here you need to update order status
					in order table as Processing or Complete.
					Here you can also sent sms or email for successful transaction to customer
					*/
					$update_product = DB::table('orders')
						->where('transaction_id', $tran_id)
						->update(['status' => 'Processing']);

					echo "Transaction is successfully Completed";
				}
			} else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

				#That means Order status already updated. No need to udate database.

				echo "Transaction is already successfully Completed";
			} else {
				#That means something wrong happened. You can redirect customer to your product page.

				echo "Invalid Transaction";
			}
		} else {
			echo "Invalid Data";
		}
	}

	public function xxpayViaAjax(Request $request)
	{

		# Here you have to receive all the order data to initate the payment.
		# Lets your oder trnsaction informations are saving in a table called "orders"
		# In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

		$post_data = array();
		$post_data['total_amount'] = '10'; # You cant not pay less than 10
		$post_data['currency']  = "USD";
		$post_data['tran_id'] = uniqid(); // tran_id must be unique

		# CUSTOMER INFORMATION
		$post_data['cus_name'] = 'Customer Name';
		$post_data['cus_email'] = 'customer@mail.com';
		$post_data['cus_add1'] = 'Customer Address';
		$post_data['cus_add2'] = "";
		$post_data['cus_city'] = "";
		$post_data['cus_state'] = "";
		$post_data['cus_postcode'] = "";
		$post_data['cus_country'] = "Bangladesh";
		$post_data['cus_phone'] = '8801XXXXXXXXX';
		$post_data['cus_fax'] = "";

		# SHIPMENT INFORMATION
		$post_data['ship_name'] = "Store Test";
		$post_data['ship_add1'] = "Dhaka";
		$post_data['ship_add2'] = "Dhaka";
		$post_data['ship_city'] = "Dhaka";
		$post_data['ship_state'] = "Dhaka";
		$post_data['ship_postcode'] = "1000";
		$post_data['ship_phone'] = "";
		$post_data['ship_country'] = "Bangladesh";

		$post_data['shipping_method'] = "NO";
		$post_data['product_name'] = "Computer";
		$post_data['product_category'] = "Goods";
		$post_data['product_profile'] = "physical-goods";

		# OPTIONAL PARAMETERS
		$post_data['value_a'] = "ref001";
		$post_data['value_b'] = "ref002";
		$post_data['value_c'] = "ref003";
		$post_data['value_d'] = "ref004";


		#Before  going to initiate the payment order status need to update as Pending.
		// $update_product = DB::table('orders')
		//     ->where('transaction_id', $post_data['tran_id'])
		//     ->updateOrInsert([
		//         'name' => $post_data['cus_name'],
		//         'email' => $post_data['cus_email'],
		//         'phone' => $post_data['cus_phone'],
		//         'amount' => $post_data['total_amount'],
		//         'status' => 'Pending',
		//         'address' => $post_data['cus_add1'],
		//         'transaction_id' => $post_data['tran_id'],
		//         'currency' => $post_data['currency']
		//     ]);

		$sslc = new SslCommerzNotification();
		# initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
		$payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

		if (!is_array($payment_options)) {
			print_r($payment_options);
			$payment_options = array();
		}

	}

}
