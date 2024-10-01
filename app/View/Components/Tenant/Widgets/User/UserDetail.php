<?php

namespace App\View\Components\Tenant\Widgets\User;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\User;

class UserDetail extends Component
{
	//public $id;
	public $user;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $userId)
	{
		//$this->id	= $id;
		$this->user = User::where('id', $userId)->with("user_country")->get()->first();
	}


	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.user.user-detail');
	}
}
