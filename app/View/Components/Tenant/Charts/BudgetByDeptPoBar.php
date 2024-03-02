<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use DB;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use Illuminate\Support\Facades\Log;

class BudgetByDeptPoBar extends Component
{
	public $dept_budget_labels = [];
	public $dept_budget_amount = [];
	public $dept_budget_po_issued = [];
	public $depb_budget_colors = [];
	
	public 	$budget;
	public 	$deptBudgets;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $bid ='0000')
	{

		Log::debug('components.tenant.charts.BudgetByDeptPoBar Value of bid=' . $bid);

		if ($bid == '0000'){
			// No dept budge id is specified. Show current user last dept budget
			$this->budget		= Budget::orderBy('id', 'DESC')->firstOrFail();
			$this->deptBudgets 	= DeptBudget::where('budget_id', $this->budget->id)->with('dept')->with('budget')->orderBy('id', 'DESC')->get();
		} else {
			$this->budget		= Budget::where('id', $bid)->orderBy('id', 'DESC')->firstOrFail();
		 	$this->deptBudgets	= DeptBudget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('budget_id', $bid)->get();
		}

		foreach ($this->deptBudgets as $deptBudget){
			//Log::debug('Value of id=' . $deptBudget->dept->name);
			//Log::debug('Value of amount=' . $deptBudget->amount);

			$this->dept_budget_labels[] 	= $deptBudget->dept->name;
			$this->dept_budget_amount[] 	= (int) $deptBudget->amount;
			$this->dept_budget_po_issued[] 	= (int) $deptBudget->amount_po_issued + $deptBudget->amount_po_booked ;
		}
		
		// Generate random colours for the groups
		for ($i = 0; $i <= $this->deptBudgets->count(); $i++) {
			$this->depb_budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.charts.budget-by-dept-po-bar');
	}
}
