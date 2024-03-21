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
			return ( $user->isAdmin() || $user->isSeeded() );
		}
	}

	// Only back office users can view all accounts
	public function viewAll(User $user): bool
	{
		return $user->isSeeded();
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
			} elseif ($user->isSeeded()) {
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
			// only back-office can see seeded users view
			if ($model->seeded) {
				return $user->isSeeded();
			} else if ($user->isAdmin() && ($user->id === $model->id) ) {
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
			return ( $user->isAdmin() || $user->isSeeded() );
		} else {
			/*
			|-----------------------------------------------------------------------------
			| Tenant																	 + 
			|-----------------------------------------------------------------------------
			*/
			 // Admin role user only
			 return ( $user->isAdmin() || $user->isSeeded() );
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
			} elseif ($user->isSeeded()) {
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
			if ($model->seeded) {
				return $user->isSupport();
			} else {
				// admin can edit all and others can edit only own
				return ( $user->isAdmin() ||$user->isSupport() || ($user->id === $model->id) );
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
			} elseif ($user->isSeeded() && ($user->id <> $model->id) ) {
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
			} elseif ($model->seeded) {
				// only back-office can edit seeded users
				return $user->isSeeded();
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
			} elseif ($user->isSeeded()) {
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
			if ($model->seeded) {
				return $user->isSeeded();
			} else if ($user->isAdmin() && ($user->id === $model->id) ) {
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
			return $user->isSeeded();
		} else {
			/*
			|-----------------------------------------------------------------------------
			| Tenant																	 + 
			|-----------------------------------------------------------------------------
			*/
			return $user->isSeeded();
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
