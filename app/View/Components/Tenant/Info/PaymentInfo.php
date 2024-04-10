<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Payment;

class PaymentInfo extends Component
{
	public $id;
	public $payment;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		 $this->payment = Payment::with('invoice.po')->where('id', $id)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.payment-info');
	}
}
