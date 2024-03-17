<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			HomeController.php
* @brief		This file contains the implementation of the HomeController
* @path			\app\Http\Controllers\Landlord
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

// test
namespace App\Http\Controllers\Landlord;
use App\Http\Controllers\Controller;
 
# 1. Models
use App\Models\User;
use App\Models\Landlord\Service;
use App\Models\Landlord\Account;

use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;

use App\Models\Landlord\Lookup\Product;

use App\Models\Landlord\Manage\MailList;
use App\Models\Landlord\Manage\Setup;
use App\Models\Landlord\Manage\Contact;
use App\Models\Landlord\Manage\Checkout;

# 2. Enums
use App\Enum\PaymentMethodEnum;
use App\Enum\LandlordCheckoutStatusEnum;
use App\Enum\LandlordInvoiceStatusEnum;
use App\Enum\LandlordPaymentStatusEnum;
# 3. Helpers
use App\Helpers\LandlordFileUpload;
//use App\Helpers\LandlordEventLog;
# 4. Notifications
use Notification;
use App\Notifications\Landlord\Test;
//use App\Notifications\Landlord\UserRegistered;
//use App\Notifications\Landlord\InvoiceCreated;
//use App\Notifications\Landlord\ServiceUpgraded;
//use App\Notifications\Landlord\AddonPurchased;

use App\Notifications\Landlord\Contacted;
# 5. Jobs
use App\Jobs\Landlord\CreateTenant;
use App\Jobs\Landlord\AddAddon;
use App\Jobs\Landlord\SubscriptionInvoicePaid;
# 6. Mails
use Mail;
use App\Mail\Landlord\DemoMail;
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use Illuminate\Foundation\Http\FormRequest;
use Str;
use DB;
use Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
# 13. TODO 
use App\Http\Requests\Landlord\Manage\StoreContactRequest;


class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		//$notifications = auth()->user()->unreadNotifications;
		return view('home');
	}

	public function pricing()
	{
		$product = Product::where('id', config('bo.DEFAULT_PRODUCT_ID'))->first();

		// get service_id of current logged-in user
		if (Auth::check()) {
			if (auth()->user()->account_id == '') {
				$cur_product_id = '';
			} else {
				$account = Account::where('id', auth()->user()->account_id)->first();
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
				'site'				=> 'required|alpha_num:ascii|without_spaces|max:10|unique:accounts,site',
				//'name'			=> 'required|max:100',
				//'account_name'	=> 'required|max:100|',
			],[
				'site.required' 		=> 'Site Name is Required!',
				'site.unique'   		=> 'This site code is already in use. Please try another.',
				'site.without_spaces'	=> 'Whitespace not allowed.'
			]);
		} else {
			$request->validate([
				'site'			=> 'required|alpha_num:ascii|without_spaces|max:10|unique:accounts,site',
				//'name'		=> 'required|max:100',
				'email'			=> 'required|email|max:100|unique:users,email',
				'account_name'	=> 'required|max:100|',
			],[
				'site.required' 		=> 'Site name is Required!',
				'site.unique'   		=> 'This site code is already in use. Please try another.',
				'site.without_spaces'	=> 'Whitespace not allowed.',
				'email.unique'  		=> 'This email is already registered. Please login first and the try to purchase service.',
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
			'success_url' 	=> route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'cancel_url' 	=> route('checkout.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'metadata' 		=> ['trx_type' => 'CHECKOUT'],
		]);

		// create checkout row
		$checkout					= new Checkout;
		$checkout->session_id		= $session->id;
		$checkout->checkout_date	= date('Y-m-d H:i:s');
		$checkout->site				= Str::lower($request->input('site'));
		$checkout->account_name		= $request->input('account_name');

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

		$checkout->start_date		= now();
		$checkout->end_date			= now()->addMonth($product->mnth);

		$checkout->status_code		= LandlordCheckoutStatusEnum::DRAFT->value;
		$checkout->ip				= $request->ip();

		$checkout->save();
		//$checkout_id				= $checkout->id;

		return redirect($session->url);
	}

	// used to pay subscription invoices
	public function paymentStripe(Request $request)
	{
		// get invoice details
		$invoice = Invoice::where('id', $request->input('invoice_id') )->first();

		// check if invoice is already paid
		if ($invoice->status_code <> LandlordInvoiceStatusEnum::DUE->value) {
			return redirect()->route('invoices.index')->with('error','Invoice #'.$invoice->invoice_no.' can not be paid!');
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
			'success_url' 	=> route('checkout.success-payment', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'cancel_url' 	=> route('checkout.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'metadata' 		=> ['trx_type' => 'PAYMENT'],
		]);

		 // create payment
		 $payment						= new Payment;
		 $payment->session_id			= $session->id;
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
		//$payment_id					= $payment->id;
		
		return redirect($session->url);
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

			$trx_type	=  $session->metadata->trx_type;
			Log::debug('landlord.home.success metadata trx_type='. $session->metadata->trx_type);
			
			$checkout = Checkout::where('session_id', $session->id)->first();
			if (!$checkout) {
				throw new NotFoundHttpException();
			}
			if ($checkout->status_code == LandlordCheckoutStatusEnum::DRAFT->value) {
				Log::debug('landlord.home.success checkout_id='. $checkout->id);
				// TODO Uncomment
				CreateTenant::dispatch($checkout->id);
			}
			return view('landlord.pages.info')->with('title','Thank you for purchasing '.config('app.name').' service!')
				->with('msg','We have received your payment. We are currently preparing your service instance. 
				It’s an automated process and generally take 5-10 minutes. You will receive email notification with service instance login credential and other details shortly.
				Please check your email after few minutes. Thanks again.');

		} catch (\Exception $e) {
			throw new NotFoundHttpException();
		}

	}
	

	// landed after successful subscription payment
	public function successPayment(Request $request)
	{
	
		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
		$sessionId = $request->get('session_id');

		try {
		
			$session = \Stripe\Checkout\Session::retrieve($sessionId);

			if (!$session) {
				throw new NotFoundHttpException;
			}

			$trx_type	=  $session->metadata->trx_type;
			Log::debug('landlord.home.success metadata trx_type='. $session->metadata->trx_type);

			// Mark invoice as paid
			$payment = Payment::where('session_id', $session->id)->first();
			if (!$payment) {
				throw new NotFoundHttpException();
			}

			if ($payment->status_code == LandlordPaymentStatusEnum::DRAFT->value) {
				Log::debug("landlord.home.success SubscriptionInvoicePaid payment_id= ".$payment->id);
				SubscriptionInvoicePaid::dispatch($payment->id);
			}
			return view('landlord.pages.info')->with('title','Payment Successful')
				->with('msg','Thank you for your payment. We have received your payment.');
			

		} catch (\Exception $e) {
			throw new NotFoundHttpException();
		}

	}

	// landed here for successful addon payment
	public function successAddon(Request $request)
	{
	
		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
		$sessionId = $request->get('session_id');

		try {
		
			$session = \Stripe\Checkout\Session::retrieve($sessionId);

			if (!$session) {
				throw new NotFoundHttpException;
			}

			$trx_type	=  $session->metadata->trx_type;
			Log::debug('landlord.home.success metadata trx_type='. $session->metadata->trx_type);

			$checkout = Checkout::where('session_id', $session->id)->first();
			if (!$checkout) {
				throw new NotFoundHttpException();
			}
			if ($checkout->status_code == LandlordCheckoutStatusEnum::DRAFT->value) {
				Log::debug('landlord.home.success checkout_id='. $checkout->id);
				AddAddon::dispatch($checkout->id);
			}
			return view('landlord.pages.info')->with('title','Thank you for purchasing add-on!')
				->with('msg','We have received your payment. Thanks again.');

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

			$trx_type	=  $session->metadata->trx_type;
			Log::debug('landlord.home.success metadata trx_type='. $session->metadata->trx_type);

			switch ($trx_type) {
				case "CHECKOUT":
					$checkout = Checkout::where('session_id', $session->id)->first();
					if (!$checkout) {
						throw new NotFoundHttpException();
					}

					if ($checkout->status_code == LandlordCheckoutStatusEnum::DRAFT->value) {
						$checkout->status_code = LandlordCheckoutStatusEnum::CANCELED->value;
						$checkout->update();
						Log::debug('landlord.home.success checkout Canceled');
					}
					return view('landlord.pages.info')->with('title','Checkout Canceled!')->with('msg','Checkout canceled by user request!');
					break;
				case "PAYMENT":
					$payment = Payment::where('session_id', $session->id)->first();
					if (!$payment) {
						throw new NotFoundHttpException();
					}

					if ($payment->status_code == LandlordPaymentStatusEnum::DRAFT->value) {
						$payment->status_code = LandlordPaymentStatusEnum::CANCELED->value;
						$payment->amount = 0;
						$payment->update();
						Log::debug('landlord.home.success Payment Canceled');
					}
					return view('landlord.pages.info')->with('title','Payment Canceled!')->with('msg','Payment canceled by user request!');
					break;
				default:
					Log::Error("landlord.home.success Invalid transaction type!");
			}
		} catch (\Exception $e) {
			throw new NotFoundHttpException();
		}

		return view('landlord.pages.info')->with('title','Transaction Canceled!')->with('msg','Transaction canceled by user request!');
	}


	// TODO Please use session_id to troublehsot in stripe dashboard
	public function webhook()
	{
		
		Log::debug('landlord.home.webhook Inside Webhook');
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
		$setup 		= Setup::with('relCountry')->where('id', config('bo.SETUP_ID'))->first();
		$invoice 	= Invoice::where('invoice_no', $invoice_no)->first();
		$account 	= Account::with('relCountry')->where('id', $invoice->account_id)->first();

		return view('landlord.admin.invoices.invoice', compact('invoice', 'account', 'setup'));
	}


	public function testNotification()
	{
		//$user = User::first();
		$user = User::where('id', 1001)->first();
		$action = "Submitted";

		$details = [
			'entity'		=> 'TICKET',
			'id'			=> $user->id,
			'from'			=> $user->name,
			'to'			=> $user->name,
			'subject'		=> '[TEST] FYI. Support Ticket #' . $user->id . ' has been ' . Str::lower($action) . '.',
			'greeting'		=> 'Hi ' . $user->name . ',',
			'body'			=> 'FYI, Support Ticket #' . $user->id . ' has been ' . Str::lower($action) . '.',
			'thanks'		=> 'Thank you for using ' . config('app.name') . '!',
			'actionText'	=> 'View Document',
			//'actionURL'	=> route('advances.show', ['advance' => $wf->article_id]),
			'actionURL'		=> route('users.show', $user->id),
		];

		// $details = [
		//		'greeting' => 'Hi Artisan',
		//		'body' => 'This is my first notification from ItSolutionStuff.com',
		//		'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
		//		'actionText' => 'View My Site',
		//		'actionURL' => url('/'),
		//		'id' => 10005
		// ];

		//Notification::send($user, new TestNotification($details));
		$user->notify(new Test($details));

		dd('done: ' . now());
	}


	public function demomail()
	{
		// send via mail
		$mailData = [
			'title' => 'Mail from ItSolutionStuff.com',
			'body' => 'This is for testing email using smtp.'
		];

		Mail::to('khondker@gmail.com')->send(new DemoMail($mailData));
		dd("Email is sent successfully.");

		// if (Mail::failures()) {
		//		return response()->Fail('Sorry! Please try again latter');
		// }else{
		//	return response()->success('Great! Successfully send in your mail');
		// }

		// send via notification
		//$user = User::where('id', 1001)->first();
		//$user->notify(new UserRegistered($user));
		//dd("Email is sent successfully.");

	}

	// public function preview($invoice_no)
	// {
	//		//$entity = static::ENTITY ;
	//		$invoice = Invoice::where('invoice_no', $invoice_no)->first();

	//		//return view('invoices.show',compact('invoice','entity'));
	//		return view('invoices.invoice',compact('invoice'));
	// }

	// public function payment($invoice_no)
	// {
	//		//$entity = static::ENTITY ;
	//		$invoice = Invoice::where('invoice_no', $invoice_no)->first();

	//		//return view('invoices.show',compact('invoice','entity'));
	//		return view('invoices.invoice',compact('invoice'));
	// }

	/**
	 * Store a newly created resource in storage.
	 */
	public function saveContact(StoreContactRequest $request)
	{
		$ENTITY	= 'CONTACT';

		//$request->merge(['ip' => Request::ip()]);
		//$request->merge(['ip' => '127.0.01']);

		$user_id = auth()->check() ? auth()->user()->id : config('bo.GUEST_USER_ID');

		$request->merge(['tenant'	=> tenant('id)')]);
		$request->merge(['user_id'	=> $user_id]);
		$request->merge(['ip'		=> $request->ip()]);
		

		$request->validate([
			'first_name'	=> 'required',
			'email'			=> 'required|email',
			//'phone'		=> 'required|digits:10|numeric',
			//'subject'		=> 'required',
			'message'		=> 'required'
		], [
			'first_name.required'	=> 'First Name is Required',
			'email.required'		=> 'Email is required.',
		]);

		// create contact with subject
		$request->merge(['subject'		=> 'Website Contact from '. $request->input('first_name')]);
		$contact = Contact::create($request->all());

		// Upload File, if any, insert row in attachment table and get attachments id
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $contact->id]);
			$request->merge(['entity'		=> $ENTITY]);
			$attachment_id = LandlordFileUpload::aws($request);

			// update back table with attachment_id
			$contact->attachment_id = $attachment_id;
			$contact->save();
		}

		// Send notification to the contact
		$contact->notify(new Contacted($contact));

		// Send notification to manager
		$mgr = User::where('id', config('bo.SUPPORT_MGR_ID'))->first();
		$mgr->notify(new Contacted($contact));

		return redirect()->route('home')->with('success', 'Thank you for contacting us. We will contact you shortly.');

		//return redirect()->back()->with(['success' => 'Thank you for contacting us. We will contact you shortly.']);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function joinMailList(StoreContactRequest $request)
	{
		
		$user_id = auth()->check() ? auth()->user()->id : config('bo.GUEST_USER_ID');
		$request->merge(['user_id'	=> $user_id]);
		$request->merge(['ip'		=> $request->ip()]);
		$request->validate([
			'email'				=> 'required|email',
		], [
			'email.required'		=> 'Email is required.',
		]);

		// create MailList
		$contact = MailList::create($request->all());
		
		return redirect()->route('home')->with('success', 'Thank you for joining our mailing list.');
		
	}
}
