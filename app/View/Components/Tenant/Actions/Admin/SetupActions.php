<?php

namespace App\View\Components\Tenant\Actions\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Admin\Setup;

class SetupActions extends Component
{
	public $setup;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $setupId)
	{
		$this->setup 	= Setup::where('id', $setupId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.admin.setup-actions');
	}
}
