<?php

namespace App\Policies\Tenant\Lookup;

use App\Models\Tenant\Lookup\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;


class SupplierPolicy
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
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Supplier $supplier): bool
	{
		return true;
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
	public function update(User $user, Supplier $supplier): bool
	{
		
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Supplier $supplier): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}
	
	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Supplier $supplier): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Supplier $supplier): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function export(User $user): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function spends(User $user): bool
	{
		return ($user->isBuyer() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

}
