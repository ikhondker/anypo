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
use App\Models\Landlord\Service;
use App\Models\Landlord\Contact;


use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;

use App\Models\Landlord\Manage\Setup;
use App\Models\Landlord\Manage\Product;
use App\Models\Landlord\Manage\Country;

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

	

}
