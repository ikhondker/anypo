<?php

namespace App\View\Components\Tenant\Widgets\Po;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;

class ListByProject extends Component
{
	public $pos;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $id)
	{
		$this->pos 	= Po::with('dept')->with('supplier')->where('project_id', $id)->paginate(10);
	}


	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.po.list-by-common');
	}
}
