<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        ProvisionController.php
 * @brief       This file contains the implementation of the ProvisionController class.
 * @author      Iqbal H. Khondker
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
 */

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;

// Models
use App\Models\User;

use App\Models\Landlord\Account;
use App\Models\Landlord\Checkout;
use App\Models\Landlord\Invoice;
use App\Models\Landlord\Payment;
use App\Models\Landlord\Service;
use App\Models\Landlord\Contact;

use App\Models\Landlord\Admin\Setup;
use App\Models\Landlord\Admin\Product;
use App\Models\Landlord\Admin\Country;

// Enums
use App\Enum\UserRoleEnum;
use App\Enum\LandlordInvoiceStatusEnum;
use App\Enum\PaymentMethodEnum;
use App\Enum\LandlordPaymentStatusEnum;
use App\Enum\LandlordInvoiceTypeEnum;

// Helpers
use App\Helpers\Bo;
use App\Helpers\LandlordFileUpload;
use App\Helpers\LandlordEventLog;

// Mail
use Mail;
use App\Mail\DemoMail;


#Jobs
use App\Jobs\Landlord\CreateTenant;


// Notification
use Notification;
//use App\Notifications\Landlord\Test;
use App\Notifications\Landlord\UserCreated;
use App\Notifications\Landlord\UserRegistered;
use App\Notifications\Landlord\InvoiceCreated;
use App\Notifications\Landlord\ServiceUpgraded;
use App\Notifications\Landlord\ServicePurchased;
use App\Notifications\Landlord\AddonPurchased;
use App\Notifications\Landlord\InvoicePaid;

// Event
use Illuminate\Auth\Events\Registered;

// Seeded
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Str;
use DB;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\StoreContactRequest;

class ProvisionController extends Controller
{
	/*
	// CHECK
	1. if site exists
	2. if email already exist ask to locale_get_display_name
	3. don't let purchase again after login only upgrade
	4. allow add-on add
	*/

	public function pricing()
	{

		$product = Product::where('id', config('bo.DEFAULT_PRODUCT_ID'))->first();

		// get service_id of current logged-in user
		if (Auth::check()) {
			if (auth()->user()->account_id == '') {
				$cur_product_id = '';
			} else {
				//$account_id= auth()->user()->account_id;
				$account = Account::where('id', auth()->user()->account_id)->first();
				$cur_product_id = $account->primary_product_id;
			}
		} else {
			$cur_product_id = '';
		}

		//Log::debug("auth()->user()->account_id=". auth()->user()->account_id);
		//Log::debug("cur_product_id=". $cur_service_id);
		//return view('pages.pricing')->with('id',$id);
		return view('landlord.pages.pricing', compact('product'))->with('cur_product_id', $cur_product_id);
	}

	public function checkout()
	{
		// check if existing user is has already linked with an account. Then stops here
		if (auth()->check()) {
			if (auth()->user()->account_id <> '') {
				return view('landlord.pages.error')->with('msg', 'User is has already linked with an account! You can not buy new Account.');
			}
		}

		$product = Product::where('id', config('bo.DEFAULT_PRODUCT_ID'))->first();
		return view('landlord.pages.checkout', compact('product'));
	}

	// called from SslCommerzPaymentController -> success
	public static function run($checkout_id = 0)
	{
		// 1. create billing user & make user admin
		// 2. create account (for support add general account)
		// 3. Add service to that account
		// 4. set user account_id
		// 5. mail him the support account
		// 6. create tenant
		// 7. create tenant admin account
		// 8. mail the tenant login <details

		//$checkout = Checkout::where('id', $checkout_id)->first();

		$user_id= self::createUpdateCheckoutUser($checkout_id);
		
		// Create both account and update account_id in checkout
		$account_id		= self::createCheckoutAccount($checkout_id);

		$checkout		= Checkout::where('id', $checkout_id)->first();
		$checkout->account_id     = $account_id;
		$checkout->save();

		$service_id = self::createCheckoutService($checkout_id);

		// update user account_id
		$user = User::where('id', $user_id)->first();
		$user->account_id    = $account_id;
		$user->save();
		Log::debug('User account_id update uid=' . $user->id);
		LandlordEventLog::event('user', $user->id, 'update', $account_id);

		// generate first invoice for this account and notify
		$invoice_id = self::createCheckoutInvoice($checkout_id);
		$checkout->invoice_id     = $invoice_id;
		$checkout->save();

		// pay this first invoice and notify
		//$payment_id = self::payInvoice($invoice_id);
		$payment_id = self::payCheckoutInvoice($checkout->invoice_id );

		// update account with billed date
		//$account = Account::where('id', $account_id)->first();
		//$invoice = Invoice::where('id', $invoice_id)->first();
		
		//TODO check
		//$account->last_bill_from_date   = $invoice->from_date;
		//$account->last_bill_to_date     = $invoice->to_date;
		//$account->save();

		// TODO Send notification on new purchase
		// Do we need this notification
		// $user->notify(new ServicePurchased($user, $account));

		// update product sold_qty column
		$product		= Product::where('id', $checkout->product_id )->first();
		$product->sold_qty     = $product->sold_qty+1;
		$product->save();

		// Create new tenant TODO
		// CreateTenant::dispatch($checkout->id);
		Log::debug("Creating Tenant for checkout ID= ".$checkout_id);

	}

	public static function createUpdateCheckoutUser($checkout_id = 0)
	{
		$checkout = Checkout::where('id', $checkout_id)->first();

		// make existing user admin if not admin
		if ($checkout->existing_user) {
			// for existing user  owner_id is already set in checkout for existing user SslCommerzPaymentController.index
			$user           = User::where('id', $checkout->owner_id)->first();
			$user->role     = UserRoleEnum::ADMIN->value;
			$user->save();
			Log::debug('Existing User Role updated for id=' . $user->id);
			// Write event log
			LandlordEventLog::event('user', $user->id, 'update', UserRoleEnum::ADMIN->value);
			$user_id = $checkout->owner_id;
		} else {
			// create new admin user			
			$user               = new User();
			$user->name         = $checkout->account_name;
			$user->email        = $checkout->email;
			$user->role         = UserRoleEnum::ADMIN->value;
			$random_password    = Str::random(12);
			$user->password     = bcrypt($random_password);
			$user->save();

			// update owner_id in checkout
			$checkout->owner_id = $user->id;
			$checkout->update();

			// Write event log
			LandlordEventLog::event('user', $user->id, 'create');

			// Send Verification Email
			event(new Registered($user));

			// Send notification on new user creation
			$user->notify(new UserCreated($user, $random_password));

			$user_id = $user->id;
		}
		
		return $user_id;
	}


	public static function createCheckoutAccount($checkout_id = 0)
	{

		// id name sku is_addon addon_type base_mnth base_user base_gb base_price mnth user gb price price_3 price_6 price_12 price_24 tax_pc vat_pc
		// subtotal tax vat amount notes sold_qty photo enable created_by created_at updated_by updated_at
		$checkout = Checkout::where('id', $checkout_id)->first();
		//$product = Product::where('id', $checkout->product_id)->first();

		// create new Account
		// id name tagline address1 address2 city state zip postcode country web fbpage lipage email cell user_count service_count enable logo created_by created_at updated_by updated_at
		$account                    = new Account();
		$account->name              = $checkout->account_name;
		$account->email             = $checkout->email;

		$account->site              = $checkout->site;
		$account->primary_product_id = $checkout->product_id;
		$account->owner_id          = $checkout->owner_id;

		$account->base_mnth         = $checkout->mnth;
		$account->base_user         = $checkout->user;
		$account->base_gb           = $checkout->gb;
		$account->base_price        = $checkout->price;

		$account->mnth              = $checkout->mnth;
		$account->user              = $checkout->user;
		$account->gb                = $checkout->gb;
		$account->price         	= $checkout->price;

		$account->start_date    = now();
		$account->end_date      = now()->addMonth($checkout->mnth);
		$account->next_bill_generated    = false;

		$account->save();

		//$account_id             = $account->id;
		Log::debug('Account Created id=' . $account->id);
		// Write event log
		LandlordEventLog::event('account', $account->id, 'create');

		return $account->id;
	}

	public static function createCheckoutService($checkout_id = 0)
	{

		$checkout		= Checkout::where('id', $checkout_id)->first();

		//$account = Account::where('id', $account_id)->first();
		//$product = Product::where('id', $account->primary_product_id)->first();


		// create new Service for this account
		// id name account_id is_addon addon_type owner_id base_mnth base_user base_gb base_price mnth user gb price
		// subtotal tax vat amount notes start_date end_date enable created_by created_at updated_by updated_at
		$service                 = new Service();

		$service->product_id    = $checkout->product_id;
		$service->name          = $checkout->product_name;

		$service->account_id    = $checkout->account_id;
		$service->owner_id      = $checkout->owner_id;

		$service->mnth          = $checkout->mnth;
		$service->user          = $checkout->user;
		$service->gb            = $checkout->gb;
		$service->price         = $checkout->price;
		$service->start_date    = now();
		// TODO Check
		$service->end_date       = now()->addMonth($checkout->mnth);
		$service->save();
		//$account_service_id             = $service->id;

		Log::debug('Account Service created id=' . $service->id);
		LandlordEventLog::event('service', $service->id, 'create');
		return $service->id;
	}

	public static function createCheckoutInvoice($checkout_id = 0)
	{

		$checkout		= Checkout::where('id', $checkout_id)->first();

		Log::debug('Generating Checkout Invoice for account_id= ' . $checkout->account_id );

		if ($checkout->account_id == 0) {
			//return redirect()->back()->with(['error' => 'Could you find account.']);
			return 0;
		}
		
		//$account = Account::where('id', $account_id)->first();

		// create new Invoice
		// logic: create invoice from the next date, after current billed date
		$invoice                = new Invoice();

		// get unique invoice_no
		$invoice->invoice_no    = Bo::getInvoiceNo();

		$invoice->invoice_date  = now();
		//Log::channel('bo')->info('Account id='. $account_id.' last_bill_from_date '.$account->last_bill_from_date);

		// this is the first bill for initial purchase
		$invoice->invoice_type  = LandlordInvoiceTypeEnum::CHECKOUT->value;
		$invoice->from_date     = $checkout->start_date;
		$invoice->to_date       = $checkout->end_date;
		Log::channel('bo')->info('Account id=' . $checkout->account_id . ' FIRST inv start ' . $invoice->from_date . ' to date ' . $invoice->to_date);
		//Log::channel('bo')->info('password='.$random_password);

		$invoice->due_date      = $checkout->end_date;
		$invoice->summary       = 'Invoice for ' . $checkout->account_name . ' for site' . $checkout->site;
		$invoice->price         = $checkout->price;
		$invoice->subtotal      = $checkout->price;
		$invoice->amount        = $checkout->price; // TODO ??
		$invoice->account_id    = $checkout->account_id;
		$invoice->owner_id      = $checkout->owner_id;

		// create invoice
		$invoice->currency      = 'USD';
		$invoice->status_code   = LandlordInvoiceStatusEnum::DUE->value;
		$invoice->save();

		Log::debug('Invoice Generated id=' . $invoice->id);
		LandlordEventLog::event('invoice', $invoice->id, 'create');

		// post invoice creation update
		$user           = User::where('id', $checkout->owner_id)->first();

		// Invoice Created Notification
		$user->notify(new InvoiceCreated($user, $invoice));

		//Log::debug('Account Created id='. $account->id);
		//return redirect()->route('processes.index')->with('success','Invoice Generation Process completed successfully.');
		return $invoice->id;
	}	


	public static function payCheckoutInvoice($invoice_id = 0)
	{

		$invoice = Invoice::where('id', $invoice_id)->first();
		Log::debug('Inside payCheckoutInvoice => Invoice id=' . $invoice->id);
		Log::debug('inside payCheckoutInvoice => Invoice account_id=' . $invoice->account_id);
		// summary pay_date invoice_id account_id owner_id payment_method_id amount cheque_no payment_token reference_id notes status ip created_by created_at updated_by updated_at

		// create payment
		$payment                     = new Payment();
		$payment->summary            = 'Payment for Invoice #' . $invoice->invoice_no;
		$payment->pay_date           = now();
		$payment->invoice_id         = $invoice->id;
		$payment->account_id         = $invoice->account_id;
		$payment->owner_id           = $invoice->owner_id; // Might be guest as well
		$payment->payment_method_id  = PaymentMethodEnum::CARD->value;
		$payment->amount             = $invoice->amount;
		$payment->status_code        = LandlordPaymentStatusEnum::PAID->value;
		//$payment->ip               = $request->ip(); // ERROR
		$payment->save();

		Log::debug('payment account id =' . $payment->account_id);
		Log::debug('Invoice Payment ID=' . $payment->id);
		LandlordEventLog::event('payment', $payment->id, 'create');

		// update paid amount in invoice as paid
		$invoice->status_code        = LandlordInvoiceStatusEnum::PAID->value;
		$invoice->amount_paid        = $invoice->amount_paid + $payment->amount;
		$invoice->save();
		LandlordEventLog::event('invoice', $invoice->id, 'update', 'status', LandlordPaymentStatusEnum::PAID->value);

		// dont extend account end_date TODO
		// Log::debug('TODO Extending accounts to_date till =' . $invoice->to_date);
		// $account = Account::where('id', $invoice->account_id)->first();
		// $account->end_date        = $invoice->to_date;
		// $account->save();

		// Invoice Paid Notification
		$user = User::where('id', $invoice->owner_id)->first();
		$user->notify(new InvoicePaid($user, $invoice, $payment));

		return $payment->id;
	}

	// id what id?
	// CHECKOUT id=account_id
	// SUBSCRIPTION id=account_id
	// ADDON id=service_id
	public static function org_createInvoice($invoice_type, $id = 0, $period = 1)
	{

		Log::debug('Generating Invoice for type=' . $invoice_type . ' account_id= ' . $id . ' period=' . $period);

		if ($id == 0) {
			//return redirect()->back()->with(['error' => 'Could you find account.']);
			return 0;
		}

		// create new Invoice
		// logic: create invoice from the next date, after current billed date
		$invoice                = new Invoice();

		// generate unique invoice_no
		//$invoice->invoice_no    = Str::uuid();
		do {
			$code = random_int(1000000, 9999999);
		} while (Invoice::where("invoice_no", "=", $code)->first());
		$invoice->invoice_no    = $code;

		$invoice->invoice_date  = now();
		//Log::channel('bo')->info('Account id='. $account_id.' last_bill_from_date '.$account->last_bill_from_date);

		switch ($invoice_type) {
			case LandlordInvoiceTypeEnum::CHECKOUT->value:
				Log::debug('Generating Invoice for checkout account_id=' . $id);
				$account = Account::where('id', $id)->first();

				// this is the first bill for initial purchase
				$invoice->invoice_type    = LandlordInvoiceTypeEnum::CHECKOUT->value;
				$invoice->from_date     = $account->start_date;
				$invoice->to_date       = $account->end_date;
				Log::channel('bo')->info('Account id=' . $account->id . ' FIRST inv start ' . $invoice->from_date . ' to date ' . $invoice->to_date);
				//Log::channel('bo')->info('password='.$random_password);

				$invoice->due_date      = $account->end_date;
				$invoice->summary       = 'Invoice for ' . $account->name . ' for site' . $account->site;
				$invoice->price         = $account->price;
				$invoice->subtotal      = $invoice->price;
				$invoice->amount        = $invoice->price; // TODO ??
				$invoice->account_id    = $account->id;
				$invoice->owner_id      = $account->owner_id;

				break;
			case LandlordInvoiceTypeEnum::SUBSCRIPTION->value:
				Log::debug('Generating Invoice for 111 account_id=' . $id);
				$account = Account::where('id', $id)->first();

				// Don't create invoice if unpaid invoice exists TODO
				if ($account->last_bill_from_date > $account->start_date) {
					Log::channel('bo')->info('Unpaid invoice exists for Account id=' . $account_id . ' Invoice not created.');
					//return redirect()->back()->with(['error' =>'Unpaid invoice exists for Account id=' . $account_id . ' Invoice not created.']);
					return 0;
				}
				// this is subsequent invoice
				$invoice->invoice_type    = LandlordInvoiceTypeEnum::SUBSCRIPTION->value;
				$invoice->from_date     = $account->end_date->addDay(1);
				$invoice->to_date       = $account->end_date->addDay(1)->addMonth($period);
				//Log::channel('bo')->info('Account id='. $account_id.' SECOND inv start '.$invoice->from_date.' to date '.$invoice->to_date);
				Log::channel('bo')->info('Account id=' . $account_id . ' SECOND inv start ' . $invoice->from_date . ' to date ' . $invoice->to_date . ' mnth=' . $account->mnth);

				$invoice->due_date      = $account->end_date;
				$invoice->summary       = 'Invoice for ' . $account->name . ' for site' . $account->site;
				$invoice->price         = $account->price;
				$invoice->subtotal      = $invoice->price;
				$invoice->amount        = $invoice->price; // TODO ??
				$invoice->account_id    = $account->id;
				$invoice->owner_id      = $account->owner_id;

				break;
			case LandlordInvoiceTypeEnum::ADDON->value:
				Log::debug('Generating Invoice for Addon service_id=' . $id);
				$service = Service::where('id', $id)->first();
				$account = Account::where('id', $service->account_id)->first();

				// this is invoice for addon
				$invoice->invoice_type    = LandlordInvoiceTypeEnum::ADDON->value;
				$invoice->from_date     = now();
				$invoice->to_date       = $account->end_date;
				//Log::channel('bo')->info('Account id='. $account_id.' SECOND inv start '.$invoice->from_date.' to date '.$invoice->to_date);
				Log::channel('bo')->info('Account id=' . $account->id . ' SECOND inv start ' . $invoice->from_date . ' to date ' . $invoice->to_date . ' mnth=' . $account->mnth);

				$invoice->due_date      = now();
				$invoice->summary       = 'Invoice for ' . $account->name . ' for site' . $account->site;
				$invoice->price         = $service->price;
				$invoice->subtotal      = $invoice->price;
				$invoice->amount        = $invoice->price; // TODO ??
				$invoice->account_id    = $service->account_id;
				$invoice->owner_id      = $service->owner_id;

				break;
			case LandlordInvoiceTypeEnum::ARCHIVE->value:
				Log::debug('Generating Invoice for ARCHIVE account_id=' . $id);
				break;
			default:
				Log::debug("Inside Account Index. Ignore. Other invoice_type!");
				return 0;
		}

		// create invoice
		$invoice->currency      = 'USD';
		$invoice->status_code   = LandlordInvoiceStatusEnum::DUE->value;
		$invoice->save();

		Log::debug('Invoice Generated id=' . $invoice->id);
		LandlordEventLog::event('invoice', $invoice->id, 'create');

		// post invoice creation update
		switch ($invoice_type) {
			case LandlordInvoiceTypeEnum::CHECKOUT->value:
				$user           = User::where('id', $account->owner_id)->first();
				break;
			case LandlordInvoiceTypeEnum::SUBSCRIPTION->value:
				// update account billed date
				$account->last_bill_from_date   = $invoice->from_date;
				$account->last_bill_to_date     = $invoice->to_date;

				$account->bill_gen_date         = now();
				$account->save();
				Log::debug('Account Updated id=' . $account->id);

				// identify user to notify
				$user = User::where('id', $account->owner_id)->first();
				break;
			case LandlordInvoiceTypeEnum::ADDON->value:
				// identify user to notify
				$user = User::where('id', $service->owner_id)->first();
				break;
			case LandlordInvoiceTypeEnum::ARCHIVE->value:

				break;
			default:
				return 0;
		}

		// Invoice Created Notification
		$user->notify(new InvoiceCreated($user, $invoice));

		//Log::debug('Account Created id='. $account->id);
		//return redirect()->route('processes.index')->with('success','Invoice Generation Process completed successfully.');
		return $invoice->id;
	}

	public static function org_payInvoice($invoice_id = 0)
	{

		//TODO Check valid account_id

		$invoice = Invoice::where('id', $invoice_id)->first();
		Log::debug('Inside payInvoice => Invoice id=' . $invoice->id);

		Log::debug('inside payInvoice => Invoice account_id=' . $invoice->account_id);
		// summary pay_date invoice_id account_id owner_id payment_method_id amount cheque_no payment_token reference_id notes status ip created_by created_at updated_by updated_at

		// create payment
		$payment                     = new Payment();
		$payment->summary            = 'Payment for Invoice #' . $invoice->invoice_no;
		$payment->pay_date           = now();
		$payment->invoice_id         = $invoice->id;
		$payment->account_id         = $invoice->account_id;
		$payment->owner_id           = $invoice->owner_id; // Might be guest as well
		$payment->payment_method_id  = PaymentMethodEnum::CARD->value;
		$payment->amount             = $invoice->amount;
		$payment->status_code        = LandlordPaymentStatusEnum::PAID->value;
		//$payment->ip               = $request->ip(); // ERROR
		$payment->save();

		Log::debug('payment account id =' . $payment->account_id);
		Log::debug('Invoice Payment ID=' . $payment->id);
		LandlordEventLog::event('payment', $payment->id, 'create');

		// update paid amount in invoice as paid
		$invoice->status_code        = LandlordInvoiceStatusEnum::PAID->value;
		$invoice->amount_paid        = $invoice->amount_paid + $payment->amount;
		$invoice->save();
		LandlordEventLog::event('invoice', $invoice->id, 'update', 'status', LandlordPaymentStatusEnum::PAID->value);

		// dont extend account end_date TODO
		Log::debug('TODO Extending accounts to_date till =' . $invoice->to_date);
		$account = Account::where('id', $invoice->account_id)->first();
		$account->end_date        = $invoice->to_date;
		$account->save();

		// Invoice Paid Notification
		$user = User::where('id', $invoice->owner_id)->first();
		$user->notify(new InvoicePaid($user, $invoice, $payment));

		//Log::debug('Account Created id='. $account->id);
		//return redirect()->route('processes.index')->with('success','Invoice Generation Process completed successfully.');
		return $payment->id;
	}


	// this is public link. No authentication needed
	public function onlineInvoice($invoice_no)
	{
		//$entity = static::ENTITY ;
		$setup 		= Setup::with('relCountry')->where('id', config('bo.SETUP_ID'))->first();
		$invoice 	= Invoice::where('invoice_no', $invoice_no)->first();
		$account 	= Account::with('relCountry')->where('id', $invoice->account_id)->first();

		return view('landlord.invoices.invoice', compact('invoice', 'account', 'setup'));
	}

	// TODO what purpose
	public function what_payment($invoice_no)
	{
		//$entity = static::ENTITY ;
		$invoice = Invoice::where('invoice_no', $invoice_no)->first();

		return view('landlord.invoices.invoice', compact('invoice'));
	}
}
