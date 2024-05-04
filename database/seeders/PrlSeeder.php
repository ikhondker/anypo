<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Prl;
//use App\Models\Tenant\Pr;
//use App\Models\Tenant\Lookup\Dept;
//use App\Models\Tenant\Lookup\Supplier;
//use App\Models\Tenant\Lookup\Project;

//use Faker\Generator;

class PrlSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//$faker = app(Generator::class);

		
		Prl::factory()->count(10)->create();
	}
}
