<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Designation;

class DesignationActions extends Component
{
	public $designation;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $designationId)
	{
			$this->designation 	= Designation::where('id', $designationId)->get()->firstOrFail();
		//}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.designation-actions');
	}
}
