<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class HeaderWithSimpleSearch extends Component
{
    //public $object;
    //public $title;
    public $route;
    //public $export;

    /**
     * Create a new component instance.
     */
    public function __construct(public string $object, public string $title = "", public bool $export = false)
    {
        //$this->object = $object;
        $this->title = ($title == '') ? $this->object : $title;
        $this->route = Str::lower(Str::plural(Str::snake($object, '-')));
        //$this->export = $export; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.header-with-simple-search');
    }
}
