<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Budget;

class BudgetActions extends Component
{
	public $budget;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $budgetId)
	{
		$this->budget	= Budget::where('id', $budgetId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.budget-actions');
	}
}
