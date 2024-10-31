<?php

namespace App\View\Components\Tenant\Widgets\Pol;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;


class ListAllLines extends Component
{
	public $po;
	public $pols;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $poId)
	{

		// status is used in CardTableRow component

		//Log::debug('Value of prId=' . $prId);
		$this->po 		= Po::where('id', $poId)->firstOrFail();
		//Log::debug('Value of id=' . $this->pr->id);
		$this->pols 	= Pol::with('po')->where('po_id', $poId)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.pol.list-all-lines');
	}
}
