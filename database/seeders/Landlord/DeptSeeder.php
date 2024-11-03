<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\Dept;

class DeptSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			$depts = [
					[
						'id'	=> '1001',
						'name' 	=> 'General',
					],
					[
						'id'	=> '1002',
						'name' => 'Sales',
					],
					[
						'id'	=> '1003',
						'name' => 'Billing',
					],
					[
						'id'	=> '1004',
						'name' => 'Support',
					],
				];
			Dept::insert($depts);
		}
}
