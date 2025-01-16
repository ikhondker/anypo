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
				'entity'		=> 'Core',
				'name'			=> 'Core',
				'model'			=> 'Core',
				'route'			=> 'cores',
				'directory'		=> 'core',
			],
			[
				'entity'		=> 'Template',
				'name'			=> 'Template',
				'model'			=> 'Template',
				'route'			=> 'templates',
				'directory'		=> 'template',
			],
			[
				'entity'		=> 'Budget',
				'name'			=> 'Budget',
				'model'			=> 'Budget',
				'route'			=> 'budgets',
				'directory'		=> 'budget',
			],
			[
				'entity'		=> 'DeptBudget',
				'name'			=> 'Dept Budget',
				'model'			=> 'DeptBudget',
				'route'		 	=> 'dept-budgets',
				'directory'		=> 'dept-budget',
			],
			[
				'entity'		=> 'Item',
				'name'			=> 'Items',
				'model'			=> 'Item',
				'route'		 	=> 'items',
				'directory'		=> 'item',
			],
			[
				'entity'		=> 'Project',
				'name'			=> 'Project',
				'model'			=> 'Project',
				'route'		 	=> 'projects',
				'directory'		=> 'project',
			],
			[
				'entity'		=> 'Pr',
				'name'			=> 'Requisition',
				'model'			=> 'Pr',
				'route'		 	=> 'prs',
				'directory'		=> 'pr',
			],
			[
				'entity'		=> 'Po',
				'name'			=> 'Purchase Order',
				'model'			=> 'Po',
				'route'		 	=> 'pos',
				'directory'		=> 'po',
			],
			[
				'entity'		=> 'Receipt',
				'name'			=> 'Receipt',
				'model'			=> 'Receipt',
				'route'		 	=> 'receipts',
				'directory'		=> 'receipt',
			],
			[
				'entity'		=> 'Invoice',
				'name'			=> 'Invoice',
				'model'			=> 'Invoice',
				'route'		 	=> 'Invoices',
				'directory'		=> 'Invoice',
			],
			[
				'entity'		=> 'Payment',
				'name'			=> 'Payment',
				'model'			=> 'Payment',
				'route'		 	=> 'payments',
				'directory'		=> 'payment',
			],
			[
				'entity'		=> 'Aeh',
				'name'			=> 'Accounting Entry',
				'model'			=> 'Aeh',
				'route'		 	=> 'aeh',
				'directory'		=> 'aeh',
			],
			[
				'entity'		=> 'Ael',
				'name'			=> 'Accounting Line',
				'model'			=> 'Ael',
				'route'		 	=> 'aels',
				'directory'		=> 'ael',
			],
			[
				'entity'		=> 'Tax',
				'name'			=> 'Tax',
				'model'			=> 'Tax',
				'route'		 	=> 'taxes',
				'directory'		=> 'tax',
			],
			[
				'entity'		=> 'Supplier',
				'name'			=> 'Supplier',
				'model'			=> 'Supplier',
				'route'		 	=> 'suppliers',
				'directory'		=> 'supplier',
			],
		];


		Entity::insert($entities);
	}
}
