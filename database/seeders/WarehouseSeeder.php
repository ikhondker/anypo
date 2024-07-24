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

		$seededWarehouses =  [
			[
				'name'			=> 'Central Warehouse',
				'address1'		=> '3939 Lawrence Ave, E#108,',
				'address2'		=> '',
				'city'			=> 'Scarborough',  
				'state'			=> 'ON',  
				'zip'			=> 'M1G1R9',
			],
			[
				'name'			=> 'Regional Warehouse 1',
				'address1'		=> '3939 Lawrence Ave, E#108,',
				'address2'		=> '',
				'city'			=> 'Scarborough',  
				'state'			=> 'ON',  
				'zip'			=> 'M1G1R9',
			],
			[
				'name'			=> 'Head Office',
				'address1'		=> '3939 Lawrence Ave, E#108,',
				'address2'		=> '',
				'city'			=> 'Scarborough',  
				'state'			=> 'ON',  
				'zip'			=> 'M1G1R9',
			],
			[
				'name'			=> 'Branch Office 1',
				'address1'		=> '3939 Lawrence Ave, E#108,',
				'address2'		=> '',
				'city'			=> 'Scarborough',  
				'state'			=> 'ON',  
				'zip'			=> 'M1G1R9',
			],
			
		  ];
		  //
		  Warehouse::insert($seededWarehouses);
	}
}
