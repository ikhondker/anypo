<?php

namespace App\View\Components\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyInteger extends Component
{
    public $label;
    public $value;
    /**
     * Create a new component instance.
     */
    public function __construct($value, $label='')
    {
        $this->label = ($label == '')? 'Amount' : $label;
        if (is_numeric($value)){
            $this->value = $value;
        } else {
            $this->value = 0;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show.my-integer');
    }
}
