<?php

namespace App\View\Components\Tenant\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectLink extends Component
{
	//public $id;
	//public $label;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $id='1001',public string $label='')
	{
		//$this->id =$id;
		//$this->label =$label;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.list.project-link');
	}
}
