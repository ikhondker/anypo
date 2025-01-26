<?php

namespace App\Jobs\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Models
use App\Models\User;
use App\Models\Landlord\Ticket;

// Enums

// Helpers
use App\Helpers\EventLog;
use Illuminate\Support\Facades\Log;
// notification
use Notification;
use App\Notifications\Landlord\TicketCreated;

//Enums
use App\Enum\Landlord\TicketStatusEnum;

// Seeded


class TicketSetupNeeded implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $user_id;

	/**
	 * Create a new job instance.
	 */
	public function __construct($user_id)
	{
		$this->user_id = $user_id;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		// get user
		$user = User::with('account')->where('id', $this->user_id )->first();

		Log::debug('Jobs.Landlord.TicketSetupNeeded user = '.$user->id);

		// Create Ticket row
		$ticket						= new Ticket;
		$ticket->owner_id			= $user->id;
		$ticket->title				= 'Support needed to configure my site';
		$ticket->content			= "Hi
									Please support us to configure our new site for ".$user->account->name.
                                    "
									Thanks
                                    "
									.$user->name.
									"
									NB. This is an auto created Support Ticket.";
		$ticket->ticket_date		= date('Y-m-d H:i:s');
		$ticket->status_code		= TicketStatusEnum::NEW->value;
		$ticket->owner_id			= $user->id;
		$ticket->account_id			= $user->account_id;
		$ticket->dept_id			= config('bo.DEFAULT_DEPT_ID');
		$ticket->priority_id		= config('bo.DEFAULT_PRIORITY_ID');
		$ticket->category_id		= '1002'; // Setup
		$ticket->last_message_at	= date('Y-m-d H:i:s');
		//$ticket->ip				= $request->ip();
		$ticket->save();

		// Write to Log
		EventLog::event('ticket', $ticket->id, 'create');

		// Send notification to Ticket creator
		$owner = User::where('id', $ticket->owner_id)->first();
		$owner->notify(new TicketCreated($owner, $ticket));

		// Send notification to Support Manager
		$mgr = User::where('id', config('bo.SUPPORT_MGR_ID'))->first();
		$mgr->notify(new TicketCreated($mgr, $ticket));

	}
}
