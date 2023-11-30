<?php

namespace App\View\Components\Landlord;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppAlertError extends Component
{
    public $message;

    /**
     * Create a new component instance.
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.app-alert-error');
    }
}
