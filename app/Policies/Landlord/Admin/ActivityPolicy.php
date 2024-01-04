<?php

namespace App\Policies\Landlord\Admin;

use App\Models\Landlord\Admin\Activity;
use App\Models\User;
use Illuminate\Auth\Access\Response;


use App\Enum\UserRoleEnum;

class ActivityPolicy
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


	// Only back office users can view all tickets
	public function viewAll(User $user): Response
	{
		return $user->isBackOffice()
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Activity $activity): Response
	{
		return (
			(($user->account_id == $activity->account_id) && $user->isAdmin()) || $user->isBackOffice()
		)
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		//
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Activity $activity): Response
	{
		return ($user->role->value == UserRoleEnum::SYSTEM->value)
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Activity $activity): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Activity $activity): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Activity $activity): bool
	{
		//
	}
}
