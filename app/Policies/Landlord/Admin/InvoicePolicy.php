<?php

namespace App\Policies\Landlord\Admin;

use App\Models\Landlord\Admin\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use Illuminate\Support\Facades\Log;
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
		//
	}

	// Only back office users can view all tickets
	public function viewAll(User $user): bool
	{
		return $user->isSeeded();
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Invoice $invoice): bool
	{
		return (($user->account_id == $invoice->account_id) && $user->isAdmin()) || $user->isSeeded();

	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return ($user->isAdmin()) || $user->isSeeded();

	}

	public function generate(User $user): bool
	{
		return ($user->isAdmin()) || $user->isSeeded();

	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Invoice $invoice): bool
	{
		return $user->isSeeded();
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

	/**
	 * Determine whether the user can view the model.
	 */
	public function pdfInvoice(User $user, Invoice $invoice): bool
	{
		//Log::debug("inside pdfInvoice= ". $invoice->id );
		//Log::info(json_encode($invoice));
		//Log::info(json_encode($user));
		return (($user->account_id == $invoice->account_id) && $user->isAdmin()) || $user->isSeeded();

	}

	public function export(User $user): bool
	{
		return ($user->isAdmin()) || $user->isSeeded();

	}
}
