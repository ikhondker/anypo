<?php

namespace App\Policies\Tenant\Lookup;

use App\Models\Tenant\Lookup\UploadItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Helpers\CheckAccess;
use App\Enum\UserRoleEnum;


class UploadItemPolicy
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
	public function view(User $user, UploadItem $uploadItem): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): Response
	{
		return ( $user->isAdmin()  )
			? Response::allow()
			: Response::deny(config('akk.MSG_DENY'));
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, UploadItem $uploadItem): Response
	{
		return ( $user->isAdmin()  )
			? Response::allow()
			: Response::deny(config('akk.MSG_DENY'));
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, UploadItem $uploadItem): Response
	{
		return ( $user->isAdmin()  )
			? Response::allow()
			: Response::deny(config('akk.MSG_DENY'));
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, UploadItem $uploadItem): bool
	{
		
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, UploadItem $uploadItem): bool
	{
		//
	}
}
