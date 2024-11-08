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
use App\Models\Landlord\Manage\Config;
use App\Models\Landlord\Manage\Contact;
use App\Models\Landlord\Manage\Checkout;

# 2. Enums
use App\Enum\Landlord\PaymentMethodEnum;
use App\Enum\Landlord\CheckoutStatusEnum;
use App\Enum\Landlord\InvoiceStatusEnum;
use App\Enum\Landlord\PaymentStatusEnum;
# 3. Helpers
use App\Helpers\Landlord\FileUpload;
//use App\Helpers\EventLog;
# 4. Notifications
use Notification;
//use App\Notifications\Landlord\Test;
//use App\Notifications\Landlord\UserRegistered;
//use App\Notifications\Landlord\InvoiceCreated;
//use App\Notifications\Landlord\ServiceUpgraded;
//use App\Notifications\Landlord\AddonPurchased;

use App\Notifications\Landlord\Contacted;
# 5. Jobs
use App\Jobs\Landlord\CreateTenant;
use App\Jobs\Landlord\AddAddon;
use App\Jobs\Landlord\AddAdvance;
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
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
# 13. FUTURE
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
	public function saveLandlordContact(StoreContactRequest $request)
	{
		$ENTITY	= 'CONTACT';

		// demo page
		if ($request->has('type')) {
			if ($request->has('demo')) {
				$request->merge(['type'	=> 'demo']);
			} elseif ($request->has('bug')) {
				$request->merge(['type'	=> 'bug']);
			} else {
				$request->merge(['type'	=> 'contact']);
			}
	   	} else {
			$request->merge(['type'	=> 'contact']);
		}

		//$request->merge(['ip' => Request::ip()]);
		//$request->merge(['ip' => '127.0.01']);
		//Log::debug('$request->path(): '.$request->path());

		$user_id = auth()->check() ? auth()->user()->id : config('bo.GUEST_USER_ID');

		//$request->merge(['tenant'	=> tenant('id)')]);
		$request->merge(['user_id'	=> $user_id]);
		$request->merge(['ip'		=> $request->ip()]);

		$request->validate([
			'first_name'	=> 'required',
			'email'			=> 'required|email',
			//'phone'		=> 'required|digits:10|numeric',
			//'subject'		=> 'required',
			'notes'		=> 'required'
		], [
			'first_name.required'	=> 'First Name is Required',
			'email.required'		=> 'Email is required.',
		]);

		// create contact with subject
		$request->merge(['subject'		=> 'ANYPO.NET Query : '. $request->input('first_name')]);
		$contact = Contact::create($request->all());

		// Upload File, if any, insert row in attachment table and get attachments id
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $contact->id]);
			$request->merge(['entity'		=> $ENTITY]);
			$attachment_id = FileUpload::aws($request);

			// update back table with attachment_id
			$contact->attachment_id = $attachment_id;
			$contact->save();
		}

		// Send notification to the contact
		$contact->notify(new Contacted($contact));

		// Send notification to support/manager
		$support = User::where('id', config('bo.SUPPORT_MGR_ID'))->first();
		$support->notify(new Contacted($contact));

		return redirect()->route('home')->with('success', 'Thank you for contacting us. We will contact you shortly.');

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
			'join_email'			=> 'required|email',
		], [
			'join_email.required'	=> 'Email is required.',
		]);
		$request->merge(['email'	=> $request->input('join_email')]);

		// create MailList
		$contact = MailList::create($request->all());

		return view('landlord.pages.info')->with('title','Thank you for joining our mailing list.')
				->with('msg','Thank you for joining our mailing list.');

		//return redirect()->route('home')->with('success', 'Thank you for joining our mailing list.');

	}
}
