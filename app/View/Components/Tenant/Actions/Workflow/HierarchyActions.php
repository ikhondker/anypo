<?php

namespace App\View\Components\Tenant\Actions\Workflow;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Workflow\Hierarchy;

class HierarchyActions extends Component
{
	public $hierarchy;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public $hierarchyId)
	{
		$this->hierarchy 	= Hierarchy::where('id', $hierarchyId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.workflow.hierarchy-actions');
	}
}
