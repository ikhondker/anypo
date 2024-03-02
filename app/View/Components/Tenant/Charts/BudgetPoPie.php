<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\Log;

use App\Models\Tenant\Budget;


class BudgetPoPie extends Component
{
    public $budget_labels = [];
	public $budget_data = [];
	public $budget_colors = [];
    public $budget;

    /**
     * Create a new component instance.
     */
    public function __construct(
		public string $bid ='0000'
	)
	{

		Log::debug('components.tenant.charts.BudgetPoPie Value of dept_budget_id=' . $bid);
	
		// if ($bid == '0000'){
		// 	// No dept budge id is specified. Show current user last dept budget
		// 	$this->budget = Budget::where('dept_id', auth()->user()->dept_id )->with('dept')->with('budget')->orderBy('id', 'DESC')->get()->firstOrFail();
		// } else {
		//  	$this->budget	= Budget::with('budget')->with('dept')->orderBy('id', 'DESC')->where('id', $dbid)->firstOrFail();
		// }

        if ($bid == '0000'){
			// Get latest budget
			$this->budget				= Budget::orderBy('id', 'DESC')->firstOrFail();
		} else {
			$this->budget				= Budget::where('id', $bid)->firstOrFail();
		}

		Log::debug('components.tenant.charts.BudgetPoPie Value of dept_id=' . $this->budget->id);

		$this->budget_labels[] = "Available";
		$this->budget_labels[] = "PO Booked";
		$this->budget_labels[] = "PO Issued";

		$this->budget_data[] = (int) $this->budget->amount - $this->budget->amount_po_booked -$this->budget->amount_po_issued;
		$this->budget_data[] = (int) $this->budget->amount_po_booked;
		$this->budget_data[] = (int) $this->budget->amount_po_issued;

		// Generate random colors for the groups
		for ($i = 0; $i <= 3 ; $i++) {
			$this->budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		}

	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.charts.budget-po-pie');
    }
}
