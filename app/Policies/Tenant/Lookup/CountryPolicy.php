<?php

namespace App\Policies\Tenant\Lookup;

use App\Models\Tenant\Lookup\Country;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Helpers\CheckAccess;
use App\Enum\UserRoleEnum;


class CountryPolicy
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

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Country $country): bool
	{
		//
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
	public function update(User $user, Country $country): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Country $country): bool
	{
		return $user->isAdmin();	
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Country $country): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Country $country): bool
	{
		//
	}

	public function export(User $user): bool
	{
		return true;
	}
}
