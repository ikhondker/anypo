<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Project;
use Illuminate\Support\Facades\Log;

class SpendsByProjectCountBar extends Component
{
	public 	$projects;

	public $project_labels 	= [];
	public $project_colors 	= [];
	
	public $count_pr 		= [];
	public $count_po 		= [];
	public $count_grs 		= [];
	public $count_invoice 	= [];
	public $count_payment 	= [];

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->projects = Project::with("pm")->where('closed', false)->orderBy('id', 'DESC')->limit(10)->get();

		foreach ($this->projects as $project){
			//Log::debug('Value of id=' . $project->name . ' -> '.$project->amount);
			$this->project_labels[] 	= $project->code;
			$this->count_pr[] 			= (int) $project->count_pr + $project->count_pr_booked;
			$this->count_po[] 			= (int) $project->count_po + $project->count_po_booked;
			$this->count_grs[] 			= (int) $project->count_grs;
			$this->count_invoice[] 		= (int) $project->count_invoice;
			$this->count_payment[] 		= (int) $project->count_payment;
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.charts.spends-by-project-count-bar');
	}
}
