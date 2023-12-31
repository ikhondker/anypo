<?php

namespace App\View\Components\Tenant\Notifications;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Unread extends Component
{
	public $notifications;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->notifications = auth()->user()->unreadNotifications; 
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.notifications.common');
	}
}
