<?php

namespace App\View\Components\Tenant\Edit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CityStateZip extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $city='', public string $state='', public string $zip='')
	{
		//
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.edit.city-state-zip');
	}
}