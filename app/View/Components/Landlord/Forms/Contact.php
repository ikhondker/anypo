<?php

namespace App\View\Components\Landlord\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Contact extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $formType ="contact")
	{
		//
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.forms.contact');
	}
}
