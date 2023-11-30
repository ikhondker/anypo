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


	// this is public link. No authentication needed
	public function onlineInvoice($invoice_no)
	{
		//$entity = static::ENTITY ;
		$setup 		= Setup::with('relCountry')->where('id', config('bo.SETUP_ID'))->first();
		$invoice 	= Invoice::where('invoice_no', $invoice_no)->first();
		$account 	= Account::with('relCountry')->where('id', $invoice->account_id)->first();

		return view('landlord.invoices.invoice', compact('invoice', 'account', 'setup'));
	}

}
