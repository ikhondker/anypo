<?php

namespace App\View\Components\Tenant\Widgets\InvoiceLine;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Invoice;
use App\Models\Tenant\InvoiceLine;

class ListAllLines extends Component
{
	public $invoice;
	public $invoiceLines;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $invoiceId)
	{
		//Log::debug('Value of prId=' . $prId);
		$this->invoice 		= Invoice::where('id', $invoiceId)->firstOrFail();
		//Log::debug('Value of id=' . $this->pr->id);
		$this->invoiceLines 	= InvoiceLine::with('invoice')->where('invoice_id', $invoiceId)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.invoice-line.list-all-lines');
	}
}
