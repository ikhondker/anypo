<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Group;

class GroupActions extends Component
{
	public $group;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $groupId)
	{

			$this->group 	= Group::where('id', $groupId)->get()->firstOrFail();

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.group-actions');
	}
}
