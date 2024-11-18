<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Manage\Menu;


class MenuSeeder extends Seeder
{
	// F - Front end
	// B - Back end
	// X - Not Developed
	// S - system only

	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Menu::truncate();
		// workbench/admin/system/support
		$menus =  [


			/**
			* ==================================================================================
			* 0. Shown by Menu Display Order
			* ==================================================================================
			*/

			/**
			* ==================================================================================
			* 0. Excluded
			* ==================================================================================
			*/
			// Dashboards

			/**
			* ==================================================================================
			* 1. Workbench
			* ==================================================================================
			*/
			[ 'raw_route_name' => 'tickets.index',	 	'route_name' => 'tickets.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'tickets.all',		'route_name' => 'tickets.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'tickets.show',	  	'route_name' => 'tickets.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'tickets.update',		'route_name' => 'tickets.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'tickets.edit',	  	'route_name' => 'tickets.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'tickets.create',		'route_name' => 'tickets.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'tickets.assign',	  	'route_name' => 'tickets.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'tickets.topics',	  	'route_name' => 'tickets.index',	'node_name' 	=> ''],

			[ 'raw_route_name' => 'comments.all',		'route_name' => 'comments.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'comments.show',	  	'route_name' => 'comments.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'comments.update',	'route_name' => 'comments.index',	'node_name' 	=> ''],
			[ 'raw_route_name' => 'comments.edit',	  	'route_name' => 'comments.index',	'node_name' 	=> ''],

			[ 'raw_route_name' => 'invoices.index',		'route_name' => 'invoices.index', 	'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'invoices.all',	  	'route_name' => 'invoices.index',	  'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'invoices.show',	 	'route_name' => 'invoices.index',	  'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'invoices.generate',	'route_name' => 'invoices.generate','node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'invoices.update',	'route_name' => 'invoices.index',	  'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'invoices.edit',	 	'route_name' => 'invoices.index',	  'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'invoices.create',	'route_name' => 'invoices.index',	  'node_name' 	=> 'workbench'],

			[ 'raw_route_name' => 'payments.index',		'route_name' => 'payments.index',  'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'payments.all',	  	'route_name' => 'payments.index', 'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'payments.show',	 	'route_name' => 'payments.index', 'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'payments.update',	'route_name'=> 'payments.index', 'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'payments.edit',	 	'route_name'=> 'payments.index', 'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'payments.create',	'route_name'=> 'payments.index', 'node_name' 		=> 'workbench'],

			[ 'raw_route_name' => 'services.index',		'route_name' => 'services.index', 'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'services.all',	  	'route_name' => 'services.index',	  'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'services.show',	 	'route_name' => 'services.index',	  'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'services.update',	'route_name' => 'services.index',	  'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'services.edit',	 	'route_name' => 'services.index',	  'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'services.create',	'route_name' => 'services.index',	  'node_name' 	=> 'workbench'],

			[ 'raw_route_name' => 'accounts.index',		'route_name' => 'accounts.index','node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'accounts.all',	  	'route_name' => 'accounts.index',	'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'accounts.show',		'route_name' => 'accounts.show','node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'accounts.edit',	 	'route_name' => 'accounts.show','node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'accounts.update',	'route_name' => 'accounts.index',	'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'accounts.create',	'route_name' => 'accounts.index',	'node_name' 	=> 'workbench'],

			[ 'raw_route_name' => 'checkouts.index',	'route_name' => 'checkouts.index',	 'node_name' 	=> 'workbench'],
			//[ 'raw_route_name' => 'checkouts.all',	'route_name' => 'checkouts.index',	 'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'checkouts.show',		'route_name' => 'checkouts.index',	 'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'checkouts.update',	'route_name' => 'checkouts.index',	 'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'checkouts.edit',		'route_name' => 'checkouts.index',	 'node_name' 	=> 'workbench'],
			[ 'raw_route_name' => 'checkouts.create',	'route_name' => 'checkouts.index',	 'node_name' 	=> 'workbench'],

			[ 'raw_route_name' => 'users.index',		'route_name' => 'users.index',	'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'users.all',			'route_name' => 'users.index',	'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'users.show',			'route_name' => 'users.index',	 'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'users.edit',			'route_name' => 'users.index',	 'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'users.create',	  	'route_name' => 'users.index',	'node_name' 		=> 'workbench'],
			[ 'raw_route_name' => 'users.password-change','route_name' => 'users.password-change','node_name' => 'workbench'],
			[ 'raw_route_name' => 'users.update',	  	'route_name' => 'users.index',	'node_name' 		=> 'workbench'],

			[ 'raw_route_name' => 'contacts.all',	  	'route_name' => 'contacts.index',	  'node_name' => 'workbench'],
			[ 'raw_route_name' => 'contacts.show',	  	'route_name' => 'contacts.index',	  'node_name' => 'workbench'],
			[ 'raw_route_name' => 'contacts.edit',	  	'route_name' => 'contacts.index',	  'node_name' => 'workbench'],

			[ 'raw_route_name' => 'tenants.index',	 	'route_name' => 'tenants.index',	'node_name' => 'workbench'],
			[ 'raw_route_name' => 'tenants.show',	  	'route_name' => 'tenants.index',	'node_name' => 'workbench'],
			[ 'raw_route_name' => 'tenants.update',		'route_name' => 'tenants.index',	'node_name' => 'workbench'],
			[ 'raw_route_name' => 'tenants.edit',	  	'route_name' => 'tenants.index',	'node_name' => 'workbench'],
			[ 'raw_route_name' => 'tenants.create',		'route_name' => 'tenants.index',	'node_name' => 'workbench'],

			[ 'raw_route_name' => 'domains.index',	 	'route_name' => 'domains.index',	'node_name' => 'workbench'],
			[ 'raw_route_name' => 'domains.show',	  	'route_name' => 'domains.index',	'node_name' => 'workbench'],
			[ 'raw_route_name' => 'domains.update',		'route_name' => 'domains.index',	'node_name' => 'workbench'],
			[ 'raw_route_name' => 'domains.edit',	  	'route_name' => 'domains.index',	'node_name' => 'workbench'],
			[ 'raw_route_name' => 'domains.create',		'route_name' => 'domains.index',	'node_name' => 'workbench'],


			/**
			* ==================================================================================
			* 1. Admin
			* ==================================================================================
			*/


			/**
			* ==================================================================================
			* 1. Profile
			* ==================================================================================
			*/
			[ 'raw_route_name' => 'users.profile',	  	'route_name' => 'users.profile',	'node_name' 		=> 'profile'],
			[ 'raw_route_name' => 'users.profile-edit',	'route_name' => 'users.profile-edit',	'node_name' 	=> 'profile'],
			[ 'raw_route_name' => 'users.profile-password','route_name' => 'users.profile-password','node_name'	=> 'profile'],

			/**
			* ==================================================================================
			* 1. Lookups
			* ==================================================================================
			*/
			[ 'raw_route_name' => 'categories.index',	'route_name' => 'categories.index',	 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'categories.show',	'route_name' => 'categories.index',	 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'categories.update',	'route_name' => 'categories.index',	 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'categories.edit',	'route_name' => 'categories.index',	 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'categories.create',	'route_name' => 'categories.index',	 'node_name' => 'lookups'],

			[ 'raw_route_name' => 'products.index',		'route_name' => 'products.index',	  'node_name' => 'lookups'],
			[ 'raw_route_name' => 'products.show',	 	'route_name' => 'products.index',	  'node_name' => 'lookups'],
			[ 'raw_route_name' => 'products.update',	'route_name' => 'products.index',	  'node_name' => 'lookups'],
			[ 'raw_route_name' => 'products.edit',	 	'route_name' => 'products.index',	  'node_name' => 'lookups'],
			[ 'raw_route_name' => 'products.create',	'route_name' => 'products.index',	  'node_name' => 'lookups'],

			[ 'raw_route_name' => 'topics.index',		'route_name' => 'topics.index',	  'node_name' => 'lookups'],
			[ 'raw_route_name' => 'topics.show',	 	'route_name' => 'topics.index',	  'node_name' => 'lookups'],
			[ 'raw_route_name' => 'topics.update',		'route_name' => 'topics.index',	  'node_name' => 'lookups'],
			[ 'raw_route_name' => 'topics.edit',	 	'route_name' => 'topics.index',	  'node_name' => 'lookups'],
			[ 'raw_route_name' => 'topics.create',		'route_name' => 'topics.index',	  'node_name' => 'lookups'],


			[ 'raw_route_name' => 'countries.index','route_name' 		=> 'countries.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'countries.show','route_name' 		=> 'countries.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'countries.edit','route_name' 		=> 'countries.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'countries.create','route_name' 		=> 'countries.index', 'node_name' 	=> 'lookups'],

			/**
			* ==================================================================================
			* 1. Support
			* ==================================================================================
			*/



			/**
			* ==================================================================================
			* 1. SysAdmin
			* ==================================================================================
			*/

			[ 'raw_route_name' => 'error-logs.index',	'route_name' => 'error-logs.index',	 'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'error-logs.show',	'route_name' => 'error-logs.index',	 'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'error-logs.update',	'route_name' => 'error-logs.index',	 'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'error-logs.edit',	'route_name' => 'error-logs.index',	 'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'error-logs.create',	'route_name' => 'error-logs.index',	 'node_name' => 'sysadmin'],

			[ 'raw_route_name' => 'reply-templates.index',	'route_name' => 'reply-templates.index',	 'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'reply-templates.show',	'route_name' => 'reply-templates.index',	 'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'reply-templates.update',	'route_name' => 'reply-templates.index',	 'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'reply-templates.edit',	'route_name' => 'reply-templates.index',	 'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'reply-templates.create',	'route_name' => 'reply-templates.index',	 'node_name' => 'sysadmin'],

			[ 'raw_route_name' => 'activities.index',	'route_name' => 'activities.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'activities.show',	'route_name' => 'activities.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'activities.update',  'route_name' => 'activities.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'activities.edit',	'route_name' => 'activities.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'activities.create',  'route_name' => 'activities.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'activities.all',		'route_name' => 'activities.index',	'node_name' => 'sysadmin'],

			[ 'raw_route_name' => 'attachments.index',	'route_name' => 'attachments.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'attachments.all',	'route_name' => 'attachments.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'attachments.show',	'route_name' => 'attachments.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'attachments.update', 'route_name' => 'attachments.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'attachments.edit',	'route_name' => 'attachments.index',	'node_name' => 'sysadmin'],
			[ 'raw_route_name' => 'attachments.create', 'route_name' => 'attachments.index',	'node_name' => 'sysadmin'],

			[ 'raw_route_name' => 'mail-lists.index',	'route_name' => 'mail-lists.index',	  'node_name' => 'sysadmin'],

			/**
			* ==================================================================================
			* 1. Systems
			* ==================================================================================
			*/
			[ 'raw_route_name' => 'processes.index',	'route_name' => 'processes.index',	 'node_name' => 'system'],
			[ 'raw_route_name' => 'processes.show',		'route_name' => 'processes.index',	 'node_name' => 'system'],
			[ 'raw_route_name' => 'processes.update',	'route_name' => 'processes.index',	 'node_name' => 'system'],
			[ 'raw_route_name' => 'processes.edit',		'route_name' => 'processes.index',	 'node_name' => 'system'],
			[ 'raw_route_name' => 'processes.create',	'route_name' => 'processes.index',	 'node_name' => 'system'],

			[ 'raw_route_name' => 'entities.index',		'route_name' => 'entities.index',	  'node_name' => 'system'],
			[ 'raw_route_name' => 'entities.show',	 	'route_name' => 'entities.index',	  'node_name' => 'system'],
			[ 'raw_route_name' => 'entities.update',	'route_name' => 'entities.index',	  'node_name' => 'system'],
			[ 'raw_route_name' => 'entities.edit',	 	'route_name' => 'entities.index',	  'node_name' => 'system'],
			[ 'raw_route_name' => 'entities.create',	'route_name' => 'entities.index',	  'node_name' => 'system'],

			[ 'raw_route_name' => 'menus.index',		'route_name' => 'menus.index',	'node_name' => 'system'],
			[ 'raw_route_name' => 'menus.show',			'route_name' => 'menus.index',	'node_name' => 'system'],
			[ 'raw_route_name' => 'menus.update',		'route_name' => 'menus.index',	'node_name' => 'system'],
			[ 'raw_route_name' => 'menus.edit',			'route_name' => 'menus.index',	'node_name' => 'system'],
			[ 'raw_route_name' => 'menus.create',		'route_name' => 'menus.index',	'node_name' => 'system'],

			[ 'raw_route_name' => 'statuses.index',		'route_name' => 'statuses.index',	  'node_name' => 'system'],
			[ 'raw_route_name' => 'statuses.show',	 	'route_name' => 'statuses.index',	  'node_name' => 'system'],
			[ 'raw_route_name' => 'statuses.update',	'route_name' => 'statuses.index',	  'node_name' => 'system'],
			[ 'raw_route_name' => 'statuses.edit',	 	'route_name' => 'statuses.index',	  'node_name' => 'system'],
			[ 'raw_route_name' => 'statuses.create',	'route_name' => 'statuses.index',	  'node_name' => 'system'],

			[ 'raw_route_name' => 'configs.index',	  	'route_name' => 'configs.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'configs.show',		'route_name' => 'configs.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'configs.update',		'route_name' => 'configs.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'configs.edit',		'route_name' => 'configs.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'configs.create',	 	'route_name' => 'configs.index',		'node_name' => 'system'],

			[ 'raw_route_name' => 'tables.models',	 	'route_name' => 'tables.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'tables.policies',	'route_name' => 'tables.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'tables.route-code',  'route_name' => 'tables.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'tables.routes',	 	'route_name' => 'tables.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'tables.structure',	'route_name' => 'tables.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'tables.index',	  	'route_name' => 'tables.index',		'node_name' => 'system'],
			[ 'raw_route_name' => 'tables.show',		'route_name' => 'tables.index',		'node_name' => 'system'],

			[ 'raw_route_name' => 'templates.index',	'route_name' => 'templates.index',	 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'templates.show',		'route_name' => 'templates.index',	 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'templates.update',	'route_name' => 'templates.index',	 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'templates.edit',		'route_name' => 'templates.index',	 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'templates.create',	'route_name' => 'templates.index',	 'node_name' 	=> 'system'],

			[ 'raw_route_name' => 'notifications.index','route_name' => 'notifications.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'notifications.show', 'route_name' => 'notifications.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'notifications.update','route_name'=> 'notifications.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'notifications.edit', 'route_name' => 'notifications.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'notifications.create','route_name'=> 'notifications.index', 'node_name' 	=> 'system'],

			[ 'raw_route_name' => 'cps.index','route_name' 			 => 'cps.index', 'node_name' 			=> 'system'],
			[ 'raw_route_name' => 'cps.changelog','route_name' 		=> 'cps.index', 'node_name' 			=> 'system'],
			[ 'raw_route_name' => 'cps.ui','route_name' 			=> 'cps.index', 'node_name'				=> 'system'],
			[ 'raw_route_name' => 'cps.codegen','route_name' 		=> 'cps.index', 'node_name' 			=> 'system'],

			[ 'raw_route_name' => 'ui',			'route_name' 		=> 'ui',	'node_name' 				=> 'system'],

			/**
			* ==================================================================================
			* 9. Others
			* ==================================================================================
			*/


		];
		Menu::insert($menus);
	}
}
