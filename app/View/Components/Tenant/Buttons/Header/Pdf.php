<?php

namespace App\View\Components\Tenant\Buttons\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class Pdf extends Component
{

	public $route;
	public $title;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $model, public string $id='1')
	{
		$this->route = Str::lower(Str::plural(Str::snake($model, '-')));
		$this->title = 'Print '.$model;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.buttons.header.pdf');
	}
}
