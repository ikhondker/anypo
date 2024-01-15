<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Workflow\Hierarchyl;

class HierarchylSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//Schema::disableForeignKeyConstraints();
		Hierarchyl::truncate();
		//Schema::enableForeignKeyConstraints();

		// TODO need to update from CreateTenant
		$hierarchyls =  [
			[
				'hid'			=> 1001,
				'approver_id'	=> '1008',
			],
			[
				'hid'			=> 1001,
				'approver_id'	=> '1009',
			],
			// [
			//		'hid'		=> 1001,
			//		'approver_id'   => '1003',
			// ],
			[
				'hid'			=> 1002,
				'approver_id'	=> '1008',
			],
			[
				'hid'			=> 1002,
				'approver_id'	=> '1009',
			],
			// [
			//		'hid'		=> 1002,
			//		'approver_id'   => '1003',
			// ],

			// INSERT INTO hierarchyls(hid, approver_id) 
			//		SELECT 1003/1004,approver_id 
			//		FROM hierarchyls 
			//		WHERE hid= 1001;


			];
		  //
		  Hierarchyl::insert($hierarchyls);
	}
}
