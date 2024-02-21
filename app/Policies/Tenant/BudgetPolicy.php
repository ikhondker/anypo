<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Budget;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

class BudgetPolicy
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
		return $user->isCxO();
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Budget $budget): bool
	{
		return $user->isCxO();
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
	public function update(User $user, Budget $budget): bool
	{
		return ( $user->isManagement() && !$budget->freeze );
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Budget $budget): bool
	{
		return $user->isManagement();
	}

	public function export(User $user): bool
	{
		return $user->isManagement();
	}
	
	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Budget $budget): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Budget $budget): bool
	{
		//
	}
}
