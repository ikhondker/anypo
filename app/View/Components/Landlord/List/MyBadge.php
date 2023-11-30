<?php

namespace App\View\Components\Landlord\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyBadge extends Component
{
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( 
        public string $value,
        public string $badge ="info"
        )
    { }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.list.my-badge');
    }
}
