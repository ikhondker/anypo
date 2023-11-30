<?php

namespace App\View\Components\Landlord\Edit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Agent extends Component
{
    public $agents;

    /**
     * Create a new component instance.
     */
    public function __construct(public string $value='')
    {
        $this->agents = \App\Models\User::getAllAgent();;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.edit.agent');
    }
}
