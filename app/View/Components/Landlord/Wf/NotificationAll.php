<?php

namespace App\View\Components\Landlord\Wf;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationAll extends Component
{
    public $notifications;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->notifications = auth()->user()->Notifications; 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.wf.notifications');
    }
}
