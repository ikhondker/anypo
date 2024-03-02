<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\InvoiceLines;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvoiceLinesPolicy
{
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
	public function view(User $user, InvoiceLines $invoiceLines): bool
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
	public function update(User $user, InvoiceLines $invoiceLines): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, InvoiceLines $invoiceLines): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, InvoiceLines $invoiceLines): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, InvoiceLines $invoiceLines): bool
	{
		//
	}
}
