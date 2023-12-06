<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logo extends Component
{
    public $logo;
    public $size;


    /**
     * Create a new component instance.
     */
    public function __construct($logo, $size="90px")
    {
          $this->logo   = $logo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.show.logo');
    }
}
