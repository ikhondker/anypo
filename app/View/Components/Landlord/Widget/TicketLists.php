<?php

namespace App\View\Components\Landlord\Widget;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Ticket;
// Enums
use App\Enum\UserRoleEnum;


class TicketLists extends Component
{

	public $tickets;

	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $title = "List of Tickets",
		public string $type='ALL',
	)

	{

		//$tickets = Ticket::get();
		//dd($tickets);

		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:
				switch ($type) {
					case "LAST5":
						$this->title = "Recent Tickets (Last 5)";
						$this->tickets = Ticket::byUser()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					case "ALL":
						$this->title = "All Tickets";
						//$this->tickets = Ticket::byUser()->orderBy('id', 'DESC')->limit(10)->get();
						$this->tickets=	Ticket::byUser()->orderBy('id', 'DESC')->paginate(10);
						break;
					case "OPEN":
						$this->title = "Open Tickets";
						$this->tickets = Ticket::byUserOpen()->orderBy('id', 'DESC')->get();
						break;
					case "CLOSED":
						$this->title = "Recent Closed Tickets (Last 5)";
						$this->tickets = Ticket::byUserClosed()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					default:
				}
				break;
			case UserRoleEnum::ADMIN->value:
				switch ($type) {
					case "LAST5":
						$this->title = "Recent Tickets (Last 5)";
						$this->tickets = Ticket::byAccount()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					case "ALL":
						$this->title = "All Tickets";
						$this->tickets = Ticket::byAccount()->orderBy('id', 'DESC')->limit(10)->get();
						break;
					case "OPEN":
						$this->title = "Open Tickets";
						//$this->tickets = Ticket::byAccount()->orderBy('id', 'DESC')->get();
						$this->tickets = Ticket::byAccountOpen()->orderBy('id', 'DESC')->get();
						break;
					case "CLOSED":
						$this->title = "Recent Closed Tickets (Last 5)";
						//$this->tickets = Ticket::byAccount()->orderBy('id', 'DESC')->get();
						$this->tickets = Ticket::byAccountClosed()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					default:
				}
				break;
			case UserRoleEnum::SUPPORT->value:
				switch ($type) {
					case "UNASSIGNED":
						$this->title = "Unassigned Tickets (Last 5)";
						$this->tickets = Ticket::ByUnassigned()->orderBy('id', 'DESC')->limit(5)->get();
						break;

					case "MY":
						$this->title = "Assigned to Me";
						$this->tickets = Ticket::byAgentOpen()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					
					case "OPEN":
						$this->title = "Open Tickets (Last 5)";
						$this->tickets = Ticket::byAllOpen()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					
					default:
				}
					break;
			case UserRoleEnum::SUPERVISOR->value:
				switch ($type) {
					case "UNASSIGNED":
						$this->title = "Unassigned Tickets (Last 5)";
						$this->tickets = Ticket::ByUnassigned()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					case "OPEN":
						$this->title = "Open Tickets (Last 5)";
						$this->tickets = Ticket::byAllOpen()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					
					default:
				}
				break;
			case UserRoleEnum::SYSTEM->value:
				switch ($type) {
					case "UNASSIGNED":
						$this->title = "Unassigned Tickets (Last 5)";
						$this->tickets = Ticket::ByUnassigned()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					case "OPEN":
						$this->title = "Open Tickets (Last 5)";
						$this->tickets = Ticket::byAllOpen()->orderBy('id', 'DESC')->limit(5)->get();
						break;
					
					default:
				}
				break;

			default:
				//Log::debug("Inside Ticket Index. Ignore. Other roles!");
				$this->tickets = [];
		}


	  
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.widget.ticket-lists');
	}
}
