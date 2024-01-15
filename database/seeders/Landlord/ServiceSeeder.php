<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Service;

// IQBAL
use Faker\Generator;

class ServiceSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$faker = app(Generator::class);
		$services =  [
			[
				'id'			=> '1001',
				'name'			=> 'STARTUP',
				'addon'			=> false,
				'addon_type'	=> 'na',
				'mnth'			=> 1,
				'user'			=> 3,
				'gb'			=> 3,
				'price'			=> 8.99,
				'notes'			=> $faker->paragraph,
			],
			[
				'id'			=> '1002',
				'name'			=> 'SMALL OFFICE',
				'addon'			=> false,
				'addon_type'	=> 'na',
				'mnth'			=> 1,
				'user'			=> 7,
				'gb'			=> 5,
				'price'			=> 12.99,
				'notes'			=> $faker->paragraph,
			],
			[
				'id'			=> '1003',
				'sku'			 => 'MEDIUM-OFFICE',
				'name'			=> 'MEDIUM OFFICE',
				'addon'			=> false,
				'addon_type'	=> 'na',
				'mnth'			=> 1,
				'user'			=> 15,
				'gb'			=> 8,
				'price'			=> 19.99,
				'notes'			=> $faker->paragraph,
			],
			[
				'id'			=> '1004',
				'sku'			 => 'FUTURE',
				'name'			=> 'Future',
				'addon'	  => false,
				'addon_type'	=> 'na',
				'mnth'			=> 1,
				'user'			=> 15,
				'gb'			=> 8,
				'price'			=> 19.99,
				'notes'			=> $faker->paragraph,
			],
			/* ----------------------- ADDON --------------- */
			[
				'id'			=> '1005',
				'sku'			 => 'ADDON1',
				'name'			=> '3 More user',
				'addon'	  => true,
				'addon_type'	=> 'user',
				'mnth'			=> 1,
				'user'			=> 3,
				'gb'			=> 0,
				'price'			=> 4.99,
				'notes'			=> $faker->paragraph,
			],
			[
				'id'			=> '1006',
				'sku'			 => 'ADDON2',
				'name'			=> '5 More user',
				'addon'	  => true,
				'addon_type'	=> 'user',
				'mnth'			=> 1,
				'user'			=> 5,
				'gb'			=> 0,
				'price'			=> 7.99,
				'notes'			=> $faker->paragraph,
			],
			[
				'id'			=> '1007',
				'sku'			 => 'ADDON3',
				'name'			=> '3 GB More Space',
				'addon'	  => true,
				'addon_type'	=> 'gb',
				'mnth'			=> 1,
				'user'			=> 0,
				'gb'			=> 3,
				'price'			=> 7.99,
				'notes'			=> $faker->paragraph,
			],
			[
				'id'			=> '1008',
				'sku'			 => 'ADDON4',
				'name'			=> '5 GB More Space',
				'addon'	  => true,
				'addon_type'	=> 'gb',
				'mnth'			=> 1,
				'user'			=> 0,
				'gb'			=> 5,
				'price'			=> 9.99,
				'notes'			=> $faker->paragraph,
			],
		];

		Service::insert($services);
	}
}
