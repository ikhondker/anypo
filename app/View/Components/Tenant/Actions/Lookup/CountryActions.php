<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Country;

class CountryActions extends Component
{
	public $country;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public $code)
	{
		$this->code 		= $code;
		$this->country = Country::where('country', $this->code)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.country-actions');
	}
}
