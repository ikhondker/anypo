<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			NotificationController.php
* @brief		This file contains the implementation of the NotificationController
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
use App\Models\Landlord\Notification;

// Enums
// Helpers

// Seeded
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		// show only open notifications
		$notifications = auth()->user()->Notifications;
		return view('landlord.notifications.index', with(compact('notifications')));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Notification  $notification
	 * @return \Illuminate\Http\Response
	 */
	public function show(Notification $notification)
	{
		return view('landlord.notifications.show',compact('notification'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Notification  $notification
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Notification $notification)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Notification  $notification
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Notification $notification)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Notification  $notification
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Notification $notification)
	{
		abort(403);
	}

	public function read(Notification $notification)
	{
		//Log::debug("INSIDE notification");
		//Log::debug("notification=".$notification->id );

		$notif = auth()->user()->notifications()->where('id', $notification->id)->first();
		if ($notif) {
			 $notif->markAsRead();
			 //return redirect()->route('dashboards.index')->with('success','Notification marked as read.');
			 //return redirect($notification->data['link']);
			 return back()->withMessage('Notification marked as read.');
		}
	}

}
