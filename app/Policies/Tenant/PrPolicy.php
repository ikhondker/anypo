<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Pr;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;
use App\Enum\Tenant\AuthStatusEnum;
use App\Enum\Tenant\ClosureStatusEnum;

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
        // only requester can submit own draft and rejected PR
        if ($user->id <> $pr->requestor_id) {
			return false;
        } elseif ($pr->auth_status == AuthStatusEnum::DRAFT->value )  {
			return true;
		} elseif ($pr->auth_status == AuthStatusEnum::REJECTED->value ) {
			return true;
		} else {
			return ( false ) ;
		}

        // if ($pr->auth_status == AuthStatusEnum::DRAFT->value ) {
		// 	return ($user->id == $pr->requestor_id);
        // } elseif ($pr->auth_status == AuthStatusEnum::REJECTED->value ) {
		// 	return ($user->id == $pr->requestor_id);
		// } else {
		// 	return ( false ) ;
		// }
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
        // only requester can edit draft and rejected PR
        if ($user->id <> $pr->requestor_id) {
			return false;
        } elseif ($pr->auth_status == AuthStatusEnum::DRAFT->value )  {
			return true;
		} elseif ($pr->auth_status == AuthStatusEnum::REJECTED->value ) {
			return true;
		} else {
			return ( false ) ;
		}

		// owner, manager, hod, admin and system can view PR in draft and rejected status
		// if (($pr->auth_status <> AuthStatusEnum::DRAFT->value ) && ($pr->auth_status <> AuthStatusEnum::REJECTED->value ) ) {
		// 	return false;
        // } elseif ($user->isBuyer() || $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport() ) {
		// 	return true;
		// } elseif ($user->role->value == UserRoleEnum::USER->value) {
		// 	return ($user->id == $pr->requestor_id);
		// } elseif ($user->role->value == UserRoleEnum::HOD->value) {
		// 	return ($user->dept_id == $pr->dept_id);
		// } else {
		// 	return ( false ) ;
		// }

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
	 * Determine whether the user can create models.
	 */
	public function reset(User $user, Pr $pr): bool
	{
		// allow only approved open PO to close
		return ($user->isBuyer() || $user->isSupport()) && ($pr->auth_status == AuthStatusEnum::INPROCESS->value) && ($pr->status == ClosureStatusEnum::OPEN->value) ;
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
