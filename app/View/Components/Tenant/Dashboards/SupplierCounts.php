<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Supplier;

class SupplierCounts extends Component
{
	public $count_total;
	public $count_enable;
	public $count_disable;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->count_total	= Supplier::count();
		$this->count_enable	= Supplier::where('enable',true )->count();
		$this->count_disable	= Supplier::where('enable',false )->count();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.supplier-counts');
	}
}
