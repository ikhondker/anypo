<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Pr;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;

class PrPolicy
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
	public function view(User $user, Pr $pr): bool
	{
		// owner, manager, hod, admin and system can view PR
		if ($user->isAdmin() ) {
			return true;
		} elseif ($user->role->value == UserRoleEnum::USER->value) {
			return ($user->id == $pr->requestor_id);
		} elseif ($user->role->value == UserRoleEnum::BUYER->value) {
			return true;
		} elseif ($user->role->value == UserRoleEnum::HOD->value) {
			return ($user->dept_id == $pr->dept_id);
		} elseif ($user->role->value == UserRoleEnum::CXO->value) {
			return true;
		} else {
			return ( false ) ;
		}
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function submit(User $user, Pr $pr): bool
	{
		return ($pr->auth_status->value == AuthStatusEnum::DRAFT->value); 
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
	public function update(User $user, Pr $pr): bool
	{
		return true; 
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Pr $pr): bool
	{
		return ( $user->isAdmin() || ($user->id === $pr->requestor_id) ) && ($pr->auth_status->value == AuthStatusEnum::DRAFT->value) ;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function convert(User $user): bool
	{
		return $user->isBuyer() ;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function cancel(User $user): bool
	{
		return $user->isAdmin() ;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function recalculate(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Pr $pr): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Pr $pr): bool
	{
		//
	}
}
