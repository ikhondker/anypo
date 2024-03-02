<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Budget;

class BudgetStat extends Component
{
	//public $id;
	public $budget;

	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $bid='0000',
	)
	{
		if ($bid == '0000'){
			// Get latest budget
			$this->budget				= Budget::orderBy('id', 'DESC')->firstOrFail();
		} else {
			$this->budget				= Budget::where('id', $bid)->firstOrFail();
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
