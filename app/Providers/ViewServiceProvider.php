<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\View\View;
//use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use App\Models\Landlord\Manage\Menu;


class ViewServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		/*
		|-----------------------------------------------------------------------------
		| Landlord																	 +
		|-----------------------------------------------------------------------------
		*/

		// view()->composer(['landlord.*','layouts.landlord-app','components.landlord.widget.ticket-comments','components.landlord.widget.ticket-lists'], function ($view) {
		// 	$view->with('_avatar_dir',"landlord\\".config('bo.DIR_AVATAR')."\\");
		// 	$view->with('_logo_dir',"landlord\\".config('bo.DIR_LOGO')."\\");
		// 	//$view->with('_logo_dir',config('bo.DIR_LOGO'));
		// });

		view()->composer(['layouts.landlord.page','layouts.landlord.app',
				'components.landlord.nav-bar'], function ($view) {
			$raw_route_name = \Request::route()->getName();
			$menu			= new Menu;
			//Log::debug("ViewServiceProvider.boot raw_route_name = ".$raw_route_name);
			try {
				$menu = Menu::where('raw_route_name',$raw_route_name)
					->where('enable',true)
					->firstOrFail();
			} catch (ModelNotFoundException $exception) {
				// Log::debug("node_name not Found! raw_route_name =".$raw_route_name);
				$menu->raw_route_name	= $raw_route_name;
				$menu->route_name		= $raw_route_name;
				$menu->node_name		= '';
			}
			//$view->with('_route_name', $menu->route_name)->with('_access', $menu->access);
			$view->with('_node_name', $menu->node_name)->with('_route_name', $menu->route_name);
			//Log::debug('raw_route_name = '.$menu->raw_route_name .' route_name ='.$menu->route_name .'_node_name ='.$menu->node_name);
		});

		Facades\View::composer(['layouts.landlord.page','layouts.landlord.app',
			'landlord.*', /** keep this */
			'components.landlord.widgets.*'],
			\App\View\Composers\Landlord\ConfigComposer::class);
		Facades\View::composer(['layouts.landlord.page','layouts.landlord.app',
			'components.landlord.nav-bar'],
			\App\View\Composers\Landlord\UserComposer::class);

		/*
		|-----------------------------------------------------------------------------
		| Tenant																	 +
		|-----------------------------------------------------------------------------
		*/
		// view()->composer(['tenant.*','layouts.app'], function ($view) {
		// 	$view->with('_avatar_dir',"tenant\\".tenant('id')."\\".config('akk.DIR_AVATAR')."\\");
		// 	$view->with('_logo_dir',"tenant\\".tenant('id')."\\".config('akk.DIR_LOGO')."\\");
		// });

		view()->composer('layouts.tenant.app', function ($view) {
			$raw_route_name = \Request::route()->getName();
			$menu	= new Menu;
			//Log::debug("ViewServiceProvider.boot.tenant raw_route_name = ".$raw_route_name);
			try {
				$menu = Menu::where('raw_route_name',$raw_route_name)
					->where('enable',true)
					->firstOrFail();
			} catch (ModelNotFoundException $exception) {
				// Log::debug("node_name not Found! raw_route_name =".$raw_route_name);
				$menu->raw_route_name	= $raw_route_name;
				$menu->route_name		= $raw_route_name;
				$menu->node_name		= '';
			}
			$view->with('_node_name', $menu->node_name)->with('_route_name', $menu->route_name);
		});

		Facades\View::composer(['layouts.tenant.app','layouts.tenant.auth',
				'tenant.*', /** keep this */
				'components.tenant.create.amount','components.tenant.edit.amount','components.tenant.show.my-amount',
				'components.tenant.edit.price','components.tenant.create.price-fc',
				'components.tenant.dashboards.*','components.tenant.widgets.*','components.tenant.info.*'
				],
				\App\View\Composers\Tenant\SetupComposer::class);
		Facades\View::composer('layouts.tenant.app', \App\View\Composers\Tenant\NotificationComposer::class);
	}
}
