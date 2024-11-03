<?php

namespace App\View\Components\Landlord\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Landlord\Ticket;
use App\Models\Landlord\Manage\TicketTopic;

class TicketTopics extends Component
{
	public $ticketTopics;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $ticketId)
	{
		$this->ticketTopics = TicketTopic::with('topic')->where('ticket_id', $ticketId)->orderBy('id', 'desc')->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.widgets.ticket-topics');
	}
}
