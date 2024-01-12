<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Enum\UserRoleEnum;

use DB;
use Illuminate\Support\Facades\Log;

class BudgetPie extends Component
{
	public 	$budget_labels = [];
	public $budget_data = [];
	public $budget_colors = [];

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		//'dept_id', auth()->user()->dept_id
		switch (auth()->user()->role->value) {
			case UserRoleEnum::HOD->value:
				$sql= "SELECT db.amount - db.amount_po_booked - db.amount_po_issued as amount, db.amount_po_booked, db.amount_po_issued
				FROM budgets b, dept_budgets db
				WHERE b.id=db.budget_id
				AND b.fy = date('Y')
				AND db.dept_id= ".auth()->user()->dept_id." ";
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$sql= "SELECT b.amount - b.amount_po_booked - b.amount_po_issued as amount, b.amount_po_booked, b.amount_po_issued
				FROM budgets b
				WHERE b.fy = date('Y')";
				break;
			default:
			Log::debug('Role Not Found!');
		}

		// ====================== Budget====================================
		$records = DB::select("SELECT amount - amount_po_booked - amount_po_issued as amount, amount_po_booked, amount_po_issued
		FROM budgets b
		WHERE b.fy = date('Y')");
		//$result = $dept_budgets->toArray();
		//$data = [];
		
		//Log::debug('sql='.$sql);
		$records = DB::select($sql);

		$this->budget_labels[] = "Available";
		$this->budget_labels[] = "PO Booked";
		$this->budget_labels[] = "PO Issued";
		
		foreach($records as $row) {
			$this->budget_data[] = (int) $row->amount;
			$this->budget_data[] = (int) $row->amount_po_booked;
			$this->budget_data[] = (int) $row->amount_po_issued;
		}

		// Generate random colours for the groups
		for ($i = 0; $i <= count($records); $i++) {
			$this->budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		}

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.charts.budget-pie');
	}
}
