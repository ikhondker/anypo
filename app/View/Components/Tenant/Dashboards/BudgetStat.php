<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;

use App\Models\Tenant\Budget;

//use Illuminate\Database\Eloquent\ModelNotFoundException; 


//use Carbon\Carbon;


class BudgetStat extends Component
{
	public $id;
	public $budget;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id='0000')
	{
		$this->id = $id;

		if ($this->id == '0000'){
			// Get latest budget
			$this->budget				= Budget::orderBy('id', 'DESC')->firstOrFail();
		} else {
			$this->budget				= Budget::where('id', $id)->firstOrFail();
		}
			
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.budget-stat');
	}
}
