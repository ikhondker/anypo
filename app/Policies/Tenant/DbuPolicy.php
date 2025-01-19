<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Dbu;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

class DbuPolicy
{
	/**
	 * Perform pre-authorization checks.
	*/
	public function before(User $user, string $ability): bool|null
	{
		if ($user->isSys()) {
			return true;
		}
		return null;
	}

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		return ( $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Dbu $dbu): bool
	{
			// hod can view own dept budget
			if ( $user->isCxO() || $user->isAdmin() || $user->isSupport() ) {
				return true;
			} elseif ($user->role->value == UserRoleEnum::HOD->value) {
				return ($user->dept_id == $dbu->dept_id);
			} else {
				return ( false ) ;
			}
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
	public function update(User $user, Dbu $dbu): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Dbu $dbu): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Dbu $dbu): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Dbu $dbu): bool
	{
		//
	}

	public function export(User $user): bool
	{
		return ( $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}
}
