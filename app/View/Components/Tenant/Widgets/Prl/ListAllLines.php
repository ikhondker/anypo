<?php

namespace App\View\Components\Tenant\Widgets\Prl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;

use Illuminate\Support\Facades\Log;

class ListAllLines extends Component
{
	public $pr;
	public $prls;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $prId)
	{
		//Log::debug('Value of prId=' . $prId);
		$this->pr 		= Pr::where('id', $prId)->firstOrFail();
		//Log::debug('Value of id=' . $this->pr->id);
		$this->prls 	= Prl::with('pr')->where('pr_id', $prId)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.prl.list-all-lines');
	}
}
