<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Payment;

class PaymentActions extends Component
{

	public $payment;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $paymentId)
	{
		$this->payment = Payment::where('id', $paymentId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.payment-actions');
	}
}
