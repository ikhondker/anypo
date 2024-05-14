<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use Illuminate\Support\Facades\Log;
use DB;

class BudgetByDeptPie extends Component
{

	public	$dept_budget_labels = [];
	public	$dept_budget_data = [];
	public	$dept_budget_colors = [];

	public 	$budget;
	public 	$deptBudgets;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $bid ='0000')
	{
		//Log::debug('components.tenant.charts.BudgetByDeptPie Value of budget_id = ' . $bid);

		if ($bid == '0000'){
			// No dept budge id is specified. Show current user last dept budget
			$this->budget		= Budget::orderBy('id', 'DESC')->firstOrFail();
			//Log::debug('components.tenant.charts.BudgetByDeptPie Value of this->budget->id = ' . $this->budget->id);
			$this->deptBudgets 	= DeptBudget::where('budget_id',$this->budget->id)->with('dept')->with('budget')->orderBy('id', 'DESC')->get();
		} else {
			$this->budget		= Budget::where('id', $bid)->orderBy('id', 'DESC')->firstOrFail();
		 	$this->deptBudgets	= DeptBudget::where('budget_id', $bid)->with('budget')->with('dept')->orderBy('id', 'DESC')->get();
		}

		//Log::debug('components.tenant.charts.BudgetByDeptPie dept count = ' . $this->deptBudgets->count());

		foreach ($this->deptBudgets as $deptBudget){
			// Log::debug('components.tenant.charts.BudgetByDeptPie Value of dept_name=' . $deptBudget->dept->name);
			$this->dept_budget_labels[] 	= $deptBudget->dept->name;
			$this->dept_budget_data[] 		= (int) $deptBudget->amount;
		}

		// Generate random colors for the groups
		for ($i = 0; $i <= $this->deptBudgets->count(); $i++) {
			$this->dept_budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.charts.budget-by-dept-pie');
	}
}
