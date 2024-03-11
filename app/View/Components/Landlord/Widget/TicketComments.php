<?php

namespace App\View\Components\Landlord\Widget;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Ticket;
use App\Models\Landlord\Comment;

class TicketComments extends Component
{

	public $ENTITY;
	//public $id;
	//public $highlight_prl_id;
	public $ticket;
	public $comments;

	/**
	 * Create a new component instance. 
	 *
	 * @return void
	 */
	public function __construct(public string $id)
	{
		
		//$this->highlight_prl_id = ($highlight_prl_id == 0) ? 0 : $highlight_prl_id  ;
		$this->id = $id;
		$this->ENTITY = 'COMMENT';
		$this->ticket = Ticket::where('id', $id)->first();
		if (auth()->user()->isBackOffice()) {
			$this->comments = Comment::with('owner')->where('ticket_id', $id)->orderBy('id', 'desc')->get()->all();
		} else {
			// Hide internal comments form user
			$this->comments = Comment::with('owner')->where('ticket_id', $id)->where('is_internal', false)->orderBy('id', 'desc')->get()->all();
		}

		//Log::debug("id=".$id." highlight_prl_id=".$this->highlight_prl_id);

	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.widget.ticket-comments');
	}
}
