<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Lookup\Oem;

class OemSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
	  //Schema::disableForeignKeyConstraints();
	  //Oem::truncate();
	  //Schema::enableForeignKeyConstraints();
	  
		$oems =  [
			[
				'id' 	=> 1001,
				'name'	=> 'General',
			],
			[
				'id' 	=> 1002,
				'name' => 'HP',
			],
			[
				'id' 	=> 1003,
				'name' => 'Apple',
			],
			[
				'id' 	=> 1004,
				'name' => 'ASUS',
			],
			[
				'id' 	=> 1005,
				'name' => 'Lenovo',
			],
			[
				'id' 	=> 1006,
				'name' => 'Dell',
			],
		];

		Oem::insert($oems);
	}
}
