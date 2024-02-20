<?php

namespace App\Policies\Tenant\Manage;

//use App\Models\Tenant\Manage\Table;

use App\Models\User;

use Illuminate\Auth\Access\Response;

use Illuminate\Support\Facades\Log;

class TablePolicy
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
	public function view(User $user, Table $table): bool
	{
		return false;
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
	public function update(User $user, Table $table): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Table $table): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Table $table): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Table $table): bool
	{
		//
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function structure(User $user): bool
	{
		return false;
	}
	/**
	 * Determine whether the user can create models.
	 */
	public function controllers(User $user): bool 
	{
		return false;

	}
	/**
	 * Determine whether the user can create models.
	 */
	public function models(User $user): bool
	{
		return false;
	}
	/**
	 * Determine whether the user can create models.
	 */
	public function routes(User $user): bool
	{
		return false;
	}
	/**
	 * Determine whether the user can create models.
	 */
	public function routeCode(User $user): bool
	{
		return false;
	}
	/**
	 * Determine whether the user can create models.
	 */
	public function policies(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function comments(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function check(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function messages(User $user): bool
	{
		return false;
	}
	

}
