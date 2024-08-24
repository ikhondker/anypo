<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\DeptBudget;

class DeptBudgetActions extends Component
{
	public $deptBudget;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $deptBudgetId)
	{
		$this->deptBudget = DeptBudget::where('id', $deptBudgetId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.dept-budget-actions');
	}
}
