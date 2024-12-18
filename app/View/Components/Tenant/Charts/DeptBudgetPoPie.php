<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\DeptBudget;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeptBudgetPoPie extends Component
{
	public $budget_labels = [];
	public $budget_data = [];
	public $budget_colors = [];
	public $deptBudget;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $dbid ='0000'	)
	{

		//Log::debug('components.tenant.charts.DeptBudgetPoPie Value of dept_budget_id=' . $dbid);

		if ($dbid == '0000'){ // Must get at least one dept budget as already checked before calling this component with empty dbid
			// Get latest dept budget of the current user
			$this->deptBudget 	= DeptBudget::where('dept_id', auth()->user()->dept_id )->with('dept')->with('budget')->orderBy('id', 'DESC')->get()->firstOrFail();
		} else {
		 	$this->deptBudget	= DeptBudget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('id', $dbid)->firstOrFail();

		}
		//Log::debug('components.tenant.charts.DeptBudgetPoPie Value of dept_budget_id=' . $this->deptBudget->id);

		$this->budget_labels[] = "Available";
		$this->budget_labels[] = "PO Booked";
		$this->budget_labels[] = "PO Issued";

		$this->budget_data[] = (int) $this->deptBudget->amount - $this->deptBudget->amount_po_booked -$this->deptBudget->amount_po;
		$this->budget_data[] = (int) $this->deptBudget->amount_po_booked;
		$this->budget_data[] = (int) $this->deptBudget->amount_po;

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
