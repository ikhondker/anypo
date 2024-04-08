<?php

/**
 * ==================================================================================
 * @version v1.0
 * ==================================================================================
 * @file		   HomeController.php
 * @brief		  This file contains the implementation of the HomeController class.
 * @author		 Iqbal H. Khondker
 * @created		27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    				   Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.1	Iqbal H Khondker		Copied from bo and modified for removing landlord
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
*/

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

# 1. Models
use App\Models\User;
use App\Models\Tenant\Pr;
# 2. Enums
use App\Enum\WflActionEnum;
# 3. Helpers
use App\Helpers\FileUpload;
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
use Notification;
use App\Notifications\Tenant\Test;
use App\Notifications\PrActions;
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Mail;
use Illuminate\Support\Facades\Auth;
use Str;
# 13. FUTURE 

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

	public function help()
	{
		return view('tenant.help.help');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function saveContact(StoreContactRequest $request)
	{
		$ENTITY	= 'CONTACT';

		//$request->merge(['ip'		=> Request::ip()]);
		//$request->merge(['ip'		=> '127.0.01']);

		$user_id = auth()->check() ? auth()->user()->id : config('bo.GUEST_USER_ID');


		$request->merge(['user_id'	=> $user_id]);
		$request->merge(['ip'		=> $request->ip()]);

		$request->validate([
			'name'		=> 'required',
			'email'		=> 'required|email',
			//'phone'	=> 'required|digits:10|numeric',
			'subject'	=> 'required',
			'message'	=> 'required'
		], [
			'name.required'	=> 'Name is Required',
			'email.unique'	=> 'Email is required.',
		]);

		// create contact
		$contact = Contact::create($request->all());

		// Upload File, if any, insert row in attachment table  and get attachments id
		if ($file = $request->file('file_to_upload')) {
			$request->merge(['article_id'	=> $contact->id ]);
			$request->merge(['entity'		=> $ENTITY ]);
			$attachment_id = FileUpload::aws($request);

			// update back table with attachment_id
			$contact->attachment_id = $attachment_id;
			$contact->save();
		}

		// Send notification to the contact
		$contact->notify(new Contacted($contact));

		// Send notification to support manager
		$mgr = User::where('id', config('bo.SUPPORT_MGR_ID'))->first();
		$mgr->notify(new Contacted($contact));

		return redirect()->back()->with(['success' => 'Thank you for contacting us. We will contact you shortly.']);
	}

	public function testNotification1()
	{
		// Send notification to Pr creator
		$pr = PR::where('id', 1001)->first();
		$to = User::where('id', $pr->requestor_id)->first();
		$to->notify(new PrActions($to, $pr, WflActionEnum::APPROVED->value));
		dd('Done: '. now());
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
			'subject'		=> '[ TEST ] Support Ticket #'. $user->id.' has been '.Str::lower($action).'.',
			'greeting'		=> 'Hi '.$user->name.',',
			'body'			=> 'Please note, Support Ticket #'.$user->id.' has been '.Str::lower($action).'.',
			'thanks'		=> 'Thank you for using '. config('app.name').'!',
			'actionText'	=> 'View Document',
			//'actionURL'	=> route('advances.show', ['advance' => $wf->article_id]),
			'actionURL'		=> route('users.show', $user->id),
		];

		// $details = [
		//		'greeting' => 'Hi Artisan',
		//		'body' => 'This is my first notification from ItSolutionStuff.com',
		//		'thanks' => 'Thank you for using ItSolutionStuff.com tutorial!',
		//		'actionText' => 'View My Site',
		//		'actionURL' => url('/'),
		//		'id' => 10005
		// ];

		//Notification::send($user, new TestNotification($details));
		$user->notify(new Test($details));

		dd('done1: '. now());
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
		//    return response()->success('Great! Successfully send in your mail');
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


}
