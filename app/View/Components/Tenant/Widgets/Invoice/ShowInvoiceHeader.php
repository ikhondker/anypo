<?php

namespace App\View\Components\Tenant\Widgets\Invoice;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Invoice;

class ShowInvoiceHeader extends Component
{
	//public $id;
	public $invoice;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $invoiceId)
	{
		$this->invoice = Invoice::where('id', $invoiceId)->with("po")->with("supplier")->with('status_badge','pay_status_badge')->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.invoice.show-invoice-header');
	}
}
