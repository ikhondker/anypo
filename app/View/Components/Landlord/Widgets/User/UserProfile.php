<?php

namespace App\View\Components\Landlord\Widgets\User;

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
		$this->user = User::where('id', $id)->with("user_country")->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.widgets.user.user-profile');
	}
}
