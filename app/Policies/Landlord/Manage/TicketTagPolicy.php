<?php

namespace App\Policies\Landlord\Manage;

use App\Models\Landlord\Manage\TicketTag;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketTagPolicy
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
	public function view(User $user, TicketTag $ticketTag): bool
	{
		//
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		//
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, TicketTag $ticketTag): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, TicketTag $ticketTag): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, TicketTag $ticketTag): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, TicketTag $ticketTag): bool
	{
		//
	}
}
