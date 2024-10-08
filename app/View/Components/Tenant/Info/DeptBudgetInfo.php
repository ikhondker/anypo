<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\DeptBudget;

class DeptBudgetInfo extends Component
{

	public $deptBudget;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $deptBudgetId)
	{
		$this->deptBudget = DeptBudget::with('budget')->with('dept')->where('id', $deptBudgetId)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.dept-budget-info');
	}
}
