<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\Supplier;

class SupplierSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//$faker = app(Generator::class);

		$seededSupplier =  [
		 	[
				'id' 				=> 1001,
				'name'				=> 'Seeded Supplier',
				'contact_person'	=> 'Support Engineer',
				'address1'			=> '3939 Lawrence Ave, E#108,',
				'address2'			=> '',
				'city'				=> 'Scarborough',  
				'state'				=> 'ON',  
				'zip'				=> 'M1G1R9',
				'country'			=> 'CA',
				'email'				=> 'info@anypo.net',
				'cell'				=> '+0012262804920',
				'website'			=> 'https://www.anypo.net',

				
			],
		];
		
		Supplier::insert($seededSupplier);

		// MUST comment this in production
		Supplier::factory()->count(6)->create();
	}
}
