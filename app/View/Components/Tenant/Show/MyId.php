<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyId extends Component
{
	//public $id;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $id)
	{

		//$this->id = $id;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.show.my-id');
	}
}
