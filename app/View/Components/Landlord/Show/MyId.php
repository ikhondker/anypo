<?php

namespace App\View\Components\Landlord\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyId extends Component
{
    //public $id;
    //public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $id,
        public string $label='ID'

    )
    {
          //$this->id = $id;
         // $this->label = ($label == '')? 'ID' : $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.show.my-id');
    }
}
