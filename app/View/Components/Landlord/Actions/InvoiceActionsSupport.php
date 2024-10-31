<?php

namespace App\View\Components\Landlord\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Admin\Invoice;

class InvoiceActionsSupport extends Component
{
	public $invoice;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $invoiceId = '')
	{
		$this->invoice 	= Invoice::where('id', $invoiceId)->get()->firstOrFail();
	}


	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.actions.invoice-actions-support');
	}
}
