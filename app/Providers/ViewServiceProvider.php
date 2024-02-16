<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\View\View;


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

		view()->composer('layouts.landlord-app', function ($view) {
			$raw_route_name = \Request::route()->getName();
			$menu	= new Menu;
			//Log::debug("current_route_name =".$raw_route_name);
			try {
				$menu = Menu::where('raw_route_name',$raw_route_name)
					->where('enable',true)
					->firstOrFail();
			} catch (ModelNotFoundException $exception) {
				// Log::debug("node_name not Found! raw_route_name =".$raw_route_name);
				$menu->raw_route_name	= $raw_route_name;
				$menu->route_name		= $raw_route_name;
				//$menu->node_name		= '';
			}
			$view->with('_route_name', $menu->route_name)->with('_access', $menu->access);
		});

		Facades\View::composer(['layouts.landlord-app','layouts.landlord'], \App\View\Composers\LandlordSetupComposer::class);
		Facades\View::composer(['layouts.landlord-app','layouts.landlord'], \App\View\Composers\LandlordUserComposer::class);

		/*
		|-----------------------------------------------------------------------------
		| Tenant																	 + 
		|-----------------------------------------------------------------------------
		*/
		// view()->composer(['tenant.*','layouts.app'], function ($view) {
		// 	$view->with('_avatar_dir',"tenant\\".tenant('id')."\\".config('akk.DIR_AVATAR')."\\");
		// 	$view->with('_logo_dir',"tenant\\".tenant('id')."\\".config('akk.DIR_LOGO')."\\");	
		// });


		view()->composer('layouts.app', function ($view) {
			$raw_route_name = \Request::route()->getName();
			$menu	= new Menu;
			//Log::debug("current_route_name =".$current_route_name);
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

		Facades\View::composer(['layouts.app','tenant.*',
				'components.tenant.create.amount','components.tenant.edit.amount','components.tenant.show.my-amount',
				'components.tenant.dashboards.*','components.tenant.widgets.*','components.tenant.info.*'
				], 
				\App\View\Composers\TenantSetupComposer::class);
		Facades\View::composer('layouts.app', \App\View\Composers\NotificationComposer::class);
		// view()->composer(['landlord.*','layouts.landlord-app','components.landlord.widget.ticket-comments','components.landlord.widget.ticket-lists'], function ($view) {
	}
}
