<?php

namespace App\Policies\Tenant\Lookup;

use App\Models\User;
use App\Models\Tenant\Lookup\Warehouse;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;


class WarehousePolicy
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
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Warehouse $warehouse): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Warehouse $warehouse): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Warehouse $warehouse): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Warehouse $warehouse): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Warehouse $warehouse): bool
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
