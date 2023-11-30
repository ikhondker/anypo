<?php

namespace App\View\Components\Icons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Enable extends Component
{

    public $enable;

    /**
     * Create a new component instance.
     */
    public function __construct($enable = true)
    {
        $this->enable       = $enable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icons.enable');
    }
}
