<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\DeptBudget;

class DeptBudgetStat extends Component
{
	public $id;
	public $deptBudget;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id='0000')
	{
		$this->id = $id;

		if ($this->id == '0000'){
			// Get latest deptbudget of the current user
			$this->deptBudget				= DeptBudget::with('budget')->with('dept')->where('dept_id', auth()->user()->dept_id)->orderBy('id', 'DESC')->firstOrFail();
		} else {
			$this->deptBudget				= DeptBudget::with('budget')->with('dept')->where('id', $id)->firstOrFail();
		}
			
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.dept-budget-stat');
	}
}
