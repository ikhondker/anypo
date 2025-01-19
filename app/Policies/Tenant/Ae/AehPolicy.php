<?php

namespace App\Policies\Tenant\Ae;

use App\Models\Tenant\Ae\Aeh;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AehPolicy
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
		return true;
		//return ( $user->isSuperior());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Aeh $aeh): bool
	{
		return true;
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
	public function update(User $user, Aeh $aeh): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Aeh $aeh): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Aeh $aeh): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Aeh $aeh): bool
	{
		return false;
		//return ( $user->isSupport());
	}

	public function manual(User $user): bool
	{
		return ( $user->isSupport());
	}
}
