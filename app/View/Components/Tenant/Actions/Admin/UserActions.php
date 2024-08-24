<?php

namespace App\View\Components\Tenant\Actions\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\User;

class UserActions extends Component
{
	public $user;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $userId)
	{
		$this->user 	= User::where('id', $userId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.admin.user-actions');
	}
}
