<?php

namespace App\Policies\Tenant\Support;

use App\Models\Tenant\Support\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

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
		//
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Ticket $ticket): bool
	{
		//
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
	public function update(User $user, Ticket $ticket): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Ticket $ticket): bool
	{
		//
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
