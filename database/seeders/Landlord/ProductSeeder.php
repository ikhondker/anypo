<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\Product;

// IQBAL
use Faker\Generator;

class ProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$faker = app(Generator::class);
		$products = [
			[

				'id'			=> '1001',
				'sku'			=> 'SME',
				'name'			=> 'Small and Medium Enterprise (5 User)',
				'addon'			=> false,
				'addon_type'	=> 'na',
				'mnth'			=> 1,
				'user'			=> 5,
				'gb'			=> 99,
				'list_price'	=> 59.00,	// per user list price 6$ after discuss 10$
				'price'			=> 49.00,
				'notes'			=> $faker->paragraph,
				'enable'		=> true,
			],
			[
				'id'			=> '1002',
				'sku'			=> 'FUTURE1',
				'name'			=> 'FUTURE1',
				'addon'			=> false,
				'addon_type'	=> 'na',
				'mnth'			=> 1,
				'user'			=> 3,
				'gb'			=> 0,
				'list_price'	=> 0,
				'price'			=> 0,
				'notes'			=> $faker->paragraph,
				'enable'		=> false,
			],
			[
				'id'			=> '1003',
				'sku'			=> 'FUTURE2',
				'name'			=> 'FUTURE2',
				'addon'			=> false,
				'addon_type'	=> 'na',
				'mnth'			=> 1,
				'user'			=> 3,
				'gb'			=> 5,
				'list_price'	=> 0,
				'price'			=> 0,
				'notes'			=> $faker->paragraph,
				'enable'		=> false,
			],
			/* ----------------------- ADDON --------------- */
			[
				'id'			=> '1004',
				'sku'			=> 'USER3',
				'name'			=> '3 Additional User',
				'addon'			=> true,
				'addon_type'	=> 'user',
				'mnth'			=> 1,
				'user'			=> 3,
				'gb'			=> 0,
				'list_price'	=> 29.99,
				'price'			=> 25.99,
				'notes'			=> $faker->paragraph,
				'enable'		=> true,
			],
			[
				'id'			=> '1005',
				'sku'			=> 'USER5',
				'name'			=> '5 Additional User',
				'addon'			=> true,
				'addon_type'	=> 'user',
				'mnth'			=> 1,
				'user'			=> 5,
				'gb'			=> 0,
				'list_price'	=> 49.99,
				'price'			=> 39.99,
				'notes'			=> $faker->paragraph,
				'enable'		=> true,
			],
			[
				'id'			=> '1006',
				'sku'			=> 'GB5',
				'name'			=> '5 GB Additional Space',
				'addon'			=> true,
				'addon_type'	=> 'gb',
				'mnth'			=> 1,
				'user'			=> 0,
				'gb'			=> 5,
				'list_price'	=> 6.99,
				'price'			=> 4.99,
				'notes'			=> $faker->paragraph,
				'enable'		=> false,
			],
			[
				'id'			=> '1007',
				'sku'			=> 'GB10',
				'name'			=> '10 GB Additional Space',
				'addon'			=> true,
				'addon_type'	=> 'gb',
				'mnth'			=> 1,
				'user'			=> 0,
				'gb'			=> 10,
				'list_price'	=> 12.99,
				'price'			=> 8.99,
				'notes'			=> $faker->paragraph,
				'enable'		=> false,
			],
		];

		Product::insert($products);
	}
}
