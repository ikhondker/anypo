<?php

namespace App\View\Components\Buttons\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class Lists extends Component
{
    public $object;
    public $id;

    public $route;
    public $title;

    /**
     * Create a new component instance.
     */
    public function __construct($object)
    {
         $this->object   = $object;

        $this->route = Str::lower(Str::plural(Str::snake($object, '-')));
        $this->title = $object. ' List';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.header.lists');
    }
}
