<?php

namespace App\View\Components\Tenant\Alert;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Error extends Component
{
	//public $message;
	/**
	 * Create a new component instance.
	 */
	public function __construct( public string $message = '')
	{
		//$this->message = $message;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.alert.error');
	}
}
