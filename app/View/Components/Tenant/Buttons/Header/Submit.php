<?php

namespace App\View\Components\Tenant\Buttons\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class Submit extends Component
{
	public $object;
	public $id;

	public $route;
	public $title;

	/**
	 * Create a new component instance.
	 */
	public function __construct($object, $id=1)
	{
		$this->object   = $object;
		$this->id       = $id;

		$this->route = Str::lower(Str::plural(Str::snake($object, '-')));
		$this->title = 'Submit '.$object;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.buttons.header.submit');
	}
}
