<?php

namespace App\View\Components\Landlord\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Ticket;

class TicketActions extends Component
{
    public $ticket;

    /**
     * Create a new component instance.
     */
    public function __construct(public string $ticketId = '')
    {
        $this->ticket 	= Ticket::where('id', $ticketId)->get()->firstOrFail();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.landlord.actions.ticket-actions');
    }
}
