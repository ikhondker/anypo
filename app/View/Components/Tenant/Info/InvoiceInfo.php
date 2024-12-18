<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Invoice;

class InvoiceInfo extends Component
{

	public $invoice;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $invoiceId)
	{
		 $this->invoice = Invoice::with('po')->where('id', $invoiceId)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.invoice-info');
	}
}
