<?php

namespace App\Policies\Landlord;

use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Models\Landlord\Attachment;

use App\Enum\UserRoleEnum;
use Illuminate\Support\Facades\Log;

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
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Attachment $attachment): bool
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
	public function update(User $user, Attachment $attachment): bool
	{
		return $user->isBackend();
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

	/**
	 * Determine whether the user can update the model.
	 */
	public function download(User $user, Attachment $attachment): bool
	{
		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:
				return ($user->id == $attachment->owner_id) ;
				break;
			case UserRoleEnum::ADMIN->value:
				return ($user->account_id == $attachment->id);
				break;
			case UserRoleEnum::SUPPORT->value:
				return true;
				break;
			case UserRoleEnum::SUPERVISOR->value:
				return true;
				break;
			case UserRoleEnum::DEVELOPER->value:
				return true;
				break;
			case UserRoleEnum::SYSTEM->value:
				return true;
				break;
			default:
				return false;
				Log::error('landlord.policy.attachment Other roles= '. auth()->user()->role->value);
		}
	}

}
