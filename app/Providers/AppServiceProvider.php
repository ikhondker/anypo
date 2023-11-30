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

		// Should return TRUE or FALSE IQBAL 
		Gate::define('access-back-office', function(User $user) {
			return $user->isBackOffice();
		});
    }
}
