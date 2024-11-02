<?php

namespace App\View\Components\Landlord\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyDate extends Component
{
	//public $value;
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(public string $value='')
	{
		//$this->value = $value;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.list.my-date');
	}
}
