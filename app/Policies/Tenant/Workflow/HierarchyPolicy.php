<?php

namespace App\Policies\Tenant\Workflow;

use App\Models\Tenant\Workflow\Hierarchy;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

class HierarchyPolicy
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
		return ($user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Hierarchy $hierarchy): bool
	{
		return ($user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return ($user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Hierarchy $hierarchy): bool
	{
		return ($user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Hierarchy $hierarchy): bool
	{
		return ($user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Hierarchy $hierarchy): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Hierarchy $hierarchy): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function export(User $user): bool
	{
		return ($user->isAdmin() || $user->isSupport());
	}
}
