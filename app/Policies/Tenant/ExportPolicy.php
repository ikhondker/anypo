<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Export;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExportPolicy
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
	public function view(User $user, Export $export): bool
	{
		//
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		//
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Export $export): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Export $export): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Export $export): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Export $export): bool
	{
		//
	}

	public function pr(User $user): bool
	{
		return true;
	}

	public function prl(User $user): bool
	{
		return true;
	}


	public function po(User $user): bool
	{
		return true;
	}


	public function pol(User $user): bool
	{
		return true;
	}

	public function invoice(User $user): bool
	{
		return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

	public function invoiceLine(User $user): bool
	{
		return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}


	public function payment(User $user): bool
	{
		return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

	public function receipt(User $user): bool
	{
		return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

	public function ael(User $user): bool
	{
		return ( $user->isBuyer() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}


	public function budget(User $user): bool
	{
		return ( $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

	public function deptBudget(User $user): bool
	{
		return ( $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

}
