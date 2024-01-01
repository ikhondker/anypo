<?php

namespace App\Policies\Landlord\Admin;

use App\Models\Landlord\Admin\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use Illuminate\Support\Facades\Log;
class InvoicePolicy
{
	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		//
	}

	// Only back office users can view all tickets 
	public function viewAll(User $user): Response
	{
		return $user->isBackOffice()
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}
	
	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Invoice $invoice): Response
	{
		return (
			(($user->account_id == $invoice->account_id) && $user->isAdmin()) || $user->isBackOffice()
		)
		? Response::allow()
		: Response::deny(config('bo.MSG_DENY'));
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): Response
	{
		return (
			($user->isAdmin()) || $user->isBackOffice()
		)
		? Response::allow()
		: Response::deny(config('bo.MSG_DENY'));
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Invoice $invoice): Response
	{
		return $user->isBackOffice()
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
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
	public function pdfInvoice(User $user, Invoice $invoice): Response
	{
		Log::debug("inside pdfInvoice= ". $invoice->id );
		Log::info(json_encode($invoice)); 
		//Log::info(json_encode($user)); 

		return (
			(($user->account_id == $invoice->account_id) && $user->isAdmin()) || $user->isBackOffice()
		)
		? Response::allow()
		: Response::deny(config('bo.MSG_DENY'));
	}
}
