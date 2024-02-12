<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Manage\Menu;

class MenuSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Menu::truncate();

		$menus =  [
			[ 'raw_route_name' => 'activities.index','route_name' => 'activities.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'activities.show','route_name' => 'activities.index', 'node_name' => 'admin'],

			[ 'raw_route_name' => 'attachments.index','route_name' => 'attachments.index', 'node_name' => 'admin'],

			[ 'raw_route_name' => 'budgets.index','route_name' => 'budgets.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'budgets.show','route_name' => 'budgets.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'budgets.edit','route_name' => 'budgets.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'budgets.create','route_name' => 'budgets.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'budgets.detach','route_name' => 'budgets.index', 'node_name' => 'budget'],

			[ 'raw_route_name' => 'dept-budgets.index','route_name' => 'dept-budgets.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'dept-budgets.show','route_name' => 'dept-budgets.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'dept-budgets.edit','route_name' => 'dept-budgets.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'dept-budgets.create','route_name' => 'dept-budgets.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'dept-budgets.detach','route_name' => 'dept-budgets.index', 'node_name' => 'budget'],

			[ 'raw_route_name' => 'dbus.index','route_name' => 'dbus.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'dbus.show','route_name' => 'dbus.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'dbus.edit','route_name' => 'dbus.index', 'node_name' => 'budget'],

			[ 'raw_route_name' => 'categories.index','route_name' => 'categories.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'categories.edit','route_name' => 'categories.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'categories.create','route_name' => 'categories.index', 'node_name' => 'items'],

			
			[ 'raw_route_name' => 'currencies.index','route_name' => 'currencies.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'currencies.edit','route_name' => 'currencies.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'currencies.create','route_name' => 'currencies.index', 'node_name' => 'lookups'],

			[ 'raw_route_name' => 'depts.index','route_name' => 'depts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'depts.show','route_name' => 'depts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'depts.edit','route_name' => 'depts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'depts.create','route_name' => 'depts.index', 'node_name' => 'lookups'],
			
			[ 'raw_route_name' => 'designations.index','route_name' => 'designations.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'designations.edit','route_name' => 'designations.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'designations.create','route_name' => 'designations.index', 'node_name' => 'lookups'],


			[ 'raw_route_name' => 'templates.index','route_name' => 'templates.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'templates.show','route_name' => 'templates.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'templates.edit','route_name' => 'templates.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'templates.create','route_name' => 'templates.index', 'node_name' => 'system'],

			[ 'raw_route_name' => 'tables.index','route_name' => 'tables.index', 'node_name' => 'system'],

			[ 'raw_route_name' => 'entities.index','route_name' => 'entities.index', 'node_name' => 'system'],

			[ 'raw_route_name' => 'statuses.index','route_name' => 'statuses.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'statuses.show','route_name' => 'statuses.show', 'node_name' => 'system'],

			[ 'raw_route_name' => 'groups.index','route_name' => 'groups.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'menus.index','route_name' => 'menus.index', 'node_name' => 'system'],
			
			[ 'raw_route_name' => 'prls.index','route_name' => 'prls.index', 'node_name' => 'system'],

			[ 'raw_route_name' => 'countries.index','route_name' => 'countries.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'countries.edit','route_name' => 'countries.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'countries.create','route_name' => 'countries.index', 'node_name' => 'system'],
			
			[ 'raw_route_name' => 'items.index','route_name' => 'items.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'items.show','route_name' => 'items.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'items.edit','route_name' => 'items.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'items.create','route_name' => 'items.index', 'node_name' => 'items'],

			[ 'raw_route_name' => 'oems.index','route_name' => 'oems.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'oems.edit','route_name' => 'oems.index', 'node_name' => 'lookups'],
		   
			[ 'raw_route_name' => 'prs.index','route_name' => 'prs.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'prs.show','route_name' => 'prs.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'prs.edit','route_name' => 'prs.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'prs.create','route_name' => 'prs.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'prs.createline','route_name' => 'prs.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'prs.detach','route_name' => 'prs.index', 'node_name' => 'purchase'],
			
			[ 'raw_route_name' => 'pos.index','route_name' => 'pos.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'pos.show','route_name' => 'pos.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'pos.edit','route_name' => 'pos.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'pos.create','route_name' => 'pos.index', 'node_name' => 'purchase'],

			[ 'raw_route_name' => 'receipts.index','route_name' => 'receipts.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'receipts.show','route_name' => 'receipts.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'receipts.create','route_name' => 'receipts.index', 'node_name' => 'purchase'],

			[ 'raw_route_name' => 'invoices.index','route_name' => 'invoices.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'invoices.show','route_name' => 'invoices.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'invoices.create','route_name' => 'invoices.index', 'node_name' => 'purchase'],
			
			[ 'raw_route_name' => 'payments.index','route_name' => 'payments.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'payments.show','route_name' => 'payments.index', 'node_name' => 'purchase'],
			[ 'raw_route_name' => 'payments.create','route_name' => 'payments.index', 'node_name' => 'purchase'],
			
			[ 'raw_route_name' => 'projects.index','route_name' => 'projects.index', 'node_name' => 'master'],
			[ 'raw_route_name' => 'projects.show','route_name' => 'projects.index', 'node_name' => 'master'],
			[ 'raw_route_name' => 'projects.edit','route_name' => 'projects.index', 'node_name' => 'master'],
			[ 'raw_route_name' => 'projects.create','route_name' => 'projects.index', 'node_name' => 'master'],
			[ 'raw_route_name' => 'projects.detach','route_name' => 'projects.index', 'node_name' => 'master'],

			[ 'raw_route_name' => 'rates.index','route_name' => 'rates.index', 'node_name' => 'lookups'],

			[ 'raw_route_name' => 'setups.index','route_name' => 'setups.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'setups.edit','route_name' => 'setups.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'setups.show','route_name' => 'setups.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'setups.notice','route_name' => 'setups.index', 'node_name' => 'admin'],

			[ 'raw_route_name' => 'hierarchies.index','route_name' => 'hierarchies.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'hierarchies.show','route_name' => 'hierarchies.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'hierarchies.edit','route_name' => 'hierarchies.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'hierarchies.create','route_name' => 'hierarchies.index', 'node_name' => 'admin'],

			[ 'raw_route_name' => 'wfs.index','route_name' => 'wfs.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'wfs.show','route_name' => 'wfs.index', 'node_name' => 'admin'],

			[ 'raw_route_name' => 'suppliers.index','route_name' => 'suppliers.index', 'node_name' => 'master'],
			[ 'raw_route_name' => 'suppliers.show','route_name' => 'suppliers.index', 'node_name' => 'master'],
			[ 'raw_route_name' => 'suppliers.edit','route_name' => 'suppliers.index', 'node_name' => 'master'],
			[ 'raw_route_name' => 'suppliers.create','route_name' => 'suppliers.index', 'node_name' => 'master'],
			
			
			// TODO
			[ 'raw_route_name' => 'uoms.index','route_name' => 'uoms.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'uoms.create','route_name' => 'uoms.index', 'node_name' => 'items'],

			[ 'raw_route_name' => 'upload-items.index','route_name' => 'upload-items.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'upload-items.show','route_name' => 'upload-items.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'upload-items.edit','route_name' => 'upload-items.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'upload-items.create','route_name' => 'upload-items.create', 'node_name' => 'items'],
			[ 'raw_route_name' => 'upload-items.check','route_name' => 'upload-items.index', 'node_name' => 'items'],
			[ 'raw_route_name' => 'upload-items.import','route_name' => 'upload-items.index', 'node_name' => 'items'],

			
			[ 'raw_route_name' => 'users.index','route_name' => 'users.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'users.show','route_name' => 'users.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'users.edit','route_name' => 'users.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'users.create','route_name' => 'users.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'users.password','route_name' => 'users.index', 'node_name' => 'admin'],
			
			[ 'raw_route_name' => 'warehouses.index','route_name' => 'warehouses.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'warehouses.show','route_name' => 'warehouses.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'warehouses.edit','route_name' => 'warehouses.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'warehouses.create','route_name' => 'warehouses.index', 'node_name' => 'lookups'],

			[ 'raw_route_name' => 'bank-accounts.index','route_name' => 'bank-accounts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'bank-accounts.show','route_name' => 'bank-accounts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'bank-accounts.edit','route_name' => 'bank-accounts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'bank-accounts.create','route_name' => 'bank-accounts.index', 'node_name' => 'lookups'],

			

		  ];
		//
		Menu::insert($menus);
	}
}
