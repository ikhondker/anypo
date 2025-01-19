<?php

namespace App\Policies\Landlord;

use App\Models\Landlord\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

use App\Enum\Landlord\TicketStatusEnum;
use Illuminate\Support\Facades\Log;

class TicketPolicy
{
	/**
	 * Perform pre-authorization checks.
	 */
	public function before(User $user, string $ability): bool|null
	{
		if ($user->isSys()) {
			return true;
		}
		return null;
	}


	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{

	}

	// Only back office users can view all tickets
	public function viewAll(User $user): bool
	{
		return $user->isBackend();
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Ticket $ticket): bool
	{

		// owner, account admin and back office users can view ticket
		if ($user->isUser() ) {
			return ($user->id == $ticket->owner_id);
		} elseif ($user->isAdmin() ) {
			return ($user->account_id == $ticket->account_id);
		} elseif ($user->isBackend()) {
			return (true);
		} else {
			return (false);
		}
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function pdfTicket(User $user, Ticket $ticket): bool
	{
		// owner, account admin and back office users can view ticket
		if ($user->isUser() ) {
			return ($user->id == $ticket->owner_id);
		} elseif ($user->isAdmin() ) {
			return ($user->account_id == $ticket->account_id);
		} elseif ($user->isBackend()) {
			return (true);
		} else {
			return (false);
		}

	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		// anyone can create a ticket
		return true;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Ticket $ticket): bool
	{
		// only back office user can edit non closed ticket
		return ($user->isBackend() && ($ticket->status_code <> TicketStatusEnum::CLOSED->value));
		//return ($user->isBackend() && ! $ticket->isClosed());
		// anyone can close a ticket
		//return (! $ticket->isClosed());
	}

	public function close(User $user, Ticket $ticket): bool
	{
		// anyone can close a ticket if open
		return (! $ticket->isClosed());
	}

	public function open(User $user, Ticket $ticket): bool
	{
		// only system can open a ticket
		return false;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function assign(User $user, Ticket $ticket): bool
	{
		// only back office user can assign non closed ticket
		//return ($user->isBackend() && ($ticket->status_code <> TicketStatusEnum::CLOSED->value));
		return ($user->isBackend() && ! $ticket->isClosed());
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function addTopic(User $user, Ticket $ticket): bool
	{
		// only back office user can add topics to ticket
		return ($user->isBackend());
	}

	public function export(User $user): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Ticket $ticket): bool
	{
		// only system can delete a ticket
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Ticket $ticket): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Ticket $ticket): bool
	{
		//
	}
}
