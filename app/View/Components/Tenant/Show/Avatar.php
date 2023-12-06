<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Avatar extends Component
{
    public $avatar;
    public $size;

    /**
     * Create a new component instance.
     */
    public function __construct($avatar, $size="90px")
    {
        $this->avatar   = $avatar;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.show.avatar');
    }
}
