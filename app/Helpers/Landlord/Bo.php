<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Bo.php
* @brief		This file contains the implementation of the Bo
* @path			\app\Helpers\Landlord
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Helpers\Landlord;

use App\Models\User;
use App\Models\Landlord\Account;

use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Service;
use App\Models\Landlord\Admin\Payment;

use App\Models\Landlord\Manage\Checkout;

// Enums
use App\Enum\LandlordInvoiceTypeEnum;
use App\Enum\LandlordInvoiceStatusEnum;
use App\Enum\PaymentMethodEnum;
use App\Enum\LandlordPaymentStatusEnum;

// Helpers
use Illuminate\Support\Facades\Log;
use App\Helpers\EventLog;

// Notification
use Notification;
use App\Notifications\Landlord\InvoiceCreated;
use App\Notifications\Landlord\InvoicePaid;


class Bo
{

	// P2 Use this
	// use Exception;
	// try {
	// 	//Code that may throw an Exception
	// } catch (Exception $e) {
	// 	// Log the message locally OR use a tool like Bugsnag/Flare to log the error
	// 	Log::error('invoice.store '. $e->getMessage());
	// 	// Either form a friendlier message to display to the user OR redirect them to a failure page
	// }

	public static function getInvoiceNo()
	{
		// Generate unique invoice_no
		do {
			$invoice_no = random_int(1000000, 9999999);
		} while (Invoice::where("invoice_no", "=", $invoice_no)->first());
		return $invoice_no;
	}

	// Called from App\Jobs\Landlord\CreateTenant;
	public static function createServiceForCheckout($checkout_id = 0)
	{

		$checkout		= Checkout::where('id', $checkout_id)->first();

		// create new Service for this account
		$service				= new Service();

		$service->product_id	= $checkout->product_id;
		$service->name			= $checkout->product_name;

		if ($checkout->invoice_type->value == LandlordInvoiceTypeEnum::ADDON->value ){
			$service->addon			= true;
		} else {
			$service->addon			= false;
		}

		$service->account_id	= $checkout->account_id;
		$service->owner_id		= $checkout->owner_id;

		$service->mnth			= $checkout->mnth;
		$service->user			= $checkout->user;
		$service->gb			= $checkout->gb;
		$service->price			= $checkout->price;
		$service->start_date	= now();
		//$service->end_date		= now()->addMonth($checkout->mnth);

		$service->save();

		Log::debug('Helpers.bo.createCheckoutService Account Service created. service_id = ' . $service->id);
		EventLog::event('service', $service->id, 'create');
		return $service->id;
	}

	public static function createInvoiceForCheckout($checkout_id = 0)
	{
		$checkout		= Checkout::where('id', $checkout_id)->first();

		Log::debug('Helpers.bo.createCheckoutInvoice Generating Invoice for checkout_id = ' . $checkout_id );
		Log::debug('Helpers.bo.createCheckoutInvoice Generating Invoice for account_id = ' . $checkout->account_id );
		Log::debug('Helpers.bo.createCheckoutInvoice checkout->invoice_type = ' . $checkout->invoice_type->value );

		if ($checkout->account_id == 0) {
			//return redirect()->back()->with(['error' => 'Could you find account.']);
			return 0;
		}
		
		// create new Invoice
		// logic: create invoice from the next date, after current billed date
		$invoice				= new Invoice();

		// get unique invoice_no
		$invoice->invoice_no	= Bo::getInvoiceNo();

		$invoice->invoice_date = now();
		//Log::channel('bo')->info('Account id = '. $account_id.' last_bill_from_date '.$account->last_bill_from_date);

		// This is the first bill for initial purchase
		$invoice->invoice_type	= $checkout->invoice_type;

		
		// TODO invoice_type specific treatment
		// change description for other type of invoice
		switch ($invoice->invoice_type->value) {
			case LandlordInvoiceTypeEnum::CHECKOUT->value:
				$invoice->summary		= $checkout->product_name . '. Site ' . $checkout->site .'.'.env('APP_DOMAIN');
				break;
			case LandlordInvoiceTypeEnum::SUBSCRIPTION->value:
				$invoice->summary		= $checkout->product_name . '. Site ' . $checkout->site .'.'.env('APP_DOMAIN') .
					' From '. strtoupper(date('d-M-y', strtotime($checkout->start_date))) .' to ' .strtoupper(date('d-M-y', strtotime($checkout->end_date))) ;
				break;
			case LandlordInvoiceTypeEnum::ADDON->value:
				$invoice->summary		= $checkout->product_name . '. Site ' . $checkout->site .'.'.env('APP_DOMAIN') ;
				break;
			case LandlordInvoiceTypeEnum::ADVANCE->value:
				$invoice->summary		= $checkout->product_name . '. Site ' . $checkout->site .'.'.env('APP_DOMAIN') .
					' From '. strtoupper(date('d-M-y', strtotime($checkout->start_date))) .' to ' .strtoupper(date('d-M-y', strtotime($checkout->end_date))) ;
				break;
		}		
		
		Log::channel('bo')->info('Helpers.bo.createCheckoutInvoice Account id = ' . $checkout->account_id . ' FIRST inv start ' . $invoice->from_date . ' to date ' . $invoice->to_date);
		$invoice->from_date		= $checkout->start_date;
		$invoice->to_date		= $checkout->end_date;
		$invoice->due_date		= $checkout->end_date;
		$invoice->price			= $checkout->price;
		$invoice->subtotal		= $checkout->price;
		$invoice->amount		= $checkout->price; 
		$invoice->account_id	= $checkout->account_id;
		$invoice->owner_id		= $checkout->owner_id;

		// create invoice
		$invoice->currency		= 'USD';
		$invoice->status_code	= LandlordInvoiceStatusEnum::DUE->value;
		$invoice->save();

		Log::debug('Helpers.bo.createCheckoutInvoice Invoice Generated id = ' . $invoice->id);
		EventLog::event('invoice', $invoice->id, 'create');

		// post invoice creation update
		$user		= User::where('id', $checkout->owner_id)->first();

		// Invoice Created Notification
		$user->notify(new InvoiceCreated($user, $invoice));

		//return redirect()->route('processes.index')->with('success','Invoice Generation Process completed successfully.');
		return $invoice->id;
	}	


	public static function extendAccountValidity($invoice_id = 0)
	{
		Log::debug('Helpers.bo.extendAccountValidity extending validity by invoice_id = ' . $invoice_id);
		
		$invoice = Invoice::where('id', $invoice_id)->first();
		$account = Account::where('id', $invoice->account_id)->first();
		Log::debug('Helpers.bo.extendAccountValidity extending validity for account_id = ' . $account->id);

		$account->next_bill_generated	= false;
		$account->next_invoice_no		= 0;
		$account->end_date				= $invoice->to_date;	// << ===============
		$account->save();
		Log::debug('Helpers.bo.extendAccountValidity Account validity extended till '. $invoice->to_date);
		return $account->id;
	}

	public static function payCheckoutInvoice($invoice_id = 0)
	{

		$invoice = Invoice::where('id', $invoice_id)->first();
		Log::debug('Helpers.bo.payCheckoutInvoice Paying invoice_id = ' . $invoice->id);
		Log::debug('Helpers.bo.payCheckoutInvoice Invoice for account_id = ' . $invoice->account_id);

		// create payment
		$payment					= new Payment();
		$payment->summary			= 'Payment for Invoice #' . $invoice->invoice_no;
		$payment->pay_date			= now();
		$payment->invoice_id		= $invoice->id;
		$payment->account_id		= $invoice->account_id;
		$payment->owner_id			= $invoice->owner_id; // Might be guest as well
		$payment->payment_method_id	= PaymentMethodEnum::CARD->value;
		$payment->amount			= $invoice->amount;
		$payment->status_code		= LandlordPaymentStatusEnum::PAID->value;
		//$payment->ip				= $request->ip(); // ERROR
		$payment->save();

		Log::debug('Jobs.Landlord.CreateTenant.payCheckoutInvoice payment account_id = ' . $payment->account_id);
		Log::debug('Jobs.Landlord.CreateTenant.payCheckoutInvoice Invoice payment_id = ' . $payment->id);
		EventLog::event('payment', $payment->id, 'create');

		// update paid amount in invoice as paid
		$invoice->status_code		= LandlordInvoiceStatusEnum::PAID->value;
		$invoice->amount_paid		= $invoice->amount_paid + $payment->amount;
		$invoice->save();
		EventLog::event('invoice', $invoice->id, 'update', 'status', LandlordPaymentStatusEnum::PAID->value);

		// Invoice Paid Notification
		$user = User::where('id', $invoice->owner_id)->first();
		$user->notify(new InvoicePaid($user, $invoice, $payment));

		return $payment->id;
	}

}
