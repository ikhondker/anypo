<?php

namespace App\Policies\Tenant\Ae;

use App\Models\Tenant\Ae\Ael;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AelPolicy
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
		return ( $user->isSuperior());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Ael $ael): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Ael $ael): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Ael $ael): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Ael $ael): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Ael $ael): bool
	{
		return false;
		//return ( $user->isBuyer() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

}
