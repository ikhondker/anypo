<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyDateTime extends Component
{
	//public $label;
	//public $value;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $value, public string $label='')
	{
		$this->label = ($label == '')? 'Timestamp' : $label;
		//$this->value = $value;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.show.my-date-time');
	}
}
