<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			AttachmentController.php
* @brief		This file contains the implementation of the AttachmentController
* @path			\app\Http\Controllers\Landlord\Manage
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

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
//use App\Http\Requests\Landlord\StoreAttachmentRequest;
//use App\Http\Requests\Landlord\UpdateAttachmentRequest;
use App\Http\Requests\Landlord\Admin\StoreInvoiceRequest;       // <--------------

# 1. Models
//use App\Models\User;
//use App\Models\Landlord\Service;
use App\Models\Landlord\Account;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;
use App\Models\Landlord\Lookup\Product;
use App\Models\Landlord\Manage\Config;
use App\Models\Landlord\Manage\Checkout;
# 2. Enums
use App\Enum\Landlord\CheckoutStatusEnum;
use App\Enum\Landlord\InvoiceTypeEnum;
use App\Enum\Landlord\InvoiceStatusEnum;
use App\Enum\Landlord\PaymentMethodEnum;
use App\Enum\Landlord\PaymentStatusEnum;
# 3. Helpers
//use App\Helpers\FileUpload;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
use App\Jobs\Landlord\CreateTenant;
use App\Jobs\Landlord\AddAddon;
use App\Jobs\Landlord\AddAdvance;
use App\Jobs\Landlord\SubscriptionInvoicePaid;
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
//use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
# 10. Events
# 11. Controller
# 12. Seeded
//use DB;
use Validator;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Response;
//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use File;
# 13. FUTURE


class AkkController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		abort(500, 'Can not create attachments manually!');
	}

	public function pricing()
	{
		$product = Product::where('id', config('bo.DEFAULT_PRODUCT_ID'))->first();

		// get service_id of current logged-in user
		if (auth()->check()) {
			if (auth()->user()->account_id == '') {
				$cur_product_id = '';
			} else {
				$account 		= Account::where('id', auth()->user()->account_id)->first();
				$cur_product_id = $account->primary_product_id;
			}
		} else {
			$cur_product_id = '';
		}
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

	// new service purchase checkout
	public function checkoutStripe(Request $request)
	{
		// create rows in checkout and then hosted payment
		// don't check unique email for existing logged-in user
		Validator::extend('without_spaces', function($attr, $value){
			return preg_match('/^\S*$/u', $value);
		});

		if (auth()->check()) {
			$request->validate([
				'site'					=> 'required|alpha_num:ascii|without_spaces|max:10|unique:accounts,site',
				//'name'				=> 'required|max:100',
				//'account_name'		=> 'required|max:100|',
			],[
				'site.required' 		=> 'Site Name is Required!',
				'site.unique'			=> 'This site code is already in use. Please try another.',
				'site.without_spaces'	=> 'Whitespace not allowed.'
			]);
		} else {
			$request->validate([
				'site'					=> 'required|alpha_num:ascii|without_spaces|max:10|unique:accounts,site',
				//'name'				=> 'required|max:100',
				'email'					=> 'required|email|max:100|unique:users,email',
				'account_name'			=> 'required|max:100|',
			],[
				'site.required' 		=> 'Site name is Required!',
				'site.unique'			=> 'This site code is already in use. Please try another.',
				'site.without_spaces'	=> 'Whitespace not allowed.',
				'email.unique'			=> 'This email is already registered. Please login first and then purchase this service.',
			]);
		}

		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

		// get product
		$product = Product::where('id', config('bo.DEFAULT_PRODUCT_ID') )->first();

		$lineItems = [];
		$lineItems[] = [
			'price_data' => [
				'currency' 		=> 'usd',
				'product_data' 	=> [
					'name' => $product->name,
					// 'images' => [$product->image]
				],
				'unit_amount' 	=> $product->price * 100,
			],
			'quantity' 	=> 1,
		];

		$session = \Stripe\Checkout\Session::create([
			'line_items' 	=> $lineItems,
			'mode' 			=> 'payment',
			'success_url' 	=> route('akk.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'cancel_url' 	=> route('akk.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'metadata' 		=> ['trx_type' => 'CHECKOUT'],
		]);

		// create checkout row for buy
		$checkout_id = self::createCheckoutForBuy($session->id,$request->input('site'),$request->input('account_name'),$request->input('email'));
		Log::debug('landlord.AkkController.checkoutStripe created checkout_id = '. $checkout_id);

		return redirect($session->url);
	}

	// used to pay subscription invoices, continue with checkout
	public function insertCheckout($type, $site ='', $account_name ='', $email ='' , $account_id, $product_id, $period)
	{

		//insertCheckout(InvoiceTypeEnum::ADDON->value, $site ='', $account_name ='', $email ='' , $account_id, $product_id)

		// create checkout row
		$checkout					= new Checkout;
		$checkout->invoice_type     = $type;
		$checkout->checkout_date	= date('Y-m-d H:i:s');

        // make sure when system create a tenant from backend, it is created under new user
        if ((auth()->check()) ) {
            $checkout->owner_id			= auth()->user()->id;
            $checkout->email			= auth()->user()->email;
            $checkout->address1			= auth()->user()->address1;
            $checkout->address2			= auth()->user()->address2;
            $checkout->city				= auth()->user()->city;
            $checkout->state			= auth()->user()->state;
            $checkout->zip				= auth()->user()->zip;
            $checkout->country			= auth()->user()->country;
        } else {
            $checkout->email			= $email;
        }


        // get product
		$product = Product::where('id', $product_id )->first();
        $checkout->product_id		= $product->id;
        $checkout->product_name		= $product->name;
        $checkout->tax				= $product->tax;
        $checkout->vat				= $product->vat;
        $checkout->mnth				= $product->mnth;
        $checkout->user				= $product->user;
        $checkout->gb				= $product->gb;


		switch ($type) {
			case InvoiceTypeEnum::SIGNUP->value:
                // no account is created yet
				$checkout->site				= Str::lower($site);
                $checkout->account_id		= '';       // no account is created yet
				$checkout->account_name		= $account_name;

				// make sure when system create a tenant from backend, it is created under new user
				if ((auth()->check()) && (! auth()->user()->isSystem()) ) {
					$checkout->existing_user	= true;
				} else {
					$checkout->existing_user	= false;
				}

                $checkout->price			= $product->price;
                $checkout->start_date		= now();
                $checkout->end_date			= now()->addMonth($product->mnth);


				break;
			case InvoiceTypeEnum::SUBSCRIPTION->value:

				break;
			case InvoiceTypeEnum::ADDON->value:

                $checkout->existing_user	= true;

				$account			        = Account::where('id', $account_id)->first();
				$checkout->site				= $account->site;
				$checkout->account_id		= $account->id;
				$checkout->account_name		= $account->name;

				// check if need to pay for addon
				$config = Config::first();
				$diff = now()->diffInDays($account->end_date);
				if ($diff <= $config->days_addon_free) {
					Log::debug('landlord.account.addAddon dont need to pay as end in days = ' . $diff);
					$addonPrice = 0;
				} else {
					Log::debug('landlord.account.addAddon need to pay as end in days = ' . $diff);
					$addonPrice = round($product->price/30*$diff, 2);
				}

				// get product
				$checkout->price			= $addonPrice;		// <<-----------

                $checkout->start_date		= now();
                $checkout->end_date			= now()->addMonth($product->mnth);


				break;
			case InvoiceTypeEnum::ADVANCE->value:
                $account			        = Account::where('id', $account_id)->first();
                $checkout->site				= $account->site;
		        $checkout->account_id		= $account->id;
		        $checkout->account_name		= $account->name;

                $checkout->existing_user	= true;


                // get product
                $product    = Product::where('id', $account->primary_product_id)->first();
                $config     = Config::where('id', config('bo.CONFIG_ID'))->first();

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

                $checkout->price			= $price;									// < ===============
		        $checkout->mnth				= $period;									// < ===============
                $checkout->start_date		= $account->end_date;						// < ===============
                $checkout->end_date			= $account->end_date->addMonth($period);	// < ===============

				break;
			case InvoiceTypeEnum::ARCHIVE->value:
				break;
			default:
				Log::Error("landlord.AkkController.success Invalid transaction type!");
				return 0;
		}

		switch ($type) {
			case InvoiceTypeEnum::SIGNUP->value:
				break;
			case InvoiceTypeEnum::SUBSCRIPTION->value:
				break;
			case InvoiceTypeEnum::ADDON->value:
				break;
			case InvoiceTypeEnum::ADVANCE->value:

				break;
			case InvoiceTypeEnum::ARCHIVE->value:
				break;
			default:
				Log::Error("landlord.AkkController.success Invalid transaction type!");
				return 0;
		}


		$checkout->status_code		= CheckoutStatusEnum::DRAFT->value;
		$checkout->ip				= request()->ip();

		$checkout->save();
		return $checkout->id;

	}

	// used to pay subscription invoices, continue with checkout
	public function createCheckoutForBuy($sessionId, $site, $account_name, $email)
	{

		// create checkout row
		$checkout					= new Checkout;
		//$checkout->session_id		= $session->id;
		$checkout->session_id		= $sessionId;
		$checkout->checkout_date	= date('Y-m-d H:i:s');
		$checkout->site				= Str::lower($site);
		$checkout->account_name		= $account_name;

		// make sure when system create a tenant from backend, it is created under new user
		if ((auth()->check()) && (! auth()->user()->isSystem()) ) {
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
			$checkout->email			= $email;
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

		$checkout->start_date		= now();
		$checkout->end_date			= now()->addMonth($product->mnth);

		$checkout->status_code		= CheckoutStatusEnum::DRAFT->value;
		//$checkout->ip				= $request->ip();
		$checkout->ip				= request()->ip();

		$checkout->save();
		return $checkout->id;

	}

	// landed here both for checkout and subscription payment
	public function success(Request $request)
	{

		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
		$sessionId = $request->get('session_id');

		try {

			$session = \Stripe\Checkout\Session::retrieve($sessionId);

			if (!$session) {
				throw new NotFoundHttpException;
			}

			$trx_type	= $session->metadata->trx_type;
			Log::debug('landlord.AkkController.success metadata trx_type = '. $session->metadata->trx_type);

			$checkout = Checkout::where('session_id', $session->id)->first();
			if (!$checkout) {
				throw new NotFoundHttpException();
			}
			if ($checkout->status_code == CheckoutStatusEnum::DRAFT->value) {
				Log::debug('landlord.AkkController.success checkout_id = '. $checkout->id);
				Log::debug('landlord.AkkController.success checkout invoice_type = '. $checkout->invoice_type);

				switch ($checkout->invoice_type) {
					case InvoiceTypeEnum::SIGNUP->value:
						CreateTenant::dispatch($checkout->id);
						return view('landlord.pages.info')
							->with('title','Thank you for purchasing '.config('app.name').' service!')->with('msg','You will shorty receive an email, with service instance login credential. Please check your email at '. $checkout->email. ' .');
						break;
					case InvoiceTypeEnum::SUBSCRIPTION->value:
						SubscriptionInvoicePaid::dispatch($checkout->id);
						return view('landlord.pages.info')->with('title','Payment Successful')
							->with('msg','Please check your Account Detail after few minutes.');
						break;
					case InvoiceTypeEnum::ADDON->value:
						AddAddon::dispatch($checkout->id);
						return view('landlord.pages.info')
							->with('title','Thank you for purchasing Add-on!')->with('msg','Please check you Account for purchased add-ons.');
						break;
					case InvoiceTypeEnum::ADVANCE->value:
						AddAdvance::dispatch($checkout->id);
						return view('landlord.pages.info')->with('title','Thank you for paying advance invoices!')
							->with('msg','We have received your payment. Thanks again.');
						break;
					case InvoiceTypeEnum::ARCHIVE->value:
						break;
					default:
						Log::Error("landlord.AkkController.success Invalid transaction type!");
				}
			}


		} catch (\Exception $e) {
			throw new NotFoundHttpException();
		}

	}

	// landed here both for chekcout and subscription payment
	public function cancel(Request $request)
	{
		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
		$sessionId = $request->get('session_id');

		try {
			$session = \Stripe\Checkout\Session::retrieve($sessionId);
			if (!$session) {
				throw new NotFoundHttpException;
			}

			$trx_type	= $session->metadata->trx_type;
			Log::debug('landlord.AkkController.success metadata trx_type = '. $session->metadata->trx_type);

			$checkout = Checkout::where('session_id', $session->id)->first();
			if (!$checkout) {
				throw new NotFoundHttpException();
			}

			// cancel checkout
			if ($checkout->status_code == CheckoutStatusEnum::DRAFT->value) {
				$checkout->status_code = CheckoutStatusEnum::CANCELED->value;
				$checkout->update();
				Log::debug('landlord.AkkController.cancel checkout_id = '. $checkout->id);
			}

			switch ($checkout->invoice_type) {
				case InvoiceTypeEnum::SIGNUP->value:
					break;
				case InvoiceTypeEnum::SUBSCRIPTION->value:
					break;
				case InvoiceTypeEnum::ADDON->value:
					break;
				case InvoiceTypeEnum::ADVANCE->value:
					break;
				case InvoiceTypeEnum::ARCHIVE->value:
					break;
				default:
					Log::Error("landlord.AkkController.cancel Invalid transaction type!");
			}

		} catch (\Exception $e) {
			throw new NotFoundHttpException();
		}
		return view('landlord.pages.info')->with('title','Transaction Canceled!')->with('msg','Transaction canceled by user request!');
	}


	/**
	 * buy new add-addon in a account
	*/
	public function addAddon($account_id, $addon_id)
	{

		Log::channel('bo')->info('landlord.account.addAddon buying new addon account = '. $account_id . ' product_id = ' . $addon_id);

		if (auth()->user()->account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not buy addon as no valid Account Found!');
		}

		// check for unpaid invoices
		$account			= Account::where('id', $account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('landlord.account.addAddon Unpaid invoice exists for this Account. Addon can not be added.');
			return redirect()->route('invoices.index')->with('error', 'Unpaid invoice exists for this account! Please pay unpaid invoice, before buying new addon.');
		}

		// get product/addon
		$product = Product::where('id', $addon_id)
			->where('addon', true)
			->where('enable', true)
			->first();

		// check if need to pay for addon
		$config = Config::first();
		$diff = now()->diffInDays($account->end_date);
		if ($diff <= $config->days_addon_free) {
			Log::debug('landlord.account.addAddon dont need to pay as end in days = ' . $diff);
			$needToPay 	= false;
			$addonPrice = 0;
		} else {
			Log::debug('landlord.account.addAddon need to pay as end in days = ' . $diff);
			$needToPay 	= true;
			$addonPrice = round($product->price/30*$diff, 2);
		}

		// check if need to pay for adding this addon
		if ($needToPay){
			\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

			$lineItems = [];
			$lineItems[] = [
				'price_data' => [
					'currency' => 'usd',
					'product_data' => [
						'name' => $product->name,
						// 'images' => [$product->image]
					],
					'unit_amount' => $addonPrice * 100,		// << -------------
				],
				'quantity' => 1,
			];

			$session = \Stripe\Checkout\Session::create([
				'line_items' => $lineItems,
				'mode' => 'payment',
				'success_url' => route('akk.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
				'cancel_url' => route('akk.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
				'metadata' 	=> ['trx_type' => 'ADDON'],
			]);
		} else {

		}

		// create checkout row
		$checkout					= new Checkout;
		$checkout->invoice_type		= InvoiceTypeEnum::ADDON->value;
		if ($needToPay){
			$checkout->session_id	= $session->id;
		} else {
			$sessionId				= Str::uuid()->toString();
			$checkout->session_id	= $sessionId;
		}

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
		$checkout->price			= $addonPrice;		// <<-----------
		$checkout->mnth				= $product->mnth;
		$checkout->user				= $product->user;
		$checkout->gb				= $product->gb;

		$checkout->start_date		= now();
		// check
		$checkout->end_date			= now()->addMonth($product->mnth);
		$checkout->status_code		= CheckoutStatusEnum::DRAFT->value;
		$checkout->ip				= request()->ip();
		$checkout->save();

		if ($needToPay){
			return redirect($session->url);
		} else {
			AddAddon::dispatch($checkout->id);
			return view('landlord.pages.info')->with('title','Thank you for purchasing Add-on!')
				->with('msg','Please check your Account Detail after few minutes.');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreInvoiceRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function addAdvance(StoreInvoiceRequest $request)
	{

		$period 		= $request->period;
		Log::debug('landlord.invoice.store generating advance invoice for period = ' . $period);

		// allowed periods
		$periods = array("1", "3", "6", "12");
		if ( ! in_array($period, $periods)) {
			return redirect()->route('invoices.index')->with('error', 'Sorry, Allowed period to generate invoice is 1, 3, 6, and 12!');
		}

		$account_id 	= auth()->user()->account_id;
		Log::channel('bo')->info('landlord.invoice.store generating advance invoice for account_id = '. $account_id . ' period = ' . $period);

		if (auth()->user()->account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not generate Invoice as no valid Account Found!');
		}

		// Check if any unpaid invoice exists!
		$account	= Account::where('id', $account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('landlord.invoice.create Unpaid invoice exists for Account #' . $account->id . ' Invoice not created.');
			return redirect()->route('invoices.index')->with('error', 'Unpaid invoice exists for Account id = ' . $account->id . '! Can not create more Invoices.');
		}

		// try {
		// 	// Create invoice
		// 	Log::channel('bo')->info('landlord.invoice.store Generating Invoice for Account id = ' . $account_id);
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
		$product    = Product::where('id', $account->primary_product_id)->first();
		$config     = Config::where('id', config('bo.CONFIG_ID'))->first();

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
			'success_url' => route('akk.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'cancel_url' => route('akk.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'metadata' 	=> ['trx_type' => 'ADVANCE'],
		]);

		// create checkout row
		$checkout					= new Checkout;
		$checkout->invoice_type		= InvoiceTypeEnum::ADVANCE->value;
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

		$checkout->status_code		= CheckoutStatusEnum::DRAFT->value;
		$checkout->ip				= '127.0.0.1';

		$checkout->save();

		return redirect($session->url);

	}

	/**
	 * // used to pay subscription invoices
	*/
	public function addPayment(Request $request)
	{
		// get invoice details
		$invoice = Invoice::with('account')->where('id', $request->input('invoice_id') )->first();

		// check if invoice is already paid
		if ($invoice->status_code <> InvoiceStatusEnum::DUE->value) {
			return redirect()->route('invoices.show',$invoice->id)->with('error','Invoice #'.$invoice->invoice_no.' is already paid!');
		}

		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

		$lineItems = [];
		$lineItems[] = [
			'price_data'	=> [
				'currency' 		=> 'usd',
				'product_data' 	=> [
					'name' 			=> 'Subscription fee as per Invoice #'.$invoice->id,
					// 'images' 	=> [$product->image]
				],
				'unit_amount' 	=> $invoice->amount * 100,
			],
			'quantity' 		=> 1,
		];

		$session = \Stripe\Checkout\Session::create([
			'line_items' 	=> $lineItems,
			'mode' 			=> 'payment',
			'success_url' 	=> route('akk.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'cancel_url' 	=> route('akk.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'metadata' 		=> ['trx_type' => 'PAYMENT'],
		]);

		// get product
		$product    = Product::where('id', $invoice->account->primary_product_id)->first();

		// create checkout row
		$checkout					= new Checkout;
		$checkout->invoice_type		= InvoiceTypeEnum::SUBSCRIPTION->value;
		$checkout->session_id		= $session->id;

		$checkout->checkout_date	= date('Y-m-d H:i:s');
		$checkout->site				= $invoice->account->site;
		$checkout->account_id		= $invoice->account->id;
		$checkout->account_name		= $invoice->account->name;
		$checkout->invoice_id		= $invoice->id;

		if ((auth()->check()) ) {
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
			$checkout->email			= config('bo.GUEST_EMAIL_ID');
		}

		// get product
		$checkout->product_id		= $product->id;
		$checkout->product_name		= $product->name;
		$checkout->tax				= $product->tax;
		$checkout->vat				= $product->vat;
		$checkout->price			= $invoice->amount;		// <<-----------
		$checkout->mnth				= $product->mnth;
		$checkout->user				= $product->user;
		$checkout->gb				= $product->gb;

		$checkout->start_date		= now();
		$checkout->end_date			= now()->addMonth($product->mnth);
		$checkout->status_code		= CheckoutStatusEnum::DRAFT->value;
		$checkout->ip				= request()->ip();
		$checkout->save();

		return redirect($session->url);
	}

	// TODOP2 Please use session_id to troubleshoot in stripe dashboard
	public function webhook()
	{

		Log::debug('landlord.AkkController.webhook Inside Webhook');
		// This is your Stripe CLI webhook secret for testing your endpoint locally.
		$endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

		$payload = @file_get_contents('php://input');
		$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
		$event = null;

		try {
			$event = \Stripe\Webhook::constructEvent(
				$payload, $sig_header, $endpoint_secret
			);
		} catch (\UnexpectedValueException $e) {
			// Invalid payload
			return response('', 400);
		} catch (\Stripe\Exception\SignatureVerificationException $e) {
			// Invalid signature
			return response('', 400);
		}

		// Handle the event
		switch ($event->type) {
			case 'checkout.session.completed':
				$session = $event->data->object;

				$order = Order::where('session_id', $session->id)->first();
				if ($order && $order->status === 'unpaid') {
					$order->status = 'paid';
					$order->save();
					// Send email to customer
				}

			// ... handle other event types
			default:
				echo 'Received unknown event type ' . $event->type;
		}

		return response('');
	}

	// this is public link. No authentication needed
	public function onlineInvoice($invoice_no)
	{
		//$entity = static::ENTITY ;
		$config 	= Config::with('relCountry')->where('id', config('bo.CONFIG_ID'))->first();
		$invoice 	= Invoice::where('invoice_no', $invoice_no)->first();
		$account 	= Account::with('relCountry')->where('id', $invoice->account_id)->first();

		return view('landlord.admin.invoices.invoice', compact('invoice', 'account', 'config'));
	}



}
