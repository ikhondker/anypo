<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyCurrency extends Component
{
	public $value;
	//public $currency;
	//public $label;
	

	/**
	 * Create a new component instance.
	 */
	public function __construct($value)
	{
		$this->value = $value;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.show.my-currency');
	}
}
