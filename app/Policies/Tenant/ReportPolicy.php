<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;
use App\Models\Tenant\Pr;
use Illuminate\Support\Facades\Log;

class ReportPolicy
{
	/**
	 * Perform pre-authorization checks.
	*/
	// public function before(User $user, string $ability): bool|null
	// {
	// 	if ($user->isSys()) {
	// 		return true;
	// 	}
	// 	return null;
	// }


	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Report $report): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function run(User $user): bool
	{
		return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
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
	public function update(User $user, Report $report): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Report $report): bool
	{
		return false;
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
