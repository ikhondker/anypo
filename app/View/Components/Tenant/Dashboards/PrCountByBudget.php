<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Enum\UserRoleEnum;
use App\Models\Tenant\Budget;

class PrCountByBudget extends Component
{
    //public $id;
	public $budget;
    public $count_approved;
	public $sum_approved;

	public $count_inprocess;
	public $sum_inprocess;

	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $budgetId = '0000'
	)
	{
		if ($budgetId == '0000'){
			// Get latest budget
			$this->budget			= Budget::where('revision',false)->orderBy('id', 'DESC')->firstOrFail();
		} else {
			$this->budget			= Budget::where('revision',false)->where('id', $budgetId)->firstOrFail();
		}

	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.dashboards.pr-count-by-budget');
    }
}
