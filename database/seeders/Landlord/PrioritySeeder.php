<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\Priority;

class PrioritySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		//Priority::truncate();
		
		$priorities = [
				[
					'id'	=> '1001',
					'name' => 'Low',
					'badge' => 'info',
				],
				[
					'id'	=> '1002',
					'name' => 'Medium',
					'badge' => 'primary',
				],
				[
					'id'	=> '1003',
					'name' => 'High',
					'badge' => 'danger',
				],
			];
		Priority::insert($priorities);
	}
}
