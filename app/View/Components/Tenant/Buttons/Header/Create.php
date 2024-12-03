<?php

namespace App\View\Components\Tenant\Buttons\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class Create extends Component
{

	public $route;
	public $title;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $model, public string $label="")
	{

		$this->route = Str::lower(Str::plural(Str::snake($model, '-')));
		//$this->title = 'Create '.$model;
		//$this->title = 'Create '. ($this->label=="" ? $this->model : $this->label);
		$this->title = 'Create';


	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.buttons.header.create');
	}
}
