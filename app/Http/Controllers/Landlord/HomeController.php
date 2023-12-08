<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			HomeController.php
* @brief		This file contains the implementation of the HomeController
* @path			\app\Http\Controllers\Landlord
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

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
 
// Models
use App\Models\User;

use App\Models\Landlord\Contact;

use App\Models\Landlord\Service;
use App\Models\Landlord\Account;
use App\Models\Landlord\Checkout;

use App\Models\Landlord\Admin\Invoice;

use App\Models\Landlord\Lookup\Product;

use App\Models\Landlord\Manage\Setup;

//use App\Models\Landlord\Manage\Country;

// Enums
use App\Enum\PackageEnum;

// Helpers
use App\Helpers\FileUpload;
use App\Helpers\LandlordEventLog;

// Notification
use Notification;
use App\Notifications\Landlord\Test;
use App\Notifications\Landlord\UserRegistered;
use App\Notifications\Landlord\InvoiceCreated;
use App\Notifications\Landlord\ServiceUpgraded;
use App\Notifications\Landlord\AddonPurchased;
use App\Notifications\Landlord\Contacted;

// Mail
use Mail;
use App\Mail\Landlord\DemoMail;

// Seeded
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Foundation\Http\FormRequest;
use Str;
use DB;


use App\Http\Requests\Landlord\StoreContactRequest;

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

	/**
	 * Store a newly created resource in storage.
	 */
	public function saveContact(StoreContactRequest $request)
	{
		$ENTITY   = 'CONTACT';

		//Log::debug("I AM HERE INSIDE STORE");

		//$request->merge(['ip'          => Request::ip()]);
		//$request->merge(['ip'          => '127.0.01']);

		$user_id = auth()->check() ? auth()->user()->id : config('bo.GUEST_USER_ID');

		//Log::debug("I AM HERE INSIDE STORE");

		$request->merge(['user_id'     => $user_id]);
		$request->merge(['ip'          => $request->ip()]);

		$request->validate([
			'name'      => 'required',
			'email'     => 'required|email',
			//'phone'     => 'required|digits:10|numeric',
			'subject'   => 'required',
			'message'   => 'required'
		], [
			'name.required' => 'Name is Required',
			'email.unique'   => 'Email is required.',
		]);

		// create contact
		$contact = Contact::create($request->all());

		// Upload File, if any, insert row in attachment table  and get attachments id
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'   => $contact->id]);
			$request->merge(['entity'       => $ENTITY]);  
			$attachment_id = FileUpload::upload($request);

			// update back table with attachment_id
			$contact->attachment_id = $attachment_id;
			$contact->save();
		}

		// Send notification to the contact
		$contact->notify(new Contacted($contact));

		// Send notification to manager
		$mgr = User::where('id', config('bo.SUPPORT_MGR_ID'))->first();
		$mgr->notify(new Contacted($contact));

		return redirect()->back()->with(['success' => 'Thank you for contacting us. We will contact you shortly.']);
	}

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

		return view('landlord.admin.invoices.invoice', compact('invoice', 'account', 'setup'));
	}


	public function testNotification()
	{
		//$user = User::first();
		$user = User::where('id', 1001)->first();
		$action = "Submitted";

		$details = [
			'entity'           => 'TICKET',
			'id'            => $user->id,
			'from'          => $user->name,
			'to'            => $user->name,
			'subject'       => 'FYI. Support Ticket #' . $user->id . ' has been ' . Str::lower($action) . '.',
			'greeting'      => 'Hi ' . $user->name . ',',
			'body'          => 'FYI, Support Ticket #' . $user->id . ' has been ' . Str::lower($action) . '.',
			'thanks'        => 'Thank you for using ' . config('app.name') . '!',
			'actionText'    => 'View Document',
			//'actionURL'   => route('advances.show', ['advance' => $wf->article_id]),
			'actionURL'     => route('users.show', $user->id),
		];

		// $details = [
		//     'greeting' => 'Hi Artisan',
		//     'body' => 'This is my first notification from ItSolutionStuff.com',
		//     'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
		//     'actionText' => 'View My Site',
		//     'actionURL' => url('/'),
		//     'id' => 10005
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
		//     return response()->Fail('Sorry! Please try again latter');
		// }else{
		//    return response()->success('Great! Successfully send in your mail');
		// }

		// send via notification
		//$user = User::where('id', 1001)->first();
		//$user->notify(new UserRegistered($user));
		//dd("Email is sent successfully.");

	}

	// public function preview($invoice_no)
	// {
	//     //$entity = static::ENTITY ;
	//     $invoice = Invoice::where('invoice_no', $invoice_no)->first();

	//     //return view('invoices.show',compact('invoice','entity'));
	//     return view('invoices.invoice',compact('invoice'));
	// }

	// public function payment($invoice_no)
	// {
	//     //$entity = static::ENTITY ;
	//     $invoice = Invoice::where('invoice_no', $invoice_no)->first();

	//     //return view('invoices.show',compact('invoice','entity'));
	//     return view('invoices.invoice',compact('invoice'));
	// }

}
