<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use DB;

use App\Models\Tenant\DeptBudget;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeptBudgetBar extends Component
{
	public $dept_budget_labels = [];
	public $dept_amount = [];
	//public $dept_amount = [];
	public $dept_budget_colors = [];
	public $deptBudget;
	

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $dbid ='0000')
	{

		//Log::debug('components.tenant.charts.DeptBudgetBar Value of dept_budget_id=' . $dbid);
	
		if ($dbid == '0000'){ // Must get at least one dept budget as already checked before calling this component with empty dbid
			// Get latest dept budget of the current user
			$this->deptBudget = DeptBudget::where('dept_id', auth()->user()->dept_id )->with('dept')->with('budget')->orderBy('id', 'DESC')->get()->firstOrFail();
		} else {
		 	$this->deptBudget	= DeptBudget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('id', $dbid)->firstOrFail();
		}

		//Log::debug('components.tenant.charts.DeptBudgetBar Value of dept_id=' . $this->deptBudget->id);

		$this->dept_budget_labels[] = 'Budget';
		$this->dept_amount[] = (int) $this->deptBudget->amount;

		$this->dept_budget_labels[] = 'PO';
		$this->dept_amount[] = (int)$this->deptBudget->amount_po_booked +$this->deptBudget->amount_po;

		$this->dept_budget_labels[] = 'PR';
		$this->dept_amount[] = (int)$this->deptBudget->amount_pr_booked +$this->deptBudget->amount_pr;

		$this->dept_budget_labels[] = 'GRS';
		$this->dept_amount[] = (int)$this->deptBudget->amount_grs;

		$this->dept_budget_labels[] = 'Invoice';
		$this->dept_amount[] = (int)$this->deptBudget->amount_invoice;

		$this->dept_budget_labels[] = 'Payment';
		$this->dept_amount[] = (int)$this->deptBudget->amount_payment;

		// Generate random colours for the groups
		for ($i = 0; $i <= 6; $i++) {
			$this->dept_budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		}

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.charts.dept-budget-bar');
	}
}
