<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\Designation;

class DesignationSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

	  Designation::truncate();

		$designations =  [

			[
				'id'	=> '1001',
				'name'	=> 'IT Administrator',
			],
			[
				'id'	=> '1002',
				'name'	=> 'Accountant',
			],
			[
				'id'	=> '1003',
				'name'	=> 'CEO',
			],
			[
				'id'	=> '1004',
				'name'	=> 'CXO',
			],
			[
				'id'	=> '1005',
				'name'	=> 'HoD',
			],
			[
				'id'	=> '1006',
				'name'	=> 'Manager',
			],
			[
				'id'	=> '1007',
				'name' 	=> 'Executive',
			],
		];
		//
		Designation::insert($designations);
	}
}
