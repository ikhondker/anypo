<?php

namespace App\View\Components\Tenant\Wf;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Workflow\Wfl;

class ApprovalHistory extends Component
{
	public $id;
	public $wfls;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->wfls = Wfl::with('performer.designation')->where('wf_id', $id)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.wf.approval-history');
	}
}
