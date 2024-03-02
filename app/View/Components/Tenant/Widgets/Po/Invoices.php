<?php

namespace App\View\Components\Tenant\Widgets\Po;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Invoice;

class Invoices extends Component
{
	public $invoices;
	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->invoices 	= Invoice::with('supplier')->with('status_badge')->with('pay_status_badge')->where('po_id', $id)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.po.invoices');
	}
}
