<?php

namespace App\View\Components\Tenant\Widgets\Po;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;

class ListByBuyer extends Component
{
	public $pos;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->pos 	= Po::ByBuyerAll()->with('dept')->with('supplier')->paginate(10);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.po.list-by-buyer');
	}
}
