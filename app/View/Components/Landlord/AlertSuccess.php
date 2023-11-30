<?php

namespace App\View\Components\Landlord;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class AlertSuccess extends Component
{

    /**
     * The alert message.
     *
     * @var string
     */
    public $message;

    /**
     * Create a new component instance.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.alert-success');
    }
}
