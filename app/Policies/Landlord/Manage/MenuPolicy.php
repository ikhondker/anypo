<?php

namespace App\Policies\Landlord\Manage;

use App\Models\Landlord\Manage\Menu;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

class MenuPolicy
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
	public function view(User $user, Menu $menu): bool
	{
		return $user->isSeeded();
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return $user->isSeeded();
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Menu $menu): bool
	{
		return $user->isSeeded();
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Menu $menu): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Menu $menu): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Menu $menu): bool
	{
		//
	}

		/**
	 * Determine whether the user can view any models.
	 */
	public function viewWorkbenchMenu(User $user): bool
	{
		return ($user->isAdmin() || $user->isSupport() || $user->isSysAdmin());
	}

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewLookupMenu(User $user): bool
	{
		return ($user->isSupport() || $user->isSysAdmin());
	}

	/**
	 * Determine whether the user can view any models.
	 */
	public function xxviewSupportMenu(User $user): bool
	{
		return ($user->isSupport() || $user->isSysAdmin());
	}

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAdminMenu(User $user): bool
	{
		return ($user->isAdmin() || $user->isSupport() || $user->isSysAdmin());
	}

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewSysAdminMenu(User $user): bool
	{
		return ($user->isSysAdmin());
	}

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewSystemMenu(User $user): bool
	{
		return ($user->isSystem());
	}

}
