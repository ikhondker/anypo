<?php

namespace App\View\Components\Tenant\Widgets\Wfl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Workflow\Wfl;
use App\Enum\WflActionEnum;
use Illuminate\Support\Facades\Log;

class GetApproval extends Component
{

	//public $show = false;
	public $wfl;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $wfId)
	{
		if ( $wfId <> ''){
			// $count 	= Wfl::where('wf_id', $wfid)->where('action', WflActionEnum::PENDING->value)->where('performer_id', auth()->user()->id)->count();
			// $this->wfl 	= Wfl::where('wf_id', $wfid)->first();
			$this->wfl = Wfl::where('wf_id', $wfId)->where('action', WflActionEnum::DUE->value)->where('performer_id', auth()->user()->id)->firstOrFail();
			Log::debug("Components.Tenant.Widgets.Wfl.GetApproval showing for approval wfl_id = ".$this->wfl->id);

		}
		// if ( $count <> 0){
		// 	$this->show = true;
		// } else {
		// 	$this->show = false;
		// }
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.wfl.get-approval');
	}
}
