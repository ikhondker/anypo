<?php

namespace App\View\Components\Tenant\Widgets\Invoice;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Payment;



class Payments extends Component
{
	public $payments;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $invoiceId)
	{
		$this->payments 	= Payment::with('bank_account')->where('invoice_id', $invoiceId)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.invoice.payments');
	}
}
