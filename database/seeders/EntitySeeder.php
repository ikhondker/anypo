<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Manage\Entity;
use Illuminate\Support\Facades\Schema;

class EntitySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//Schema::disableForeignKeyConstraints();
		//Entity::truncate();
		//Schema::enableForeignKeyConstraints();

		$entities = [
			[
				'entity'		=> 'CORE',
				'name'			=> 'Core',
				'model'			=> 'Core',
				'route'			=> 'cores',
				'directory'		=> 'core',
			],
			[
				'entity'		=> 'TEMPLATE',
				'name'			=> 'Template',
				'model'			=> 'Template',
				'route'			=> 'templates',
				'directory'		=> 'template',
			],
			[
				'entity'		=> 'BUDGET',
				'name'			=> 'Budget',
				'model'			=> 'Budget',
				'route'			=> 'budgets',
				'directory'		=> 'budget',
			],
			[
				'entity'		=> 'DEPTBUDGET',
				'name'			=> 'Dept Budget',
				'model'			=> 'DeptBudget',
				'route'		 	=> 'dept-budgets',
				'directory'		=> 'dept-budget',
			],
			[
				'entity'		=> 'ITEM',
				'name'			=> 'Items',
				'model'			=> 'Items',
				'route'		 	=> 'items',
				'directory'		=> 'item',
			],
			[
				'entity'		=> 'PROJECT',
				'name'			=> 'Project',
				'model'			=> 'Project',
				'route'		 	=> 'projects',
				'directory'		=> 'project',
			],
			[
				'entity'		=> 'PR',
				'name'			=> 'Requisition',
				'model'			=> 'Pr',
				'route'		 	=> 'prs',
				'directory'		=> 'pr',
			],
			[
				'entity'		=> 'PO',
				'name'			=> 'Purchase Order',
				'model'			=> 'Po',
				'route'		 	=> 'pos',
				'directory'		=> 'po',
			],

			[
				'entity'		=> 'RECEIPT',
				'name'			=> 'Receipt',
				'model'			=> 'Receipt',
				'route'		 	=> 'receipts',
				'directory'		=> 'receipt',
			],
			[
				'entity'		=> 'INVOICE',
				'name'			=> 'Invoice',
				'model'			=> 'Invoice',
				'route'		 	=> 'Invoices',
				'directory'		=> 'Invoice',
			],
			[
				'entity'		=> 'PAYMENT',
				'name'			=> 'Payment',
				'model'			=> 'Payment',
				'route'		 	=> 'payments',
				'directory'		=> 'payment',
			],
			[
				'entity'		=> 'AEH',
				'name'			=> 'Accounting Entry',
				'model'			=> 'Aeh',
				'route'		 	=> 'aeh',
				'directory'		=> 'aeh',
			],
			[
				'entity'		=> 'TAX',
				'name'			=> 'Tax',
				'model'			=> 'Tax',
				'route'		 	=> 'tax',
				'directory'		=> 'tax',
			],
			[
				'entity'		=> 'SUPPLIER',
				'name'			=> 'Supplier',
				'model'			=> 'Supplier',
				'route'		 	=> 'Supplier',
				'directory'		=> 'Supplier',
			],
		];

		
		Entity::insert($entities);
	}
}
