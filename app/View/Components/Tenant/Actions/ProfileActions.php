<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\User;

class ProfileActions extends Component
{
	public $user;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->user 	= User::where('id', auth()->user()->id)->get()->firstOrFail();
	}


	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.profile-actions');
	}
}
