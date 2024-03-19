<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Project;
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
					'code'  	=> 'Generic',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'AA01',
					'code'  	=> 'AA01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'AF01',
					'code'  	=> 'AF01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'AH01',
					'code'  	=> 'AH01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'AS01',
					'code'  	=> 'AS01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'BG01',
					'code'  	=> 'BG01',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'BH07',
					'code'  	=> 'BH07',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],

				[
					'name' 		=> 'GB06',
					'code'  	=> 'GB06',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'GB07',
					'code'  	=> 'GB07',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'GB08',
					'code'  	=> 'GB08',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'GB09',
					'code'  	=> 'GB09',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
				[
					'name' 		=> 'GB10',
					'code'  	=> 'GB10',
					'pm_id' 	=> User::inRandomOrder()->first()->id,
					'amount'	=> 100000,
					'notes'		=> $faker->paragraph
				],
			];
			//
			Project::insert($projects);
	}
}
