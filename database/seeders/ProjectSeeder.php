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
	 
			$projects =  [
				[
					'name'  	=> 'Generic',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'			=> $faker->paragraph
				],
				[
					'name' 		=> 'GB06',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'			=> $faker->paragraph
				],
				[
					'name' 		=> 'GB07',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'			=> $faker->paragraph
				],
				[
					'name' 		=> 'GB08',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'			=> $faker->paragraph
				],
				[
					'name' 		=> 'GB09',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'			=> $faker->paragraph
				],
				[
					'name' 		=> 'GB10',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'			=> $faker->paragraph
				],
			];
			//
			Project::insert($projects);
	}
}
