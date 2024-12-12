<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// IQBAL 26-NOV-23
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

use App\Enum\UserRoleEnum;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;


class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		// IQBAL 28-AUG-23
		Paginator::useBootstrapFive();

		// Fix https
		// if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		// 	$this->app['request']->server->set('HTTPS', true);
		// }

		/**
	 	* ==================================================================================
 		* Landlord
 		* ==================================================================================
		*/
		Gate::define('backend', function(User $user) {
			return $user->isBackend();
		});

		/**
	 	* ==================================================================================
 		* Tenant
 		* ==================================================================================
		*/
		// Should return TRUE or FALSE IQBAL
		Gate::define('superior', function(User $user) {
			return ($user->isBuyer() || $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport() || $user->isSysAdmin() || $user->isSystem());
		});

		Gate::define('buyer', function(User $user) {
			return ($user->isBuyer() || $user->isAdmin() || $user->isSupport() || $user->isSysAdmin() || $user->isSystem());
		});

		Gate::define('hod', function(User $user) {
			return ($user->isHoD() || $user->isAdmin() || $user->isSupport() || $user->isSysAdmin() || $user->isSystem());
		});

		Gate::define('cxo', function(User $user) {
			return ($user->isCxO() || $user->isAdmin() || $user->isSupport() || $user->isSysAdmin() || $user->isSystem());
		});

		Gate::define('buyer-or-cxo', function(User $user) {
			return (($user->isBuyer() || $user->isCxO() ) || $user->isAdmin() || $user->isSupport() || $user->isSysAdmin() || $user->isSystem());
		});

		Gate::define('hod-or-cxo', function(User $user) {
			return (($user->isHoD() || $user->isCxO() ) || $user->isAdmin() || $user->isSupport() || $user->isSysAdmin() || $user->isSystem());
		});

		/**
	 	* ==================================================================================
 		* Common
 		* ==================================================================================
		*/
		// Should return TRUE or FALSE IQBAL
		Gate::define('admin', function(User $user) {
			return ($user->isAdmin() || $user->isSupport() || $user->isSysAdmin() || $user->isSystem());
		});

		Gate::define('support', function(User $user) {
			return ($user->isSupport() || $user->isSysAdmin() || $user->isSystem());
		});

		Gate::define('system', function(User $user) {
			return $user->isSystem();
		});

		Gate::define('pr-pdf', function(User $user, Pr $pr) {
			// owner, manager, hod, admin and system can view PR
			if ($user->isBuyer() || $user->isHoD() || $user->isCxO() || $user->isAdmin() || $user->isSupport() ) {
				return true;
			} elseif ($user->role->value == UserRoleEnum::USER->value) {
				return ($user->id == $pr->requestor_id);
			} elseif ($user->role->value == UserRoleEnum::HOD->value) {
				return ($user->dept_id == $pr->dept_id);
			} else {
				return ( false ) ;
			}
		});

		Gate::define('po-pdf', function(User $user, Po $po) {
			if ($user->isBuyer() || $user->isCxO() || $user->isAdmin() || $user->isSupport() ) {
				return true;
			} elseif ($user->role->value == UserRoleEnum::HOD->value) {
				return ($user->dept_id == $po->dept_id);
			} else {
				return ( false ) ;
			}
		});


	}
}
