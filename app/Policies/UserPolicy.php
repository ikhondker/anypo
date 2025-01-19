<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

use App\Enum\UserRoleEnum;

use Illuminate\Support\Facades\Log;

class UserPolicy
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
		if (tenant('id') == ''){
			/*
			|-----------------------------------------------------------------------------
			| Landlord																	 +
			|-----------------------------------------------------------------------------
			*/
			return $user->isAdmin();
		} else {
			/*
			|-----------------------------------------------------------------------------
			| Tenant																	 +
			|-----------------------------------------------------------------------------
			*/
			return ( $user->isAdmin() || $user->isBackend() );
		}
	}

	// Only back office users can view all accounts
	public function viewAll(User $user): bool
	{
		return $user->isBackend();
	}


	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, User $model): bool
	{

		if (tenant('id') == ''){
			/*
			|-----------------------------------------------------------------------------
			| Landlord																	 +
			|-----------------------------------------------------------------------------
			*/
			// owner, account admin and back office users can view ticket
			if ($user->isUser()) {
				return ($user->id == $model->id);
			} elseif ($user->isAdmin() ) {
				return ( $user->account_id == $model->account_id);
			} elseif ($user->isBackend()) {
					return (true);
			} else {
				return ( false );
			}

		} else {
			/*
			|-----------------------------------------------------------------------------
			| Tenant																	 +
			|-----------------------------------------------------------------------------
			*/
			// only back-office can see/edit/ backend users view
			if ($model->backend) {
				return $user->isBackend();
			} else if ($user->isAdmin() & (! $model->backend) ) {
				return ( true );
			} else {
				// allow to change only own password
				return ( $user->id === $model->id );
			}
		}
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{

		if (tenant('id') == ''){
			/*
			|-----------------------------------------------------------------------------
			| Landlord																	 +
			|-----------------------------------------------------------------------------
			*/
			// Admin role user only
			return ( $user->isAdmin() || $user->isBackend() );
		} else {
			/*
			|-----------------------------------------------------------------------------
			| Tenant																	 +
			|-----------------------------------------------------------------------------
			*/
			 // Admin role user only
			 return ( $user->isAdmin() || $user->isBackend() );
		}
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, User $model): bool
	{

		if (tenant('id') == ''){
			/*
			|-----------------------------------------------------------------------------
			| Landlord																	 +
			|-----------------------------------------------------------------------------
			*/
			// owner, account admin and back office users can view ticket
			if ($user->role->value == UserRoleEnum::USER->value) {
				// user is allowed to update only own
				return ($user->id == $model->id);
			} elseif ($user->isAdmin() & ($user->account_id == $model->account_id) ) {
				return ( true );
			} elseif ($user->isBackend()) {
					return ( true);
			} else {
				return ( false );
			}
		} else {
			/*
			|-----------------------------------------------------------------------------
			| Tenant																	 +
			|-----------------------------------------------------------------------------
			*/
			// only back-office can see/edit/ backend users view
			if ($model->backend) {
				return $user->isBackend();
			} else if ($user->isAdmin() & (! $model->backend) ) {
				return ( true );
			} else {
				// allow to change only own password
				return ( $user->id === $model->id );
			}


		}

	}



	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, User $model): bool
	{

		// only back-office can disable seeded users
		if (tenant('id') == ''){
			/*
			|-----------------------------------------------------------------------------
			| Landlord																	 +
			|-----------------------------------------------------------------------------
			*/
			// Admin user for current account users only
			// stop deactivating himself
			if ($user->isAdmin() && ($user->account_id == $model->account_id)) {
				return ( $user->id <> $model->id );
			} elseif ($user->isBackend() && ($user->id <> $model->id) ) {
					return ( true);
			} else {
				return ( false );
			}
		} else {
			/*
			|-----------------------------------------------------------------------------
			| Tenant																	 +
			|-----------------------------------------------------------------------------
			*/

		 	if ($user->id == $model->id) {
				// prevent all self deactivation
				return ( false ) ;
			} elseif ($model->backend) {
				// only back-office can edit backend users
				return $user->isBackend();
			} else {
				return $user->isAdmin();
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
	public function changepass(User $user, User $model) : bool
	{

		if (tenant('id') == ''){
			/*
			|-----------------------------------------------------------------------------
			| Landlord																	 +
			|-----------------------------------------------------------------------------
			*/
			if ($user->role->value == UserRoleEnum::USER->value) {
				// user is allowed to update only own
				return ($user->id == $model->id);
			} elseif ($user->isAdmin() ) {
				return ( $user->account_id == $model->account_id);
			} elseif ($user->isBackend()) {
					return ( true);
			} else {
				return ( false );
			}
		} else {
			/*
			|-----------------------------------------------------------------------------
			| Tenant																	 +
			|-----------------------------------------------------------------------------
			*/
			// only back-office can edit seeded users
			if ($model->backend) {
				return $user->isBackend();
			} else if ($user->isAdmin() & (! $model->backend) ) {
				return ( true );
			} else {
				// allow to change only own password
				return ( $user->id === $model->id );
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


	public function impersonate(User $user): bool
	{
		// only back-office impersonate
		//Log::debug("user->role->value = ". $user->role->value );
		if (tenant('id') == ''){
			/*
			|-----------------------------------------------------------------------------
			| Landlord																	 +
			|-----------------------------------------------------------------------------
			*/
			return $user->isBackend();
		} else {
			/*
			|-----------------------------------------------------------------------------
			| Tenant																	 +
			|-----------------------------------------------------------------------------
			*/
			return $user->isBackend();
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

	public function export(User $user): bool
	{
		return ($user->isAdmin() || $user->isBackend());
	}

}
