<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Invoice;
use App\Models\Tenant\InvoiceLine;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\Tenant\AuthStatusEnum;

class InvoiceLinePolicy
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
	public function view(User $user, InvoiceLine $invoiceLine): bool
	{
		return false;
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
	public function update(User $user, InvoiceLine $invoiceLine): bool
	{
		// only draft line can be edited
		$invoice = Invoice::where('id', $invoiceLine->invoice_id)->first();
		if ($invoice->status == AuthStatusEnum::DRAFT->value ) {
			return true;
		} else {
			return ( false ) ;
		}
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, InvoiceLine $invoiceLine): bool
	{
		$invoice = Invoice::where('id', $invoiceLine->invoice_id)->first();
		return ( $user->isAdmin() || $user->isSupport() || ($user->id === $invoice->created_by) ) && ($invoice->status == AuthStatusEnum::DRAFT->value) ;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, InvoiceLine $invoiceLine): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, InvoiceLine $invoiceLine): bool
	{
		//
	}
}
