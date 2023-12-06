<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Submit extends Component
{
    //public $title;

    /**
     * Create a new component instance.
     */
    public function __construct(public string $title='Save')
    {
        //$this->title       = $title;
        //$this->title = ($title == '') ? 'Save' : $title;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.widgets.submit');
    }
}
