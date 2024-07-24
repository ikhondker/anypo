<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\Log;

use App\Models\Tenant\DeptBudget;

class DeptBudgetStat extends Component
{

	public $deptBudget;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $dbid = '0000')
	{
		//$this->dept_budget_id = $dept_budget_id;

		//Log::debug('components.tenant.dashboards.DeptBudgetStat Value of input dept_budget_id=' . $dbid);
		//Log::debug('components.tenant.dashboards.DeptBudgetStat Value of user_id=' . auth()->user()->id .' auth()->user()->dept_id='.auth()->user()->dept_id);

		if ($dbid == '0000'){ // Must get at least one dept budget as already checked before calling this component with empty dbid
			// Get latest dept budget of the current user
			$this->deptBudget	= DeptBudget::with('budget')->with('dept')->where('dept_id', auth()->user()->dept_id)
								->where('revision', false)
								->orderBy('id', 'DESC')->firstOrFail();
		} else {
			//$this->deptBudget				= DeptBudget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('id', $this->dept_id)->firstOrFail();
			$this->deptBudget	= DeptBudget::with('budget')->with('dept')
								->where('id', $dbid)
								->where('revision', false)
								->orderBy('id', 'DESC')->firstOrFail();
		}
		//Log::debug('components.tenant.dashboards.DeptBudgetStat output Value of this->deptBudget->id = ' . $this->deptBudget->id);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.dept-budget-stat');
	}
}
