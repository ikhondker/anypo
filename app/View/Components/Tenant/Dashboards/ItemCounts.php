<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Item;

class ItemCounts extends Component
{
	public $count_total;
	public $count_enable;
	public $count_disable;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{

		$this->count_total		= Item::count();
		$this->count_enable		= Item::where('enable',true )->count();
		$this->count_disable	= Item::where('enable',false )->count();
		//$count_draft	= Pr::where('auth_status',AuthStatusEnum::DRAFT->value )->count();

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.item-counts');
	}
}
