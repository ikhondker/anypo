<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Invoice;

class InvoiceInfo extends Component
{
	public $id;
	public $invoice;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		 $this->invoice = Invoice::with('po')->where('id', $id)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.invoice-info');
	}
}
