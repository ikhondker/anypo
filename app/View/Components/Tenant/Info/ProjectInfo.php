<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Lookup\Project;

class ProjectInfo extends Component
{
	public $id;
	public $project;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->project = Project::where('id', $id)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.project-info');
	}
}
