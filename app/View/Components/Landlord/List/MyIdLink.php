<?php

namespace App\View\Components\Landlord\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class MyIdLink extends Component
{
	public $object;
	public $id;
	public $route;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct($object, $id=1)
	{
		$this->object	= $object;
		$this->id		= $id;
		$this->route 	= Str::lower(Str::plural(Str::snake($object, '-')));
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.list.my-id-link');
	}
}
