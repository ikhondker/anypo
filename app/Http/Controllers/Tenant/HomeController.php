<?php

/**
 * ==================================================================================
 * @version v1.0
 * ==================================================================================
 * @file		HomeController.php
 * @brief		This file contains the implementation of the HomeController class.
 * @author		Iqbal H. Khondker
 * @created		27-Apr-2023
 * @copyright	(c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author					Comments
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
use App\Enum\Tenant\WflActionEnum;
# 3. Helpers
use App\Helpers\Tenant\FileUpload;
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
use Notification;
use App\Notifications\Tenant\Test;
use App\Notifications\Tenant\PrActions;
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

	public function testNotification($id = null)
	{

		//Log::debug('I am here testNotification');

		if(empty($id)){
			Log::debug('NO ID selected!');
		} else {
			Log::debug('Sending notification to id = ' . $id);
		}

		// Send notification to Pr creator
		$pr = PR::where('id', 1001)->first();
		$action = WflActionEnum::SUBMITTED->value;
		$actionURL = route('prs.show', $pr->id);
		$requestor = User::where('id',1001)->first();
		$requestor->notify(new PrActions($requestor, $pr, $action, $actionURL));

		dd('Done: '. now());
	}

	public function testNotification2()
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
		//		return response()->success('Great! Successfully send in your mail');
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
