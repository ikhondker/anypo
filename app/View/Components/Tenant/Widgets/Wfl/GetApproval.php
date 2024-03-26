<?php

namespace App\View\Components\Tenant\Widgets\Wfl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

//use App\Models\Tenant\Workflow\Wf;
use App\Models\Tenant\Workflow\Wfl;
use App\Enum\WflActionEnum;

class GetApproval extends Component
{
	
	public $show = false;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $wfid)
	{
		if ( $wfid <> ''){
			$count 	= Wfl::where('wf_id', $wfid)->where('action', WflActionEnum::PENDING->value)->where('performer_id', auth()->user()->id)->count();
		}
		if ( $count <> 0){
			$this->show = true;
		} else {
			$this->show = false;
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.wfl.get-approval');
	}
}
