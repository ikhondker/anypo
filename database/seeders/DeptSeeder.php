<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Faker\Generator;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Workflow\Hierarchy;

class DeptSeeder extends Seeder 
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//Schema::disableForeignKeyConstraints();
		//Dept::truncate();
		//Schema::enableForeignKeyConstraints();
		
		$faker = app(Generator::class);

		$depts = [
			[
				'id' 				=> 1001,
				'name' 				=> 'IT',
				'pr_hierarchy_id' 	=> 1001,
				'po_hierarchy_id' 	=> 1002,
			],
			[
				'id' 				=> 1002,
				'name' 				=> 'Finance',
				'pr_hierarchy_id' 	=> 1001,
				'po_hierarchy_id' 	=> 1002,
			],
			[
				'id' 				=> 1003,
				'name' 				=> 'Management',
				'pr_hierarchy_id' 	=> 1001,
				'po_hierarchy_id' 	=> 1002,
			],
			[
				'id' 				=> 1004,
				'name' 				=> 'HR & Admin',
				'pr_hierarchy_id' 	=> 1001,
				'po_hierarchy_id' 	=> 1002,
			],
			[
				'id' 				=> 1005,
				'name' 				=> 'Sales',
				'pr_hierarchy_id' 	=> 1001,
				'po_hierarchy_id' 	=> 1002,
			],
			[
				'id' 				=> 1006,
				'name' 				=> 'Marketing',
				'pr_hierarchy_id' 	=> 1001,
				'po_hierarchy_id' 	=> 1002,
			],
			[
				'id' 				=> 1007,
				'name' 				=> 'Production',
				'pr_hierarchy_id' 	=> 1001,
				'po_hierarchy_id' 	=> 1002,
		 	],
			
			
		];
		//
		Dept::insert($depts);
	}
}
