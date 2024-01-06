<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use Illuminate\Database\Eloquent\ModelNotFoundException; 


use Carbon\Carbon;


class BudgetStat extends Component
{

	public $budget_used_pc =0 ;
	public $budget_amount = 0 ;
	public $budget_po_issued  = 0;

	public $pr_sum=0;
	public $pr_count=0;

	public $po_sum=0;
	public $po_count=0;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$fy = Carbon::now()->format('Y');

		switch (auth()->user()->role->value) {
			case UserRoleEnum::HOD->value:
				$this->budget_amount	= DeptBudget::ByDeptFy()->sum('amount');
				$this->budget_po_issued	= DeptBudget::ByDeptFy()->sum('amount_po_issued');
				// Avoid Division by zero
				if ( $this->budget_amount == 0){
					$this->budget_used_pc	= 0;
				} else{ 
					$this->budget_used_pc	= $this->budget_po_issued / $this->budget_amount * 100;
				}

				$this->po_sum= Pr::whereYear('auth_date', '=', $fy)->sum('amount');
				$this->po_count= Pr::whereYear('auth_date', '=', $fy)->count();

				$this->pr_sum= Pr::whereYear('auth_date', '=', $fy)->sum('amount');
				$this->pr_count= Pr::whereYear('auth_date', '=', $fy)->count();

				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$this->budget_amount	= Budget::ByFy()->sum('amount');
				$this->budget_po_issued	= Budget::ByFy()->sum('amount_po_issued');
				// Avoid Division by zero
				if ( $this->budget_amount == 0){
					$this->budget_used_pc	= 0;
				} else{ 
					$this->budget_used_pc	= $this->budget_po_issued / $this->budget_amount * 100;
				}
				
				$this->po_sum= Pr::whereYear('auth_date', '=', $fy)->sum('amount');
				$this->po_count= Pr::whereYear('auth_date', '=', $fy)->count();

				$this->pr_sum= Pr::whereYear('auth_date', '=', $fy)->sum('amount');
				$this->pr_count= Pr::whereYear('auth_date', '=', $fy)->count();
				break;
			default:
			Log::debug('Role Not Found!');
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.budget-stat');
	}
}
