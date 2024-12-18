<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Supplier;

class SupplierInfo extends Component
{

	public $supplier;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $supplierId)
	{
		$this->supplier = Supplier::where('id', $supplierId)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.supplier-info');
	}
}
