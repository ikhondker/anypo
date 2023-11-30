<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Submit extends Component
{
    public $title;

    /**
     * Create a new component instance.
     */
    public function __construct($title = 'Save')
    {
         $this->title       = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.submit');
    }
}
