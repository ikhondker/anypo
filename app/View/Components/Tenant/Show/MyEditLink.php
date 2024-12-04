<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class MyEditLink extends Component
{

	public $route;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $model, public string $id='1')
	{
		$this->route = Str::lower(Str::plural(Str::snake($model, '-')));
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.show.my-edit-link');
	}
}
