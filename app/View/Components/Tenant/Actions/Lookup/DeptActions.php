<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Dept;

class DeptActions extends Component
{
	public $dept;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $deptId)
	{
		// if ( $id == 0 ){
		// 	$this->id		= 0;
		// 	$this->dept 	= New Dept();
		// } else {
			$this->dept 	= Dept::where('id', $deptId)->get()->firstOrFail();
		//}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.dept-actions');
	}
}
