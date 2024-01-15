<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Lookup\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//Schema::disableForeignKeyConstraints();
		//Project::truncate();
		//Schema::enableForeignKeyConstraints();
	 
			$projects =  [
				[
					'name'  => 'Generic',
					'pm_id' => User::inRandomOrder()->first()->id,
				],
				[
					'name' => 'GB06',
					'pm_id' => User::inRandomOrder()->first()->id,
				],
				[
					'name' => 'GB07',
					'pm_id' => User::inRandomOrder()->first()->id,
				],
				[
					'name' => 'GB08',
					'pm_id' => User::inRandomOrder()->first()->id,
				],
				[
					'name' => 'GB09',
					'pm_id' => User::inRandomOrder()->first()->id,
				],
				[
					'name' => 'GB10',
					'pm_id' => User::inRandomOrder()->first()->id,
				],
			];
			//
			Project::insert($projects);
	}
}
