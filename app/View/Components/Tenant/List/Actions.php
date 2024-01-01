<?php

namespace App\View\Components\Tenant\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class Actions extends Component
{
	public $object;
	public $id;
	public $show;
	public $edit;
	public $enable;
	
	public $route;
	public $title;

	/**
	 * Create a new component instance.
	 */
	public function __construct($object, $id=1, $show = true, $edit = true, $enable = false)
	{
		$this->object	= $object;
		$this->id		= $id;
		$this->show		= $show; 
		$this->edit		= $edit; 
		$this->enable	= $enable; 

		//$this->route = Str::lower(Str::plural($object));
		$this->route = Str::lower(Str::plural(Str::snake($object, '-')));
		$this->title = 'View '.$object;
	}


	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.list.actions');
	}
}
