<?php

namespace App\View\Components\Landlord\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyNumber extends Component
{
    //public $label;
    //public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $value,
        public string $label='Amount X:'
    )
    {
        //$this->label = ($label == '')? 'Amount' : $label;
        if (is_numeric($value)){
            $this->value = $value;
        } else {
            $this->value = 0;
        }
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.show.my-number');
    }
}
