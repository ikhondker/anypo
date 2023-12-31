<?php
 
namespace App\View\Composers;
 
//use App\Repositories\UserRepository;
use Illuminate\View\View;
 
//use App\Models\Setup;
use App\Models\Notification;

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

		if (auth()->check()){
			//$_notifications = auth()->user()->Notifications;
			$notifications = auth()->user()->unreadNotifications; 
			$count_unread_notifications = auth()->user()->unreadNotifications->count();
		} else {
			$notifications = new Notification; 
			$count_unread_notifications = 0;

		}
		$view->with(['_count_unread_notifications' => $count_unread_notifications,'_notifications' => $notifications]);
		//$view->with('count', $this->users->count());
	}
}