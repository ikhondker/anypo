<?php

namespace App\View\Components\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyAvatar extends Component
{
    public $avatar;
    public $size;

    /**
     * Create a new component instance.
     */
    public function __construct($avatar, $size="48px")
    {
        $this->avatar   = $avatar;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list.my-avatar');
    }
}
