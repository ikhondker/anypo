<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;


class PrlPolicy
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
		return false;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Prl $prl): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Prl $prl): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Prl $prl): bool
	{
		$pr = Pr::where('id', $prl->pr_id)->first();
		return ( $user->isAdmin() || $user->isSupport() || ($user->id === $pr->requestor_id) ) && ($pr->auth_status == AuthStatusEnum::DRAFT->value) ;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Prl $prl): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Prl $prl): bool
	{
		//
	}

	

	public function export(User $user): bool
	{
		return true;
	}

}
