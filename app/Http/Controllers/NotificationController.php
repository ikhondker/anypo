<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;

use Illuminate\Support\Facades\Log;
use DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // show only unread notifications
        return view('notifications.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        // show all notifications
        return view('notifications.all');
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
        return view('notifications.show', compact('notification'));
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
        //$this->authorize('delete', $notification);

        $notif = auth()->user()->notifications()->where('id', $notification->id)->first();
        $notif->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted.');
    }

    public function read(Notification $notification)
    {
        //Log::debug("INSIDE notification");
        //Log::debug("notification=".$notification->id );
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
        //Log::debug("INSIDE notification purge");
        //Log::debug("notification=".$notification->id );

        $notifications = auth()->user()->readNotifications;
        foreach ($notifications as $notification) {
            Log::debug("Deleting id= ".$notification->id);
            DB::table('notifications')->where('id', $notification->id)->delete();
        }
        return redirect()->route('notifications.index')->with('success', 'Notifications purged.');
        //return back()->withMessage('Notifications purged successfully.');
    }
}
