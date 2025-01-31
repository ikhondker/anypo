<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Enum\UserRoleEnum;
use App\Models\Tenant\Lookup\Project;
use Illuminate\Support\Facades\Log;

class SpendsByProjectBar extends Component
{
	public 	$projects;

	public $project_labels 	= [];
	public $project_colors 	= [];

	public $budget 			= [];
	public $amount_pr 		= [];
	public $amount_po 		= [];
	public $amount_grs 		= [];
	public $amount_invoice 	= [];
	public $amount_payment 	= [];

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		// color: https://www.heavy.ai/blog/12-color-palettes-for-telling-better-stories-with-your-data
		// 2. Dutch Field final
		// "#dc0ab4" "#0bb4ff", "#50e991", "#e6d800", "#9b19f5","00bfa0"

        $this->projects = Project::with("pm")->where('closed', false);

        // HoD sees only his projects
        if (auth()->user()->role->value == UserRoleEnum::HOD->value){
			$this->projects = $this->projects->where('dept_id', auth()->user()->dept_id);
		}

        $this->projects = $this->projects->orderBy('id', 'DESC')->limit(10)->get();

		foreach ($this->projects as $project){
			//Log::debug('Value of id=' . $project->name . ' -> '.$project->amount);
			$this->project_labels[] 	= $project->code;
			$this->budget[] 			= (int) $project->amount;
			$this->amount_pr[] 			= (int) $project->amount_pr + $project->amount_pr_booked;
			$this->amount_po[] 			= (int) $project->amount_po + $project->amount_po_booked;
			$this->amount_grs[] 		= (int) $project->amount_grs;
			$this->amount_invoice[] 	= (int) $project->amount_invoice;
			$this->amount_payment[] 	= (int) $project->amount_payment;
		}

		// Generate random colors for the groups
		//for ($i = 0; $i <= $this->projects->count(); $i++) {
		//	$this->project_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		//}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.charts.spends-by-project-bar');
	}
}
