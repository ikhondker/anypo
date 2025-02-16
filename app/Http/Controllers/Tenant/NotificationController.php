<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			NotificationController.php
* @brief		This file contains the implementation of the NotificationController
* @path			\App\Http\Controllers\Tenant
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

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Notification;
use App\Http\Requests\Tenant\StoreNotificationRequest;
use App\Http\Requests\Tenant\UpdateNotificationRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
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
# 13. FUTURE

use Illuminate\Http\Request;

class NotificationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		// show only unread notifications
		return view('tenant.notifications.index');
	}



	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreNotificationRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Notification $notification)
	{
		$id = $notification->id;

		return view('tenant.notifications.show', compact('notification','id'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Notification $notification)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateNotificationRequest $request, Notification $notification)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Notification $notification)
	{
		$this->authorize('delete', $notification);

		$notif = auth()->user()->notifications()->where('id', $notification->id)->first();
		$notif->delete();

		return redirect()->route('notifications.index')->with('success', 'Notification deleted.');
	}

	public function markNotification(Request $request){
		auth()->user()
			->unreadNotifications
			->when($request->input('id'), function ($query) use ($request) {
				return $query->where('id', $request->input('id'));
			})
			->markAsRead();

		return response()->noContent();
	}

	/**
	 * Display a listing of the resource.
	 */
	public function all()
	{
		// show all notifications
		return view('tenant.notifications.all');
	}

	/**
	 * Display a listing of the resource.
	 */
	public function full()
	{
		// show full notifications for tenant
		$notifications = Notification::orderBy('created_at', 'DESC')->paginate(10);
		return view('tenant.notifications.full', compact('notifications'));
	}


	public function read(Notification $notification)
	{
		//$notification->markAsRead();
		//return back()->withMessage('Notification marked as read.');

		$notif = auth()->user()->notifications()->where('id', $notification->id)->first();
		if ($notif) {
			$notif->markAsRead();
			//return redirect()->route('dashboards.index')->with('success','Notification marked as read.');
			//return redirect($notification->data['link']);
			return redirect()->route('notifications.index')->with('success', 'Notification marked as read.');
			//return back()->withMessage('Notification marked as read.');
		}
	}
	public function purge()
	{
		//Log::debug("tenant.notification.purge notification=".$notification->id );

		$notifications = auth()->user()->readNotifications;
		foreach ($notifications as $notification) {
			Log::debug("tenant.notification.purge Deleting id= ".$notification->id);
			DB::table('notifications')->where('id', $notification->id)->delete();
		}
		return redirect()->route('notifications.index')->with('success', 'Notifications purged.');
		//return back()->withMessage('Notifications purged successfully.');
	}
}
