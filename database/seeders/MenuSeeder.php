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

		$menus = [

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
			// 1. Notification

			/**
			* ==================================================================================
			* 1. Workbench
			* ==================================================================================
			*/

			[ 'raw_route_name' => 'prs.index','route_name'				=> 'prs.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'prs.my-prs','route_name' 			=> 'prs.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'prs.show','route_name'				=> 'prs.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'prs.history','route_name'			=> 'prs.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'prs.extra','route_name'				=> 'prs.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'prs.edit','route_name'				=> 'prs.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'prs.create','route_name' 			=> 'prs.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'prs.attachments','route_name'		=> 'prs.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'prs.timestamp','route_name'				=> 'prs.index', 'node_name' => 'workbench'],

			[ 'raw_route_name' => 'prls.edit','route_name'				=> 'prs.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'prls.add-line','route_name'			=> 'prs.index', 'node_name' => 'workbench'],


			[ 'raw_route_name' => 'pos.index','route_name'				=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pos.my-pos','route_name' 			=> 'pos.index', 'node_name' => 'workbench'],

			[ 'raw_route_name' => 'pos.show','route_name'				=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pos.edit','route_name'				=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pos.create','route_name' 			=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pos.history','route_name'			=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pos.extra','route_name'				=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pos.invoice','route_name'			=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pos.attachments','route_name'		=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pos.timestamp','route_name'			=> 'pos.index', 'node_name' => 'workbench'],


			[ 'raw_route_name' => 'pols.show','route_name'				=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pols.edit','route_name'				=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pols.receipt','route_name'			=> 'pos.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'pols.add-line','route_name'			=> 'pos.index', 'node_name' => 'workbench'],


			[ 'raw_route_name' => 'receipts.index','route_name' 		=> 'receipts.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'receipts.my-receipts','route_name'	=> 'receipts.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'receipts.show','route_name'			=> 'receipts.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'receipts.create-for-pol','route_name'=> 'receipts.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'receipts.ael','route_name'			=> 'receipts.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'receipts.timestamp','route_name' 	=> 'receipts.index', 'node_name' => 'workbench'],


			[ 'raw_route_name' => 'invoices.index','route_name' 		=> 'invoices.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'invoices.my-invoices','route_name'	=> 'invoices.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'invoices.show','route_name'			=> 'invoices.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'invoices.edit','route_name'			=> 'invoices.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'invoices.create-for-po','route_name' => 'invoices.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'invoices.ael','route_name'			=> 'invoices.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'invoices.payments','route_name'		=> 'invoices.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'invoices.attachments','route_name'	=> 'invoices.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'invoices.timestamp','route_name'		=> 'invoices.index', 'node_name' => 'workbench'],

			[ 'raw_route_name' => 'invoice-lines.add-line','route_name'	=> 'invoices.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'invoice-lines.edit','route_name'		=> 'invoices.index', 'node_name' => 'workbench'],


			[ 'raw_route_name' => 'payments.index','route_name'			=> 'payments.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'payments.my-payments','route_name'	=> 'payments.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'payments.show','route_name'			=> 'payments.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'payments.create-for-invoice','route_name'	=> 'payments.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'payments.ael','route_name'			=> 'payments.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'payments.timestamp','route_name'		=> 'payments.index', 'node_name' => 'workbench'],

			[ 'raw_route_name' => 'aels.index','route_name'				=> 'aels.index', 'node_name' => 'workbench'],
			[ 'raw_route_name' => 'aels.show','route_name'				=> 'aels.index', 'node_name' => 'workbench'],


			/**
			* ==================================================================================
			* 2. Budget
			* ==================================================================================
			*/
			[ 'raw_route_name' => 'budgets.index','route_name' 			=> 'budgets.index', 'node_name' 		=> 'budget'],
			[ 'raw_route_name' => 'budgets.show','route_name' 			=> 'budgets.index', 'node_name' 		=> 'budget'],
			[ 'raw_route_name' => 'budgets.edit','route_name' 			=> 'budgets.index', 'node_name' 		=> 'budget'],
			[ 'raw_route_name' => 'budgets.create','route_name' 		=> 'budgets.index', 'node_name' 		=> 'budget'],
			[ 'raw_route_name' => 'budgets.attachments','route_name'	=> 'budgets.index', 'node_name' 		=> 'budget'],
			[ 'raw_route_name' => 'budgets.revisions','route_name'		=> 'budgets.index', 'node_name' 		=> 'budget'],
			[ 'raw_route_name' => 'budgets.revisions-all','route_name'	=> 'budgets.revisions-all', 'node_name'	=> 'budget'],
			[ 'raw_route_name' => 'budgets.timestamp','route_name' 		=> 'budgets.index', 'node_name' 		=> 'budget'],

			[ 'raw_route_name' => 'dept-budgets.index','route_name' 	=> 'dept-budgets.index', 'node_name' 	=> 'budget'],
			[ 'raw_route_name' => 'dept-budgets.show','route_name' 		=> 'dept-budgets.index', 'node_name' 	=> 'budget'],
			[ 'raw_route_name' => 'dept-budgets.edit','route_name' 		=> 'dept-budgets.index', 'node_name' 	=> 'budget'],
			[ 'raw_route_name' => 'dept-budgets.create','route_name' 	=> 'dept-budgets.index', 'node_name' 	=> 'budget'],
			[ 'raw_route_name' => 'dept-budgets.attachments','route_name' => 'dept-budgets.index', 'node_name' => 'budget'],
			[ 'raw_route_name' => 'dept-budgets.budget','route_name'	=> 'dept-budgets.index', 'node_name' 	=> 'budget'],
			[ 'raw_route_name' => 'dept-budgets.revisions','route_name'	=> 'dept-budgets.index', 'node_name' 	=> 'budget'],
			[ 'raw_route_name' => 'dept-budgets.revisions-all','route_name'	=> 'dept-budgets.revisions-all', 'node_name' 	=> 'budget'],
			[ 'raw_route_name' => 'dept-budgets.revision-detail','route_name'	=> 'dept-budgets.revisions-all', 'node_name' 	=> 'budget'],
			[ 'raw_route_name' => 'dept-budgets.timestamp','route_name' => 'dept-budgets.index', 'node_name' 	=> 'budget'],

			[ 'raw_route_name' => 'suppliers.spends','route_name' 		=> 'suppliers.spends', 'node_name' 		=> 'budget'],
			[ 'raw_route_name' => 'suppliers.po','route_name' 			=> 'suppliers.spends', 'node_name' 		=> 'budget'],

			[ 'raw_route_name' => 'projects.spends','route_name' 		=> 'projects.spends', 'node_name' 		=> 'budget'],

			[ 'raw_route_name' => 'dbus.index','route_name' 			=> 'dbus.index', 'node_name' 			=> 'budget'],
			[ 'raw_route_name' => 'dbus.show','route_name' 				=> 'dbus.index', 'node_name' 			=> 'budget'],
			[ 'raw_route_name' => 'dbus.edit','route_name' 				=> 'dbus.index', 'node_name' 			=> 'budget'],

			/**
			* ==================================================================================
			* 3. Reports
			* ==================================================================================
			*/
			[ 'raw_route_name' => 'reports.index','route_name' 			=> 'reports.index', 'node_name' 		=> ''],
			[ 'raw_route_name' => 'reports.parameter','route_name' 		=> 'reports.index', 'node_name' 		=> ''],

			/**
			* ==================================================================================
			* 4. Master Data
			* ==================================================================================
			*/

			[ 'raw_route_name' => 'items.index','route_name' 			=> 'items.index', 'node_name' 			=> 'master'],
			[ 'raw_route_name' => 'items.show','route_name' 			=> 'items.index', 'node_name' 			=> 'master'],
			[ 'raw_route_name' => 'items.edit','route_name' 			=> 'items.index', 'node_name' 			=> 'master'],
			[ 'raw_route_name' => 'items.create','route_name' 			=> 'items.index', 'node_name' 			=> 'master'],
			[ 'raw_route_name' => 'items.timestamp','route_name' 		=> 'items.index', 'node_name' 			=> 'master'],

			[ 'raw_route_name' => 'suppliers.index','route_name' 		=> 'suppliers.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'suppliers.show','route_name' 		=> 'suppliers.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'suppliers.edit','route_name' 		=> 'suppliers.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'suppliers.create','route_name' 		=> 'suppliers.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'suppliers.timestamp','route_name' 	=> 'suppliers.index', 'node_name' 		=> 'master'],

			[ 'raw_route_name' => 'projects.index','route_name' 		=> 'projects.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'projects.show','route_name' 			=> 'projects.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'projects.edit','route_name' 			=> 'projects.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'projects.create','route_name' 		=> 'projects.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'projects.attachments','route_name' 	=> 'projects.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'projects.timestamp','route_name' 	=> 'projects.index', 'node_name' 		=> 'master'],

			[ 'raw_route_name' => 'projects.budget','route_name' 		=> 'projects.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'projects.po','route_name' 			=> 'projects.index', 'node_name' 		=> 'master'],
			[ 'raw_route_name' => 'projects.pbu','route_name' 			=> 'projects.index', 'node_name' 		=> 'master'],


			/**
			* ==================================================================================
			* 5. Lookup
			* ==================================================================================
			*/

			[ 'raw_route_name' => 'depts.index','route_name' 			=> 'depts.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'depts.show','route_name' 			=> 'depts.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'depts.edit','route_name' 			=> 'depts.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'depts.create','route_name' 			=> 'depts.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'depts.timestamp','route_name' 		=> 'depts.index', 'node_name' 		=> 'lookups'],

			[ 'raw_route_name' => 'categories.index','route_name' 		=> 'categories.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'categories.show','route_name' 		=> 'categories.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'categories.edit','route_name' 		=> 'categories.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'categories.create','route_name' 		=> 'categories.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'categories.timestamp','route_name' 	=> 'categories.index', 'node_name' 	=> 'lookups'],

			[ 'raw_route_name' => 'item-categories.index','route_name' 	=> 'item-categories.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'item-categories.show','route_name' 	=> 'item-categories.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'item-categories.edit','route_name' 	=> 'item-categories.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'item-categories.create','route_name' => 'item-categories.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'item-categories.timestamp','route_name' 	=> 'item-categories.index', 'node_name' 	=> 'lookups'],

			[ 'raw_route_name' => 'uoms.index','route_name' 			=> 'uoms.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'uoms.show','route_name' 				=> 'uoms.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'uoms.create','route_name' 			=> 'uoms.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'uoms.edit','route_name' 				=> 'uoms.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'uoms.timestamp','route_name' 		=> 'uoms.index', 'node_name' 		=> 'lookups'],

			[ 'raw_route_name' => 'designations.index','route_name' 	=> 'designations.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'designations.show','route_name'		=> 'designations.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'designations.edit','route_name' 		=> 'designations.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'designations.create','route_name'	=> 'designations.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'designations.timestamp','route_name' => 'designations.index', 'node_name' => 'lookups'],

			[ 'raw_route_name' => 'oems.index','route_name' 			=> 'oems.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'oems.show','route_name' 				=> 'oems.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'oems.edit','route_name' 				=> 'oems.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'oems.create','route_name' 			=> 'oems.index', 'node_name' 		=> 'lookups'],
			[ 'raw_route_name' => 'oems.timestamp','route_name' 		=> 'oems.index', 'node_name' 		=> 'lookups'],

			[ 'raw_route_name' => 'warehouses.index','route_name' 		=> 'warehouses.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'warehouses.show','route_name' 		=> 'warehouses.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'warehouses.edit','route_name' 		=> 'warehouses.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'warehouses.create','route_name' 		=> 'warehouses.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'warehouses.timestamp','route_name' 	=> 'warehouses.index', 'node_name' 	=> 'lookups'],

			[ 'raw_route_name' => 'bank-accounts.index','route_name'	=> 'bank-accounts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'bank-accounts.show','route_name' 	=> 'bank-accounts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'bank-accounts.edit','route_name' 	=> 'bank-accounts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'bank-accounts.create','route_name' 	=> 'bank-accounts.index', 'node_name' => 'lookups'],
			[ 'raw_route_name' => 'bank-accounts.timestamp','route_name'=> 'bank-accounts.index', 'node_name' => 'lookups'],

			[ 'raw_route_name' => 'currencies.index','route_name'		=> 'currencies.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'currencies.show','route_name'		=> 'currencies.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'currencies.edit','route_name' 		=> 'currencies.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'currencies.create','route_name' 		=> 'currencies.index', 'node_name' 	=> 'lookups'],
			[ 'raw_route_name' => 'currencies.timestamp','route_name'	=> 'currencies.index', 'node_name' 	=> 'lookups'],

			/**
			* ==================================================================================
			* 6. Interface
			* ==================================================================================
			*/
			[ 'raw_route_name' => 'upload-items.index','route_name' 	=> 'upload-items.index', 'node_name' 	=> 'interface'],
			[ 'raw_route_name' => 'upload-items.show','route_name' 		=> 'upload-items.index', 'node_name' 	=> 'interface'],
			[ 'raw_route_name' => 'upload-items.edit','route_name' 		=> 'upload-items.index', 'node_name' 	=> 'interface'],
			[ 'raw_route_name' => 'upload-items.create','route_name'	=> 'upload-items.create', 'node_name'	=> 'interface'],
			[ 'raw_route_name' => 'upload-items.check','route_name' 	=> 'upload-items.index', 'node_name' 	=> 'interface'],
			[ 'raw_route_name' => 'upload-items.import','route_name'	=> 'upload-items.index', 'node_name' 	=> 'interface'],

			/**
			* ==================================================================================
			* 7. Export
			* ==================================================================================
			*/
			// TODO
			[ 'raw_route_name' => 'exports.index','route_name' 			=> 'exports.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'exports.show','route_name' 			=> 'exports.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'exports.edit','route_name' 			=> 'exports.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'exports.create','route_name' 		=> 'exports.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'exports.timestamp','route_name' 		=> 'exports.index', 'node_name' 	=> 'system'],

			/**
			* ==================================================================================
			* 7. Admin
			* ==================================================================================
			*/

			[ 'raw_route_name' => 'users.index','route_name' 			=> 'users.index', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'users.create','route_name' 			=> 'users.index', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'users.show','route_name' 			=> 'users.index', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'users.edit','route_name' 			=> 'users.index', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'users.password-change','route_name'	=> 'users.index', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'users.timestamp','route_name' 		=> 'users.index', 'node_name' 		=> 'admin'],

			[ 'raw_route_name' => 'hierarchies.index','route_name' 		=> 'hierarchies.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'hierarchies.show','route_name' 		=> 'hierarchies.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'hierarchies.edit','route_name' 		=> 'hierarchies.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'hierarchies.create','route_name' 	=> 'hierarchies.index', 'node_name' => 'admin'],
			[ 'raw_route_name' => 'hierarchies.timestamp','route_name' 	=> 'hierarchies.index', 'node_name' => 'admin'],


			[ 'raw_route_name' => 'wfs.index','route_name' 				=> 'wfs.index', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'wfs.show','route_name' 				=> 'wfs.index', 'node_name' 		=> 'admin'],

			[ 'raw_route_name' => 'rates.index','route_name' 			=> 'rates.index', 'node_name' 		=> 'admin'],

			[ 'raw_route_name' => 'setups.index','route_name' 			=> 'setups.show', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'setups.edit','route_name' 			=> 'setups.show', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'setups.show','route_name' 			=> 'setups.show', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'setups.notice','route_name' 			=> 'setups.show', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'setups.tc','route_name' 				=> 'setups.show', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'setups.announcement','route_name' 	=> 'setups.show', 'node_name' 		=> 'admin'],
			[ 'raw_route_name' => 'setups.timestamp','route_name' 		=> 'setups.show', 'node_name' 		=> 'admin'],

			/**
			* ==================================================================================
			* 8. System
			* ==================================================================================
			*/

			[ 'raw_route_name' => 'notifications.full','route_name' 	=> 'notifications.full', 'node_name' => 'system'],

			[ 'raw_route_name' => 'tables.index','route_name' 			=> 'tables.index', 'node_name' 		=> 'system'],

			[ 'raw_route_name' => 'cps.index','route_name' 				=> 'cps.index', 'node_name' 		=> 'system'],
			[ 'raw_route_name' => 'cps.changelog','route_name' 			=> 'cps.changelog', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'cps.ui','route_name' 				=> 'cps.index', 'node_name'			=> 'system'],
			[ 'raw_route_name' => 'cps.timestamp','route_name' 			=> 'cps.index', 'node_name' 		=> 'system'],

			[ 'raw_route_name' => 'activities.index','route_name' 		=> 'activities.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'activities.show','route_name' 		=> 'activities.index', 'node_name' 	=> 'system'],

			[ 'raw_route_name' => 'attachments.all','route_name' 		=> 'attachments.all', 'node_name' => 'system'],
			[ 'raw_route_name' => 'attachments.show','route_name' 		=> 'attachments.all', 'node_name' => 'system'],

			[ 'raw_route_name' => 'menus.index','route_name' 			=> 'menus.index', 'node_name' 		=> 'system'],
			[ 'raw_route_name' => 'menus.show','route_name' 			=> 'menus.index', 'node_name' 		=> 'system'],
			[ 'raw_route_name' => 'menus.edit','route_name' 			=> 'menus.index', 'node_name' 		=> 'system'],
			[ 'raw_route_name' => 'menus.create','route_name' 			=> 'menus.index', 'node_name' 		=> 'system'],

			[ 'raw_route_name' => 'statuses.index','route_name' 		=> 'statuses.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'statuses.show','route_name' 			=> 'statuses.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'statuses.edit','route_name' 			=> 'statuses.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'statuses.create','route_name' 		=> 'statuses.index', 'node_name' 	=> 'system'],

			[ 'raw_route_name' => 'entities.index','route_name' 		=> 'entities.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'entities.show','route_name' 			=> 'entities.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'entities.edit','route_name' 			=> 'entities.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'entities.create','route_name' 		=> 'entities.index', 'node_name' 	=> 'system'],

			[ 'raw_route_name' => 'custom-errors.index','route_name' 	=> 'custom-errors.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'custom-errors.show','route_name' 	=> 'custom-errors.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'custom-errors.edit','route_name' 	=> 'custom-errors.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'custom-errors.create','route_name' 	=> 'custom-errors.index', 'node_name' => 'system'],

			[ 'raw_route_name' => 'groups.index','route_name' 			=> 'groups.index', 'node_name' 		=> 'system'],
			[ 'raw_route_name' => 'groups.show','route_name' 			=> 'groups.index', 'node_name' 		=> 'system'],
			[ 'raw_route_name' => 'groups.edit','route_name' 			=> 'groups.index', 'node_name' 		=> 'system'],
			[ 'raw_route_name' => 'groups.create','route_name' 			=> 'groups.index', 'node_name' 		=> 'system'],

			[ 'raw_route_name' => 'countries.index','route_name' 		=> 'countries.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'countries.show','route_name' 		=> 'countries.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'countries.edit','route_name' 		=> 'countries.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'countries.create','route_name' 		=> 'countries.index', 'node_name' 	=> 'system'],

			[ 'raw_route_name' => 'templates.index','route_name' 		=> 'templates.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'templates.show','route_name' 		=> 'templates.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'templates.edit','route_name' 		=> 'templates.index', 'node_name' 	=> 'system'],
			[ 'raw_route_name' => 'templates.create','route_name' 		=> 'templates.index', 'node_name' 	=> 'system'],

			[ 'raw_route_name' => 'aehs.index','route_name'				=> 'aehs.index', 'node_name' => 'system'],
			[ 'raw_route_name' => 'aehs.show','route_name'				=> 'aehs.index', 'node_name' => 'system'],


			/**
			* ==================================================================================
			* 9. Special (system)
			* ==================================================================================
			*/

			[ 'raw_route_name' => 'prls.index','route_name' 			=> 'prls.index', 'node_name' 		=> 'system'],
			[ 'raw_route_name' => 'prls.show','route_name' 				=> 'prls.index', 'node_name' 		=> 'system'],

			[ 'raw_route_name' => 'aels.index','route_name' 			=> 'aels.index', 'node_name' 		=> 'system'],
			[ 'raw_route_name' => 'aels.show','route_name' 				=> 'aels.index', 'node_name' 		=> 'system'],



			/**
			* ==================================================================================
			* 8. My Account
			* ==================================================================================
			*/
			/**
			* ==================================================================================
			* 1. Profile
			* ==================================================================================
			*/
			[ 'raw_route_name' => 'users.profile','route_name' 			=> 'users.profile', 'node_name' 		=> 'profile'],
			[ 'raw_route_name' => 'users.profile-edit','route_name' 	=> 'users.profile-edit', 'node_name' 	=> 'profile'],
			[ 'raw_route_name' => 'users.profile-password','route_name' => 'users.profile-password', 'node_name'=> 'profile'],
		];
		//
		Menu::insert($menus);
	}
}
