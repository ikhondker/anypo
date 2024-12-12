<?php

namespace App\Policies\Landlord\Admin;

use App\Models\Landlord\Admin\Service;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

class ServicePolicy
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
		return $user->isAdmin();
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Service $service): bool
	{
		//return (($user->account_id == $service->account_id) && $user->isAdmin()) || $user->isBackend();
		return $user->isBackend();
	}

	// Only back office users can view all tickets
	public function viewAll(User $user): bool
	{
		return $user->isBackend();
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
	public function update(User $user, Service $service): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Service $service): bool
	{
		return (($user->account_id == $service->account_id) && ($user->isAdmin()) || $user->isBackend());
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Service $service): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Service $service): bool
	{
		//
	}

	public function export(User $user): bool
	{
		return ($user->isBackend());
	}
}
