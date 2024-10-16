<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Pr;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;
use App\Enum\Tenant\AuthStatusEnum;

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
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Pr $pr): bool
	{
		// owner, manager, hod, admin and system can view PR
		if ($user->isBuyer() || $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport() ) {
			return true;
		} elseif ($user->role->value == UserRoleEnum::USER->value) {
			return ($user->id == $pr->requestor_id);
		} elseif ($user->role->value == UserRoleEnum::HOD->value) {
			return ($user->dept_id == $pr->dept_id);
		} else {
			return ( false ) ;
		}
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function submit(User $user, Pr $pr): bool
	{
		return ($pr->auth_status == AuthStatusEnum::DRAFT->value);
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
		// owner, manager, hod, admin and system can view PR
		if ($pr->auth_status <> AuthStatusEnum::DRAFT->value ) {
			return false;
		} elseif ($user->isBuyer() || $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport() ) {
			return true;
		} elseif ($user->role->value == UserRoleEnum::USER->value) {
			return ($user->id == $pr->requestor_id);
		} elseif ($user->role->value == UserRoleEnum::HOD->value) {
			return ($user->dept_id == $pr->dept_id);
		} else {
			return ( false ) ;
		}

	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Pr $pr): bool
	{
		return ( ($user->id === $pr->requestor_id) ) && ($pr->auth_status == AuthStatusEnum::DRAFT->value) ;
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

	/**
	 * Determine whether the user can delete the model.
	 */
	public function convert(User $user, Pr $pr): bool
	{
		return ( $user->isBuyer() || $user->isSupport()) ;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function cancel(User $user, Pr $pr): bool
	{
		return ( $user->isAdmin() || $user->isSupport() ) && ($pr->auth_status == AuthStatusEnum::APPROVED->value) ;
	}

	/**
	 * Determine whether the user can recalculate models.
	 */
	public function recalculate(User $user): bool
	{
		return $user->isSupport();
	}

	public function export(User $user): bool
	{
		return true;
	}


}
