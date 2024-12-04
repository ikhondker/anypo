<?php

namespace App\View\Components\Tenant\Wf;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Enum\Tenant\EntityEnum;
use App\Models\Tenant\Workflow\Wfl;


class PrApprovalHistory extends Component
{
	public $wfls;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $prId)
	{
		$this->wfls = Wfl::with('performer.designation')->with('wf')
			->whereHas('wf', function ($q) use ($prId) {
				$q->where('article_id', $prId)->where('entity',EntityEnum::PR->value);
			})
			->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.wf.approval-history');
	}
}
