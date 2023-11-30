<?php

namespace App\View\Components\Landlord\Icons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DuoCom013 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.icons.duo-com013');
    }
}
