<?php

namespace App\Policies\Tenant\Lookup;

use App\Models\Tenant\Lookup\BankAccount;
use App\Models\User;

class BankAccountPolicy
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
	public function view(User $user, BankAccount $bankAccount): bool
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
	public function update(User $user, BankAccount $bankAccount): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, BankAccount $bankAccount): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, BankAccount $bankAccount): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, BankAccount $bankAccount): bool
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
