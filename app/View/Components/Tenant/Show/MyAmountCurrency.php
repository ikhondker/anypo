<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyAmountCurrency extends Component
{
	
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $value, public string $currency, public string $label='')
	{
		// if (is_numeric($value)){
		// } else {
		// 	$this->value = 0;
		// }
		$this->value 	= $value;
		$this->currency = $currency;
		$this->label 	= ($label == '')? 'Amount' : $label;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.show.my-amount-currency');
	}
}
