<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\Log;

use App\Models\Tenant\DeptBudget;

class DeptBudgetStat extends Component
{
	public $dept_id;
	public $deptBudget;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->dept_id = $id;

		Log::debug('Value of dept_id=' . $this->dept_id);
		if ($this->dept_id == '0000'){
			// Get latest deptbudget of the current user
			$this->deptBudget				= DeptBudget::with('budget')->with('dept')->where('dept_id', auth()->user()->dept_id)->orderBy('id', 'DESC')->firstOrFail();
		} else {
			$this->deptBudget				= DeptBudget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('id', $this->dept_id)->firstOrFail();
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
