<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Project;

class ProjectCounts extends Component
{
	public $count_total;
	public $count_open;
	public $count_closed;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->count_total	= Project::count();
		$this->count_open	= Project::where('closed', false )->count();
		$this->count_closed	= Project::where('closed', true )->count();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.project-counts');
	}
}
