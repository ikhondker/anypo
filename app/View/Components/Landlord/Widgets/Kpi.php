<?php

namespace App\View\Components\Landlord\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;



class Kpi extends Component
{
	//public $route;

	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $value,
		public string $label='KPI NAME',
		public string $icon='abs027',
		public string $route='dashboards',
	)
	{
		//
		//$this->route	= $route;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.widgets.kpi');
	}
}
