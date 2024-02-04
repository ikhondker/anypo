<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Payment;

class PoPayments extends Component
{

	public $payments;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->payments 	= Payment::where('po_id', $id)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.po-payments');
	}
}
