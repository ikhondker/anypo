<?php

namespace App\View\Components\Tenant\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyDate extends Component
{
    public $value;
    /**
     * Create a new component instance.
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.list.my-date');
    }
}
