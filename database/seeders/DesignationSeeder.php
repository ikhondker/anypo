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
				'id'    => '1001',
				'name'  => 'System/IT Administrator',
			],
			[
				'id'    => '1002',
				'name'  => 'MD',
			],
			[
				'id'    => '1003',
				'name'  => 'CXO',
			],
			[
				'id'    => '1004',
				'name'  => 'HoD',
			],
			[
				'id'    => '1005',
				'name'  => 'Manager',
			],
			[
				'id'    => '1006',
				'name'  => 'Office',
			],
			[
				'id'    => '1007',
				'name'  => 'Executive',
			],
			[
				'id'    => '1009',
				'name'  => 'Accountant',
			],
		];
		//
		Designation::insert($designations);
	}
}
