<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Receipt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;


class ReceiptPolicy
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
		return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Receipt $receipt): bool
	{
		return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
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
	public function createForPol(User $user): bool
	{
		return ($user->isBuyer() || $user->isSupport());
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Receipt $receipt): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Receipt $receipt): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function cancel(User $user): bool
	{
		return ($user->isBuyer() || $user->isSupport());
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Receipt $receipt): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Receipt $receipt): bool
	{
		//
	}

}
