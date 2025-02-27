<?php

namespace App\Policies\Tenant\Lookup;

use App\Models\Tenant\Lookup\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;


class ProjectPolicy
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
		//return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Project $project): bool
	{
		//return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
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
	public function update(User $user, Project $project): bool
	{
		return ($user->isBuyer() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Project $project): bool
	{
		return $user->isAdmin();
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Project $project): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Project $project): bool
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
