<?php

namespace App\View\Components\Tenant\Edit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notes extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $value='')
	{
		// if (is_null($value)){
		// 	$this->value = '';
		// } else {
		//	$this->value = $value;
		//}
	}
	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.edit.notes');
	}
}
