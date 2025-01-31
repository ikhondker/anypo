<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Lookup\Project;
use App\Models\User;

use Faker\Generator;

class ProjectSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		$faker = app(Generator::class);
		// createTenant Job sets pm for seeded project
		$seededProject = [
				[
					'name'		=> 'Seeded Project',
					'code'		=> 'SEEDED',
					'dept_id' 	=> '1001',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'start_date'=> now(),
					'end_date'	=> now()->addDays(30),
					'amount'	=> 100000,
					'notes'		=> 'This is Seeded Project.'
				],
			];

			Project::insert($seededProject);

	}
}
