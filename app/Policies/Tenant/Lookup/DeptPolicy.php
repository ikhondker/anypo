<?php

namespace App\Policies\Tenant\Lookup;

use App\Models\Tenant\Lookup\Dept;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use Illuminate\Support\Facades\Log;

class DeptPolicy
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
	public function view(User $user, Dept $dept): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return $user->isAdmin();
	} 

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Dept $dept): bool
	{
		return $user->isAdmin();	
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Dept $dept): bool
	{
		return $user->isAdmin();
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Dept $dept): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Dept $dept): bool
	{
		//
	}

	
}
