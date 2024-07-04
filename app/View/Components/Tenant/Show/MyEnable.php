<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyEnable extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $value,
		public string $label='Enable X:')
	{
		//
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.show.my-enable');
	}
}
