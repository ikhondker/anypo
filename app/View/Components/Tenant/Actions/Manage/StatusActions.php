<?php

namespace App\View\Components\Tenant\Actions\Manage;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Manage\Status;

class StatusActions extends Component
{
	public $status;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $code)
	{
		$this->status = Status::where('code', $code)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.manage.status-actions');
	}
}
