<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Project;

class ProjectActions extends Component
{
	
	public $show;
	public $project;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $id, $show = false)
	{
		$this->id 		= $id;
		$this->show		= $show; 
		$this->project = Project::where('id', $this->id)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.project-actions');
	}
}
