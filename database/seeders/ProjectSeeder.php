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
		//Schema::disableForeignKeyConstraints();
		//Project::truncate();
		//Schema::enableForeignKeyConstraints();

		// TODO check who will be pm for seeded project
		$seededProject = [
				[
					'name'		=> 'Seeded Project',
					'code'		=> 'SEEDED',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> 'This is Seeded Project.'
				],
			];


			$demoProjects = [
				[
					'name' 		=> 'Name is AA01',
					'code'		=> 'AA01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 10000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'Name is AF01',
					'code'		=> 'AF01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 10000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'Name is AH01',
					'code'		=> 'AH01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 10000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'Name is AS01',
					'code'		=> 'AS01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 10000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'Name is BG01',
					'code'		=> 'BG01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 10000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'Name is BH07',
					'code'		=> 'BH07',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 10000,
					'notes'		=> $faker->paragraph
				],

				[
					'name' 		=> 'Name is GB06',
					'code'		=> 'GB06',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'Name is GB07',
					'code'		=> 'GB07',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 10000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'Name is GB08',
					'code'		=> 'GB08',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'Name is GB09',
					'code'		=> 'GB09',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'Name is GB10',
					'code'		=> 'GB10',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
			];
			//
			Project::insert($seededProject);
			// MUST Comment this
			Project::insert($demoProjects);
	}
}
