<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\User;

class UserProfile extends Component
{
	public $id;
	public $user;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->id	= $id;
		//$dbus = $dbus->orderBy('id', 'DESC')->paginate(10);
		//$this->dbus = Dbu::where('project_id',$this->id)->get()->all();
		//$this->user = User::with('dept')->with('deptBudget.budget')->with('project')->where('dept_id',$this->id)->orderBy('id', 'DESC')->paginate(10);
		//$this->user = User::with('dept')->with('deptBudget.budget')->with('project')->where('dept_id',$this->id)->orderBy('id', 'DESC')->paginate(10);
		$this->user = User::where('id', $id)->with("user_country")->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.user-profile');
	}
}
