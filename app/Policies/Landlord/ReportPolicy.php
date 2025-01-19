<?php

namespace App\Policies\Landlord;

use App\Models\Landlord\Report;
use App\Models\Landlord\Invoice;

use App\Models\User;

use Illuminate\Auth\Access\Response;

use Illuminate\Support\Facades\Log;

class ReportPolicy
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
	public function view(User $user, Report $report): bool
	{
		return $user->isBackend();
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
	public function update(User $user, Report $report): bool
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Report $report): bool
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Report $report): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Report $report): bool
	{
		//
	}
}
