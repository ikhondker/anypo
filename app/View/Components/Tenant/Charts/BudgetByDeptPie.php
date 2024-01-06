<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use DB;

class BudgetByDeptPie extends Component
{

	public 	$depb_labels = [];
	public $depb_data = [];
	public $depb_colors = [];

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		// ====================== Dept Allocated Budget Pie====================================
		$records = DB::select("SELECT d.name, db.amount
			FROM dept_budgets db, budgets b, depts d
			WHERE db.budget_id=b.id
			and b.fy = date('Y')
			and db.dept_id=d.id");
		
		foreach($records as $row) {
			$this->depb_labels[] = $row->name;
			$this->depb_data[] = (int) $row->amount;
		}
		// Generate random colours for the groups
		for ($i = 0; $i <= count($records); $i++) {
			$this->depb_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
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
