<?php

namespace App\Policies\Landlord\Admin;

use App\Models\Landlord\Admin\Payment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use Illuminate\Support\Facades\Log;
class PaymentPolicy
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

	// Only back office users can view all tickets
	public function viewAll(User $user): bool
	{
		return $user->isBackend();
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Payment $payment): bool
	{
		return (($user->account_id == $payment->account_id) && $user->isAdmin()) || $user->isBackend();

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
	public function update(User $user, Payment $payment): bool
	{
		return $user->isBackend();
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Payment $payment): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Payment $payment): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Payment $payment): bool
	{
		//
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function pdfPayment(User $user, Payment $payment): bool
	{
		//Log::debug("inside pdfPayment= ". $payment->id );
		//Log::info(json_encode($payment));
		//Log::info(json_encode($user));

		return (($user->account_id == $payment->account_id) && $user->isAdmin()) || $user->isBackend();

	}

	public function export(User $user): bool
	{
		return ($user->isAdmin()) || $user->isBackend();

	}
}
