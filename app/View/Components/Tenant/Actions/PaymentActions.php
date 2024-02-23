<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Payment;

class PaymentActions extends Component
{
	public $id;
	public $show;
	public $payment;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id, $show = false)
	{
		$this->id		= $id;
		$this->show		= $show; 
		$this->payment  = Payment::where('id', $this->id)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.payment-actions');
	}
}
