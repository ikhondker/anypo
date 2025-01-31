<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Po;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;
use App\Enum\Tenant\AuthStatusEnum;
use App\Enum\Tenant\ClosureStatusEnum;
use Illuminate\Support\Facades\Log;
class PoPolicy
{
	/**
	 * Perform pre-authorization checks.
	*/
	// public function before(User $user, string $ability): bool|null
	// {
	// 	if ($user->isSys()) {
	// 		return true;
	// 	}
	// 	return null;
	// }


	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		return ($user->isBuyer() || $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Po $po): bool
	{
		if ($user->isBuyer() || $user->isCxO() || $user->isAdmin() || $user->isSupport() ) {
			return true;
		} elseif ($user->role->value == UserRoleEnum::HOD->value) {
			return ($user->dept_id == $po->dept_id);
		} else {
			return ( false ) ;
		}
	}



	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return $user->isBuyer();
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Po $po): bool
	{
		// only buyer can edit draft and rejected PO
		if ($user->id <> $po->buyer_id) {
			return false;
		} elseif ($po->auth_status == AuthStatusEnum::DRAFT->value ) {
			return true;
		} elseif ($po->auth_status == AuthStatusEnum::REJECTED->value ) {
			return true;
		} else {
			return ( false ) ;
		}
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Po $po): bool
	{
		return ( $user->isBuyer() || $user->isSupport()) && ($po->auth_status == AuthStatusEnum::DRAFT->value) ;

	}


	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Po $po): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Po $po): bool
	{
		//
	}


	/**
	 * Determine whether the user can update the model.
	 */
	public function submit(User $user, Po $po): bool
	{
		//return ($po->auth_status == AuthStatusEnum::DRAFT->value);

		// only buyer can submit own draft and rejected PO
		if ($user->id <> $po->buyer_id) {
			return false;
		} elseif ($po->auth_status == AuthStatusEnum::DRAFT->value ) {
			return true;
		} elseif ($po->auth_status == AuthStatusEnum::REJECTED->value ) {
			return true;
		} else {
			return ( false ) ;
		}
	}

	/**
	 * Determine whether the user can recalculate models.
	 */
	public function recalculate(User $user, Po $po): bool
	{
		// allow recalculate only draft PO
		return ($user->isSupport()) && ($po->auth_status == AuthStatusEnum::DRAFT->value);
	}

	/**
	 * Determine whether the user can recalculate models.
	 */
	public function open(User $user, Po $po): bool
	{
		// allow only approved closed PO to open
		return ($user->isBuyer() || $user->isSupport()) && ($po->auth_status == AuthStatusEnum::APPROVED->value) && ($po->status == ClosureStatusEnum::CLOSED->value) ;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function close(User $user, Po $po): bool
	{
		// allow only approved open PO to close

		return ($user->isBuyer() || $user->isSupport()) && ($po->auth_status == AuthStatusEnum::APPROVED->value) && ($po->status == ClosureStatusEnum::OPEN->value) ;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function reset(User $user, Po $po): bool
	{
		// allow only approved open PO to close
		return ($user->isBuyer() || $user->isSupport()) && ($po->auth_status == AuthStatusEnum::INPROCESS->value) && ($po->status == ClosureStatusEnum::OPEN->value) ;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function cancel(User $user, Po $po): bool
	{
		return ($user->isBuyer() || $user->isSupport()) && ($po->auth_status == AuthStatusEnum::APPROVED->value) ;
	}



	/**
	 * Determine whether the user can create models.
	 */
	public function duplicate(User $user): bool
	{
		return $user->isBuyer();
	}

}
