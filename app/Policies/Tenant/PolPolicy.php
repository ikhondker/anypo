<?php

namespace App\Policies\Tenant;

use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\Tenant\AuthStatusEnum;

use App\Enum\UserRoleEnum;


class PolPolicy
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
	public function view(User $user, Pol $pol): bool
	{
		return ($user->isBuyer() ||$user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport());
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
	public function update(User $user, Pol $pol): bool
	{
		// only buyer can edit prl where PO is draft and rejected
		$po = Po::where('id', $pol->po_id)->first();
		if ($user->id <> $po->buyer_id) {
			return false;
		} elseif ($po->auth_status == AuthStatusEnum::DRAFT->value )  {
			return true;
		} elseif ($po->auth_status == AuthStatusEnum::REJECTED->value ) {
			return true;
		} else {
			return ( false ) ;
		}

	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Pol $pol): bool
	{
		$po = Po::where('id', $pol->po_id)->first();
		return ( $user->isBuyer() && ($user->id === $po->buyer_id) ) && ($po->auth_status == AuthStatusEnum::DRAFT->value) ;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Pol $pol): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Pol $pol): bool
	{
		//
	}

	public function export(User $user): bool
	{
		return true;
	}

}
