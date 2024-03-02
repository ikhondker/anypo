<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use DB;

class DeptBudgetBar extends Component
{
    public $depb_budget_labels = [];
	public $depb_budget_amount = [];
	public $depb_budget_po_issued = [];
	public $depb_budget_colors = [];

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		// ====================== Dept Allocated vs used Budget====================================
		$records = DB::select("SELECT d.name, db.amount, db.amount_po_issued
		FROM dept_budgets db, budgets b, depts d
		WHERE db.budget_id=b.id
		and b.fy = date('Y')
		and db.dept_id=d.id");

		foreach($records as $row) {
			$this->depb_budget_labels[] = $row->name;
			$this->depb_budget_amount[] = (int) $row->amount;
			$this->depb_budget_po_issued[] = (int) $row->amount_po_issued;

		}
		// Generate random colours for the groups
		for ($i = 0; $i <= count($records); $i++) {
			$this->depb_budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
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
