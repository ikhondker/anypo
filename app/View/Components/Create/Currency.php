<?php

namespace App\View\Components\Create;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Currency extends Component
{
    public $currencies;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
         $this->currencies = \App\Models\Currency::getActives();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.create.currency');
    }
}
