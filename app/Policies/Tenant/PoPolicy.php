<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Po;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;

class PoPolicy
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
		return ($user->isBuyer() || $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport() );
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
	 * Determine whether the user can update the model.
	 */
	public function submit(User $user, Po $po): bool
	{
		return ($po->auth_status == AuthStatusEnum::DRAFT->value); 
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
		return ($user->isBuyer() || $user->isSupport()) ;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Po $po): bool
	{
		return ( $user->isBuyer() || $user->isSupport()) ;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function cancel(User $user): bool
	{
		return ($user->isBuyer() || $user->isSupport()) ;
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
	 * Determine whether the user can recalculate models.
	 */
	public function recalculate(User $user): bool
	{
		return $user->isSupport();
	}

	/**
	 * Determine whether the user can recalculate models.
	 */
	public function open(User $user): bool
	{
		return $user->isSupport();
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function close(User $user): bool
	{
		return $user->isBuyer();
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function copy(User $user): bool
	{
		return $user->isBuyer();
	}

	public function export(User $user): bool
	{
		return true;
	}

}
