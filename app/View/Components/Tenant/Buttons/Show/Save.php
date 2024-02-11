<?php

namespace App\View\Components\Tenant\Buttons\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Save extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title='Save')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.buttons.show.save');
    }
}
