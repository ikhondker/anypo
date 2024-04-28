<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Workflow\Hierarchy;

class HierarchySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//Schema::disableForeignKeyConstraints();
		//Hierarchy::truncate();
		//Schema::enableForeignKeyConstraints();

		$hierarchies =  [
			[
				'id' 	=> 1001,
				'name'	=> 'All PR Approval (Seeded)',
			],
			[
				'id' 	=> 1002,
				'name'	=> 'All PO Approval (Seeded)',
			],
			// [
		  
			//	'name'		=> 'All PO Approval',
			// ],
			// [
		  
			//	'name'		=> 'PR Approval for Sales',
			// ],
			// [
		  
			//	'name'		=> 'PO Approval for Finance',
			// ],
			];
		  //
		  Hierarchy::insert($hierarchies);
	}
}
