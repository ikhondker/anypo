<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\Log;

use App\Models\Tenant\DeptBudget;

class DeptBudgetStat extends Component
{
	//public $dept_id;
	public $deptBudget;

	/**
	 * Create a new component instance.
	 */
	public function __construct($dept_budget_id="0000")
	{
		Log::debug('components.tenant.dashboards.DeptBudgetStat Value of dept_budget_id=' . $dept_budget_id);

		//Log::debug('Value of dept_id=' . $id);
		//$this->deptBudget				= DeptBudget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('id', $id)->firstOrFail();
		if ($dept_budget_id == '0000'){	
			// no dept budge id is specified. HSow current user last dept budget
			// Get latest deptbudget of the current user
			$this->deptBudget				= DeptBudget::with('budget')->with('dept')->where('dept_id', auth()->user()->dept_id)->orderBy('id', 'DESC')->firstOrFail();
		} else {
			//$this->deptBudget				= DeptBudget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('id', $this->dept_id)->firstOrFail();
			$this->deptBudget				= DeptBudget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('id', $dept_budget_id)->firstOrFail();
		}

		Log::debug('components.tenant.dashboards.DeptBudgetPoPie Value of dept_id=' . $this->deptBudget->id);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.dept-budget-stat');
	}
}
