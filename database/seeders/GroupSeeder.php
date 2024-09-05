<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\Group;

class GroupSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		//Group::truncate();

		$groups = [
			[
				'id'	=> '1001',
				'name'	=> "Seeded Item Group",
			],
		];

		Group::insert($groups);
	}
}
