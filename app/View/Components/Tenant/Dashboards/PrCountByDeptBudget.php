<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\DeptBudget;

class PrCountByDeptBudget extends Component
{
	public $deptBudget;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $deptBudgetId = '0000')
	{

		if ($deptBudgetId == '0000'){ // Must get at least one dept budget as already checked before calling this component with empty dbid
			// Get latest dept budget of the current user
			$this->deptBudget	= DeptBudget::with('budget')->with('dept')->where('dept_id', auth()->user()->dept_id)
								->where('revision', false)
								->orderBy('id', 'DESC')->firstOrFail();
		} else {
			$this->deptBudget	= DeptBudget::with('budget')->with('dept')
								->where('id', $deptBudgetId)
								->where('revision', false)
								->orderBy('id', 'DESC')->firstOrFail();
		}

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.pr-count-by-dept-budget');
	}
}
