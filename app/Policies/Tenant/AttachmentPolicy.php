<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Attachment;

use App\Models\User;
use Illuminate\Auth\Access\Response;


use App\Helpers\Tenant\Access;

class AttachmentPolicy
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
		return ($user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Attachment $attachment): bool
	{
		return ($user->isAdmin() || $user->isSupport());
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
	public function update(User $user, Attachment $attachment): bool
	{
		return Access::isAttachmentEditable($attachment->id);
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Attachment $attachment): bool
	{
		return Access::isAttachmentEditable($attachment->id);
		//return ($user->isAdmin() || $user->isSupport());
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

	/**
	 * Determine whether the user can update the model.
	 */
	public function download(User $user): bool
	{
		// TODOP2 write logic here does not work
		return true;
	}

	public function export(User $user): bool
	{
		return ($user->isAdmin() || $user->isSupport());
	}


}
