<?php

namespace App\View\Components\Tenant\Buttons\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class Edit extends Component
{
	public $object;
	public $id;
	public $route;
	public $title;

	/**
	 * Create a new component instance.
	 */
	public function __construct($object, $id=1001)
	{
		$this->object	= $object;
		$this->id		= $id;
		
		//$this->route = Str::lower(Str::plural($object));
		$this->route = Str::lower(Str::plural(Str::snake($object, '-')));
		$this->title = 'View '.$object;
	}
	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.buttons.show.edit');
	}
}
