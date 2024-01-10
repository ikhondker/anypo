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
				'id' 			=> 1001,
				'name' 			=> 'Pcs',
				'uom_class_id' 	=> '1001',
				
			],
			[
				'id' 			=> 1002,
				'name' 			=> 'Meter',
				'uom_class_id' 	=> '1002',
			],
			[
				'id' 			=> 1003,
				'name' 			=> 'Kg',
				'uom_class_id' 	=> '1003',
			],
			[
				'id' 			=> 1004,
				'name' 			=> 'Litre',
				'uom_class_id' 	=> '1004',
			],
			[
				'id' 			=> 1005,
				'name' 			=> 'Day',
				'uom_class_id' 	=> '1005',
			],
			

		];
		//
		Uom::insert($uoms);
	}
}
