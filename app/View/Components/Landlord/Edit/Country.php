<?php

namespace App\View\Components\Landlord\Edit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Country extends Component
{
	public $countries;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $value='')
	{
		$this->countries = \App\Models\Landlord\Lookup\Country::getAll();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.edit.country');
	}
}
