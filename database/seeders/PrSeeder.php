<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;

use Faker\Generator;

class PrSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		$faker = app(Generator::class);
	
		$prs =  [
			
				[
					'summary'			=> 'User 111 - PR 111 - Dept Sales',
					'currency'			=> $faker->randomElement(['BDT', 'USD']),
					'requestor_id'		=> 1004,
					'dept_id'			=> 1003,
					'supplier_id'		=> Supplier::inRandomOrder()->first()->id,
					'project_id'		=> Project::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 500,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 580,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'User 111 - PR 222 - Dept Sales',
					'currency'			=> $faker->randomElement(['BDT', 'USD']),
					'requestor_id'		=> 1004,
					'dept_id'			=> 1003,
					'supplier_id'		=> Supplier::inRandomOrder()->first()->id,
					'project_id'		=> Project::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 600,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 680,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'User 111 - PR 333 - Dept Sales',
					'currency'			=> $faker->randomElement(['BDT', 'USD']),
					'requestor_id'		=> 1004,
					'dept_id'			=> 1003,
					'supplier_id'		=> Supplier::inRandomOrder()->first()->id,
					'project_id'		=> Project::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 600,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 680,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'User 222 - PR 111 - Dept Marketing',
					'currency'			=> $faker->randomElement(['BDT', 'USD']),
					'requestor_id'		=> 1005,
					'dept_id'			=> 1004,
					'supplier_id'		=> Supplier::inRandomOrder()->first()->id,
					'project_id'		=> Project::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 700,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 780,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'User 222 - PR 222 - Dept Marketing',
					'currency'			=> $faker->randomElement(['BDT', 'USD']),
					'requestor_id'		=> 1005,
					'dept_id'			=> 1006,
					'supplier_id'		=> Supplier::inRandomOrder()->first()->id,
					'project_id'		=> Project::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 800,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 880,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'User 222 - PR 333 - Dept Marketing',
					'currency'			=> $faker->randomElement(['BDT', 'USD']),
					'requestor_id'		=> 1005,
					'dept_id'			=> 1006,
					'supplier_id'		=> Supplier::inRandomOrder()->first()->id,
					'project_id'		=> Project::inRandomOrder()->first()->id,
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 800,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 880,
					'fc_currency'		=> 'BDT',
				],

			];

		  Pr::insert($prs);
		  
		  //Pr::factory()->count(10)->create();

	}
}
