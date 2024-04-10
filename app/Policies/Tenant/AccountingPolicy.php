<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Accounting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AccountingPolicy
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
		return ( $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Accounting $accounting): bool
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
	public function update(User $user, Accounting $accounting): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Accounting $accounting): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Accounting $accounting): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Accounting $accounting): bool
	{
		//
	}

	public function export(User $user): bool
	{
		return ( $user->isBuyer() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

}
