<?php

namespace App\Policies\Landlord;

use App\Models\Landlord\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;


use App\Enum\UserRoleEnum;

use App\Enum\LandlordTicketStatusEnum;

class TicketPolicy
{
	/**
	 * Perform pre-authorization checks.
	 */
	public function before(User $user, string $ability): bool|null
	{
		if ($user->isSystem()) {
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
	public function viewAll(User $user): Response
	{
		return $user->isBackOffice()
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Ticket $ticket): Response
	{

		// owner, account admin and back office users can view ticket 
		if ($user->role->value == UserRoleEnum::USER->value) {
			return ($user->id == $ticket->owner_id)
				? Response::allow()
				: Response::deny(config('bo.MSG_DENY'));
		} elseif ($user->isAdmin() ) {
			return ( $user->account_id == $ticket->account_id)
				? Response::allow()
				: Response::deny(config('bo.MSG_DENY'));
		} elseif ($user->isBackOffice()) {
				return ( true)
					? Response::allow()
					: Response::deny(config('bo.MSG_DENY'));
		} else {
			return ( false ) 
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
		}
		
	
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Ticket $ticket): Response
	{
		// only back office user can edit non closed ticket 
		return $user->isBackOffice() && ($ticket->status <> LandlordTicketStatusEnum::CLOSED->value)
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}


	/**
	 * Determine whether the user can update the model.
	 */
	public function assign(User $user, Ticket $ticket): Response
	{
		// only back office user can edit non closed ticket 
		return $user->isBackOffice() && ($ticket->status <> LandlordTicketStatusEnum::CLOSED->value)
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Ticket $ticket): bool
	{
		// only system can delete a ticket 
		return ($user->role->value == UserRoleEnum::SYSTEM->value)
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
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
