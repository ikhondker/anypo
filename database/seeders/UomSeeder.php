<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Lookup\Uom;

class UomSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//Schema::disableForeignKeyConstraints();
		//Uom::truncate();
		//Schema::enableForeignKeyConstraints();
	
		$uoms =  [
			// [
			// 	'id' 	=> 1001,
			// 	'name'	=> 'Each',
			// ],
			[
				'id' 	=> 1001,
				'name' => 'Pcs',
			],
			[
				'id' 	=> 1002,
				'name' => 'Kg',
			],
			[
				'id' 	=> 1003,
				'name' => 'Meter',
			],
			[
				'id' 	=> 1004,
				'name' => 'Day',
			],
			[
				'id' 	=> 1005,
				'name' => 'Litre',
			],

		];
		//
		Uom::insert($uoms);
	}
}
