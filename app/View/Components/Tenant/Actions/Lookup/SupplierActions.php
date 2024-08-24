<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Supplier;

class SupplierActions extends Component
{
	public $supplier;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $supplierId)
	{
		$this->supplier 	= Supplier::where('id', $supplierId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.supplier-actions');
	}
}
