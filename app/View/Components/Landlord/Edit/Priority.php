<?php

namespace App\View\Components\Landlord\Edit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Priority extends Component
{
    public $priorities;

    /**
     * Create a new component instance.
     */
    public function __construct(public string $value='')
    {
        $this->priorities = \App\Models\Landlord\Admin\Priority::getAll();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.edit.priority');
    }
}
