<?php

namespace App\View\Components\Tenant\Alerts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Success extends Component
{
	//public $message;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $message)
	{
		//$this->message = $message;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.alerts.success');
	}
}