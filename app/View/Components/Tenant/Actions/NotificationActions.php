<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Notification;

class NotificationActions extends Component
{
	public $notification;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public $id='')
	{
		$this->id 		= $id;
		if ($this->id <> ''){
			$this->notification 	= Notification::where('id', $this->id)->get()->firstOrFail();
		} else {
			$this->notification 	= new Notification;
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.notification-actions');
	}
}
