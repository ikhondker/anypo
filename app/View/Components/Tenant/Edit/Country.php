<?php

namespace App\View\Components\Tenant\Edit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Country extends Component
{
	public $countries;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $value)
	{
		$this->countries = \App\Models\Tenant\Lookup\Country::All();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.edit.country');
	}
}
