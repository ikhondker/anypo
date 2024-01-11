<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// IQBAL
use Faker\Generator;

use App\Models\Tenant\Lookup\Warehouse;

class WarehouseSeeder extends Seeder
{


	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		$faker = app(Generator::class);

		$warehouses =  [
			[
				'name'          => 'Head-Office',
				'address1'      => $faker->address,
				'address2'      => $faker->address,
				'zip'           => $faker->postcode,
				'city'          => $faker->city,
			],
			[
				'name'          => 'Branch Office',
				'address1'      => $faker->address,
				'address2'      => $faker->address,
				'zip'           => $faker->postcode,
				'city'          => $faker->city,
			],
			[
				'name'          => 'Regional Warehouse',
				'address1'      => $faker->address,
				'address2'      => $faker->address,
				'zip'           => $faker->postcode,
				'city'          => $faker->city,

			],
		  ];
		  //
		  Warehouse::insert($warehouses);
	}
}
