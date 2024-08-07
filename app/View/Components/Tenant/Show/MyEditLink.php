<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class MyEditLink extends Component
{
	//public $object;
	//public $id;
	public $route;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $object, public string $id='1')
	{
		//$this->object	= $object;
		//$this->id		= $id;

		$this->route = Str::lower(Str::plural(Str::snake($object, '-')));
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.show.my-edit-link');
	}
}
