<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyAmountCurrency extends Component
{
    
    public $value;
    public $currency;
    public $label;
    
    /**
     * Create a new component instance.
     */
    public function __construct($value, $currency, $label='')
    {
        $this->label = ($label == '')? 'Amount' : $label;
        if (is_numeric($value)){
            $this->value = $value;
        } else {
            $this->value = 0;
        }
        $this->currency = $currency;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.show.my-amount-currency');
    }
}
