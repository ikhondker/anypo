<?php

namespace App\View\Components\Tenant\Widgets\Po;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Payment;

class InvoicePayments extends Component
{
	public $payments;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $iid)
	{
		$this->payments 	= Payment::with('bank_account')->where('invoice_id', $iid)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.po.invoice-payments');
	}
}
