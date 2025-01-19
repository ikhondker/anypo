<?php

namespace App\Policies\Landlord;

use App\Models\Landlord\Akk;
use App\Models\User;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;
use App\Enum\UserRoleEnum;

class AkkPolicy
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

		public function viewAll(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Akk $akk): bool
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
	 * Determine whether the user can create models.
	 */
	public function addon(User $user): bool
	{
		return ($user->isAdmin() || $user->isBackend());
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function advance(User $user): bool
	{
		return ($user->isAdmin() || $user->isBackend());
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Akk $akk): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Akk $akk): bool
	{
		return false;
	}


	/**
	 * Determine whether the user can delete the model.
	 */
	public function reset(User $user, Akk $akk): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Akk $akk): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Akk $akk): bool
	{
		//
	}
}
