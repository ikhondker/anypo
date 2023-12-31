<?php

namespace App\View\Components\Tenant\Edit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Currency extends Component
{
	public $currencies;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $value)
	{
		$this->currencies = \App\Models\Tenant\Lookup\Currency::getActives();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.edit.currency');
	}
}
