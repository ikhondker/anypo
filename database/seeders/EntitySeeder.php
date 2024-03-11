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

		$entities =  [
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
				'name'		  	=> 'Dept Budget',
				'model'			=> 'DeptBudget',
				'route'		 	=> 'dept-budgets',
				'directory'		=> 'dept-budget',
			],
			[
				'entity'		=> 'PROJECT',
				'name'		  	=> 'Project',
				'model'			=> 'Project',
				'route'		 	=> 'projects',
				'directory'		=> 'project',
			],
			[
				'entity'		=> 'PR',
				'name'		  	=> 'Requisition',
				'model'			=> 'Pr',
				'route'		 	=> 'prs',
				'directory'		=> 'pr',
			],
			[
				'entity'		=> 'PO',
				'name'		  	=> 'Purchase Order',
				'model'			=> 'Po',
				'route'		 	=> 'pos',
				'directory'		=> 'po',
			],
			[
				'entity'		=> 'RECEIPT',
				'name'		  	=> 'Receipt',
				'model'			=> 'Receipt',
				'route'		 	=> 'receipts',
				'directory'		=> 'receipt',
			],
			[
				'entity'		=> 'INVOICE',
				'name'		  	=> 'Invoice',
				'model'			=> 'Invoice',
				'route'		 	=> 'Invoices',
				'directory'		=> 'Invoice',
			],
			[
				'entity'		=> 'PAYMENT',
				'name'		  	=> 'Payment',
				'model'			=> 'Payment',
				'route'		 	=> 'payments',
				'directory'		=> 'payment',
			],
			[
				'entity'		=> 'COMMENT',
				'name'		  	=> 'Comment',
				'model'			=> 'Comment',
				'route'		 	=> 'comments',
				'directory'		=> 'comment',
			],
		  ];

		
		  Entity::insert($entities);
	}
}
