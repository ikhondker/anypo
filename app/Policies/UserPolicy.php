<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;


#Tenant
use App\Helpers\CheckAccess;

use App\Enum\UserRoleEnum;

use Illuminate\Support\Facades\Log;

class UserPolicy
{
	/**
	 * Perform pre-authorization checks.
	*/
	public function before(User $user, string $ability): bool|null
	{
		if ( $user->role->value == UserRoleEnum::SYSTEM->value ) {
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

	// Only back office users can view all accounts
	public function viewAll(User $user): Response
	{
		return $user->isBackOffice()
			? Response::allow()
			: Response::deny(config('bo.MSG_DENY'));
	}


	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, User $model): Response
	{

		if (tenant('id') == ''){

			// owner, account admin and back office users can view ticket
			if ($user->role->value == UserRoleEnum::USER->value) {
				return ($user->id == $model->id)
					? Response::allow()
					: Response::deny(config('bo.MSG_DENY'));
			} elseif ($user->isAdmin() ) {
				return ( $user->account_id == $model->account_id)
					? Response::allow()
					: Response::deny(config('bo.MSG_DENY'));
			} elseif ($user->isBackOffice()) {
					return ( true)
						? Response::allow()
						: Response::deny(config('bo.MSG_DENY'));
			} else {
				return ( false )
				? Response::allow()
				: Response::deny(config('bo.MSG_DENY'));
			}

		} else {
			//  only back-office can see seeded users view
			if  ($model->seeded) {
				return ( CheckAccess::isBackOffice($user->role->value))
					? Response::allow()
					: Response::deny(config('akk.MSG_DENY'));
			} else {
				return ( true )
					? Response::allow()
					: Response::deny(config('akk.MSG_DENY'));
			}
		}


	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): Response
	{

		if (tenant('id') == ''){
			//  Admin role user only
			return ( $user->isAdmin() || $user->isBackOffice() )
				? Response::allow()
				: Response::deny(config('bo.MSG_DENY'));
		} else {
			 //  Admin role user only
			 return ( CheckAccess::aboveAdmin($user->role->value) )
			 ? Response::allow()
			 : Response::deny(config('akk.MSG_DENY'));

			// return ( CheckAccess::isBackOffice($user->role->value) )
			// 	? Response::allow()
			// 	: Response::deny(config('akk.MSG_DENY'));
		}
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, User $model): Response
	{

		if (tenant('id') == ''){
			// owner, account admin and back office users can view ticket
			if ($user->role->value == UserRoleEnum::USER->value) {
				// user is allowed to update only own
				return ($user->id == $model->id)
					? Response::allow()
					: Response::deny(config('bo.MSG_DENY'));
			} elseif ($user->isAdmin() ) {
				return ( $user->account_id == $model->account_id)
					? Response::allow()
					: Response::deny(config('bo.MSG_DENY'));
			} elseif ($user->isBackOffice()) {
					return ( true)
						? Response::allow()
						: Response::deny(config('bo.MSG_DENY'));
			} else {
				return ( false )
				? Response::allow()
				: Response::deny(config('bo.MSG_DENY'));
			}
		} else {
			//  only back-office can edit seeded users
			if  ($model->seeded) {
				return ( CheckAccess::isBackOffice($user->role->value))
					? Response::allow()
					: Response::deny(config('akk.MSG_DENY'));
			} else {
				// admin can edit own and others
				return ( $user->role->value == UserRoleEnum::ADMIN->value || CheckAccess::isBackOffice($user->role->value) || ($user->id === $model->id) )
				? Response::allow()
				: Response::deny(config('akk.MSG_DENY'));
			}
		}

	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\User  $model
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function changepass(User $user, User $model)
	{

		if (tenant('id') == ''){
			if ($user->role->value == UserRoleEnum::USER->value) {
				// user is allowed to update only own
				return ($user->id == $model->id)
					? Response::allow()
					: Response::deny(config('bo.MSG_DENY'));
			} elseif ($user->isAdmin() ) {
				return ( $user->account_id == $model->account_id)
					? Response::allow()
					: Response::deny(config('bo.MSG_DENY'));
			} elseif ($user->isBackOffice()) {
					return ( true)
						? Response::allow()
						: Response::deny(config('bo.MSG_DENY'));
			} else {
				return ( false )
				? Response::allow()
				: Response::deny(config('bo.MSG_DENY'));
			}
		} else {
			//  only back-office can edit seeded users
			if  ($model->seeded) {
				return ( CheckAccess::isBackOffice($user->role->value))
					? Response::allow()
					: Response::deny(config('akk.MSG_DENY'));
			} else if ($user->role->value == UserRoleEnum::ADMIN->value || CheckAccess::isBackOffice($user->role->value)) {
				return ( true )
					? Response::allow()
					: Response::deny(config('akk.MSG_DENY'));
			} else {
				return ( $user->id === $model->id )
					? Response::allow()
					: Response::deny(config('akk.MSG_DENY'));
			}
		}

	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, User $model): Response
	{
	   //  only back-office can disable seeded users

	   if (tenant('id') == ''){
			//  Admin user for current account users only
			// stop deactivating himself
			if ($user->isAdmin() ) {
				return (($user->account_id == $model->account_id) && ($user->id <> $model->id) )
					? Response::allow()
					: Response::deny(config('bo.MSG_DENY'));
			} elseif ($user->isBackOffice()) {
					return ( true)
						? Response::allow()
						: Response::deny(config('bo.MSG_DENY'));
			} else {
				return ( false )
				? Response::allow()
				: Response::deny(config('bo.MSG_DENY'));
			}
		} else {
			//  only back-office can edit seeded users
			if  ($model->seeded) {
				return ( CheckAccess::isBackOffice($user->role->value))
					? Response::allow()
					: Response::deny(config('akk.MSG_DENY'));
			} else if ($user->id == $model->id) {
				// prevent all self deactivation
				return ( false )
					? Response::allow()
					: Response::deny(config('akk.MSG_DENY'));
			} else {
				return ( $user->role->value == UserRoleEnum::ADMIN->value || CheckAccess::isBackOffice($user->role->value) )
					? Response::allow()
					: Response::deny(config('akk.MSG_DENY'));
			}
		}


	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, User $model): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, User $model): bool
	{
		//
	}


	public function impersonate(User $user): Response
	{
		// only back-office impersonate
		//Log::debug("user->role->value = ". $user->role->value );

		if (tenant('id') == ''){
			return ( $user->isBackOffice() )
				? Response::allow()
				: Response::deny(config('bo.MSG_DENY'));
		} else {
			return ( CheckAccess::isBackOffice($user->role->value) )
				? Response::allow()
				: Response::deny(config('akk.MSG_DENY'));
		}

	}


	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\User  $model
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function updaterole(User $user, User $model): bool
	{
		// Only system
		return false;
	}


}
