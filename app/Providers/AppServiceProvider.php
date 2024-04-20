<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// IQBAL 26-NOV-23
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


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
		// if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		// 	$this->app['request']->server->set('HTTPS', true);
		// }

		/**
	 	* ==================================================================================
 		* Landlord
 		* ==================================================================================
		*/
		Gate::define('seeded', function(User $user) {
			return $user->isSeeded();
		});

		/**
	 	* ==================================================================================
 		* Tenant
 		* ==================================================================================
		*/
		// Should return TRUE or FALSE IQBAL 
		Gate::define('buyer', function(User $user) {
			return ($user->isBuyer() || $user->isAdmin() || $user->isSupport() || $user->isSystem());
		});

		Gate::define('cxo', function(User $user) {
			return ($user->isCxO() || $user->isAdmin() || $user->isSupport() || $user->isSystem());
		});

		/**
	 	* ==================================================================================
 		* Common
 		* ==================================================================================
		*/
		// Should return TRUE or FALSE IQBAL 
		Gate::define('admin', function(User $user) {
			return ($user->isAdmin() || $user->isSupport() || $user->isSystem());
		});

		Gate::define('support', function(User $user) {
			return ($user->isSupport() || $user->isSystem());
		});

		Gate::define('system', function(User $user) {
			return $user->isSystem();
		});

	}
}
