<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Dbu;

class DbuDept extends Component
{
	public $id;
	public $dbus;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->id	= $id;
		//$dbus = $dbus->orderBy('id', 'DESC')->paginate(10);
		//$this->dbus = Dbu::where('project_id',$this->id)->get()->all();
		$this->dbus = Dbu::with('dept')->with('deptBudget.budget')->with('project')->where('dept_id',$this->id)->orderBy('id', 'DESC')->paginate(10);

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.dbu-common');
	}
}
