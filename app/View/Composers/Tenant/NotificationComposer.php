<?php

namespace App\View\Composers\Tenant;

//use App\Repositories\UserRepository;
use Illuminate\View\View;

//use App\Models\Setup;
use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Notification;

use Illuminate\Support\Facades\Log;


class NotificationComposer
{
	/**
	 * Create a new profile composer.
	 */
	public function __construct() {}

	/**
	 * Bind data to the view.
	 */
	public function compose(View $view): void
	{

		//Log::debug('NotificationComposer ... ');

		if (auth()->check()){
			//$_notifications = auth()->user()->Notifications;
			$notifications = auth()->user()->unreadNotifications;
			$count_unread_notifications = auth()->user()->unreadNotifications->count();
		} else {
			$notifications = new Notification;
			$count_unread_notifications = 0;

		}
		$view->with(['_tenant_count_unread_notifications' => $count_unread_notifications,'_tenant_notifications' => $notifications]);
		//$view->with('count', $this->users->count());
	}
}
