<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

//use App\Enum\UserRoleEnum;
use App\Models\Tenant\DeptBudget;
//use DB;
use Illuminate\Support\Facades\Log;

class DeptBudgetPoPie extends Component
{
	public $budget_labels = [];
	public $budget_data = [];
	public $budget_colors = [];
	public $deptBudget;

	/**
	 * Create a new component instance.
	 */
	public function __construct($dept_budget_id="0000")
	{

		Log::debug('components.tenant.charts.DeptBudgetPoPie Value of dept_budget_id=' . $dept_budget_id);
	
		if ($dept_budget_id == '0000'){
			// No dept budge id is specified. Show current user last dept budget
			$this->deptBudget = DeptBudget::where('dept_id', auth()->user()->dept_id )->with('dept')->with('budget')->orderBy('id', 'DESC')->get()->firstOrFail();
		} else {
		 	$this->deptBudget	= DeptBudget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('id', $dept_budget_id)->firstOrFail();
		}

		Log::debug('components.tenant.charts.DeptBudgetPoPie Value of dept_id=' . $this->deptBudget->id);

		$this->budget_labels[] = "Available";
		$this->budget_labels[] = "PO Booked";
		$this->budget_labels[] = "PO Issued";

		$this->budget_data[] = (int) $this->deptBudget->amount - $this->deptBudget->amount_po_booked -$this->deptBudget->amount_po_issued;
		$this->budget_data[] = (int) $this->deptBudget->amount_po_booked;
		$this->budget_data[] = (int) $this->deptBudget->amount_po_issued;

		// Generate random colors for the groups
		for ($i = 0; $i <= 3 ; $i++) {
			$this->budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		}

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.charts.dept-budget-po-pie');
	}
}
