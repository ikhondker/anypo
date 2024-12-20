<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Manage\UomClass;

class UomClassSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//Schema::disableForeignKeyConstraints();
		//Uom::truncate();
		//Schema::enableForeignKeyConstraints();

		$uomClasses = [
			[
				'id' 	=> 1001,
				'name' => 'Count',
			],
			[
				'id' 	=> 1002,
				'name' => 'Length',
			],
			[
				'id' 	=> 1003,
				'name' => 'Mass',
			],
			[
				'id' 	=> 1004,
				'name' => 'Capacity',
			],
			[
				'id' 	=> 1005,
				'name' => 'Time',
			],
			[
				'id' 	=> 1006,
				'name' => 'Temperature',
			],



		];
		//
		UomClass::insert($uomClasses);
	}
}
