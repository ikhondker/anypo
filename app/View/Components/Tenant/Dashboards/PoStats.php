<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;

class PoStats extends Component
{
	public $po;


	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $id)
	{
		$this->po 		= Po::where('id', $id)->get()->firstOrFail();
	}


	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.po-stats');
	}
}
