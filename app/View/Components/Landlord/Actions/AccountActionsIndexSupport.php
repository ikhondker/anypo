<?php

namespace App\View\Components\Landlord\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AccountActionsIndexSupport extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.actions.account-actions-index-support');
	}
}
