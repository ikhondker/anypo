<?php

namespace App\View\Components\Create;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Country extends Component
{
    public $countries;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->countries = \App\Models\Tenant\Lookup\Country::getAll();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.create.country');
    }
}
