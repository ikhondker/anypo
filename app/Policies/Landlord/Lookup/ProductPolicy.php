<?php

namespace App\Policies\Landlord\Lookup;

use App\Models\Landlord\Lookup\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
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
		//
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Product $product): bool
	{
		return $user->isBackend();
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
	public function update(User $user, Product $product): bool
	{
		return $user->isBackend();
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Product $product): bool
	{
		return $user->isBackend();
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Product $product): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Product $product): bool
	{
		//
	}
}
