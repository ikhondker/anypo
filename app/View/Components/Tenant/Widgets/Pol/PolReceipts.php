<?php

namespace App\View\Components\Tenant\Widgets\Pol;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

//use App\Models\Tenant\Po;
use App\Models\Tenant\Receipt;

class PolReceipts extends Component
{
	public $receipts;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->receipts 	= Receipt::where('pol_id', $id)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.pol.pol-receipts');
	}
}
