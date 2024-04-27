<?php

namespace App\View\Components\Tenant\Buttons\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class Lists extends Component
{
	public $object;
	public $label;
	public $id;

	public $route;
	public $title;

	/**
	 * Create a new component instance.
	 */
	public function __construct($object,$label="")
	{
		 $this->object	= $object;
		 $this->label	= $label;

		$this->route = Str::lower(Str::plural(Str::snake($object, '-')));
		//$this->title = $object. ' List';
		$this->title = ($this->label=="" ? $this->object : $this->label) .' List';
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.buttons.header.lists');
	}
}
