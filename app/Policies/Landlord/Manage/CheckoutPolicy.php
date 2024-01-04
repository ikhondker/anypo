<?php

namespace App\Policies\Landlord\Manage;

use App\Models\Landlord\Manage\Checkout;

use App\Models\User;
use Illuminate\Auth\Access\Response;


use App\Enum\UserRoleEnum;

class CheckoutPolicy
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
		//
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
	public function view(User $user, Checkout $checkout): Response
	{
		return $user->isBackOffice()
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
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
	public function update(User $user, Checkout $checkout): Response
	{
		return ($user->isSystem())
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Checkout $checkout): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Checkout $checkout): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Checkout $checkout): bool
	{
		//
	}
}
