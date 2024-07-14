<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Currency;

class CurrencyActions extends Component
{
    public $currency;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public $code)
	{
		$this->code 		= $code;
		$this->currency = Currency::where('currency', $this->code)->get()->firstOrFail();
	}
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.actions.lookup.currency-actions');
    }
}
