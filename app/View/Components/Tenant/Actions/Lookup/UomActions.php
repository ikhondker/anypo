<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Uom;

class UomActions extends Component
{
	public $uom;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $uomId)
	{
		$this->uom 	= Uom::where('id', $uomId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.uom-actions');
	}
}
