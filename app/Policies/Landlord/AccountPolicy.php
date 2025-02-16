<?php

namespace App\Policies\Landlord;

use App\Models\Landlord\Account;
use App\Models\User;

use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

class AccountPolicy
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

	// Only back office users can view all accounts
	public function viewAll(User $user): bool
	{
		return $user->isBackend();
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Account $account): bool
	{
		return (($user->account_id == $account->id) && $user->isAdmin()) || $user->isBackend();
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
	public function update(User $user, Account $account): bool
	{
		// editable to its admin user only
		return ((($user->account_id == $account->id) && $user->isAdmin()) || $user->isBackend());

	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Account $account): bool
	{
		return false;
	}


	/**
	 * Determine whether the user can delete the model.
	 */
	public function reset(User $user, Account $account): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Account $account): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Account $account): bool
	{
		//
	}
}
