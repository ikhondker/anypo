<?php

namespace App\Policies\Tenant\Lookup;

use App\Models\Tenant\Lookup\Currency;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;


class CurrencyPolicy
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
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Currency $currency): bool
	{
		return true;
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
	public function update(User $user, Currency $currency): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Currency $currency): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Currency $currency): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Currency $currency): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function export(User $user): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

}
