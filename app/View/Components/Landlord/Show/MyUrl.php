<?php

namespace App\View\Components\Landlord\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyUrl extends Component
{
	//public $label;
	//public $value;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(
		public string $value,
		public string $label='URL X:'
	)
	{
		//$this->label = ($label == '')? 'Name' : $label;
		//$this->value = $value;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.show.my-url');
	}
}
