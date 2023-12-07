<?php

namespace App\Policies\Landlord\Manage;

use App\Models\Landlord\Attachment;
use App\Models\User;
use Illuminate\Auth\Access\Response;


use App\Enum\UserRoleEnum;

class AttachmentPolicy
{
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
	public function view(User $user, Attachment $attachment): Response
	{
		return $user->isBackOffice()
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
	public function update(User $user, Attachment $attachment): Response
	{
		return ($user->isSystem())
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Attachment $attachment): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Attachment $attachment): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Attachment $attachment): bool
	{
		//
	}
}
