<?php

namespace App\View\Components\Landlord\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


use Str;
class Actions extends Component
{
	public $object;
	public $id;
	public $edit;
	public $enable;
	
	public $route;
	public $title;
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct($object, $id=1, $edit = true, $enable = true)
	{
		$this->object	= $object;
		$this->id		= $id;
		$this->edit		= $edit; 
		$this->enable	= $enable; 

		//$this->route = Str::lower(Str::plural($object));
		$this->route = Str::lower(Str::plural(Str::snake($object, '-')));
		$this->title = 'View '.$object;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.list.actions');
	}
}
