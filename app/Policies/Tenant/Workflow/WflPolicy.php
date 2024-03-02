<?php

namespace App\Policies\Tenant\Workflow;

use App\Models\User;
use App\Models\Tenant\Workflow\Wfl;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

class WflPolicy
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
	public function view(User $user, Wfl $wfl): bool
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
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Wfl $wfl): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Wfl $wfl): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Wfl $wfl): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Wfl $wfl): bool
	{
		//
	}
}
