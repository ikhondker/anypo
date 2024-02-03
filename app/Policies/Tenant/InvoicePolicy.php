<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvoicePolicy
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
		return $user->isBuyer() || $user->isManagement();
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Invoice $invoice): bool
	{
		return $user->isBuyer() || $user->isManagement();
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
	public function update(User $user, Invoice $invoice): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Invoice $invoice): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Invoice $invoice): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Invoice $invoice): bool
	{
		//
	}
}
