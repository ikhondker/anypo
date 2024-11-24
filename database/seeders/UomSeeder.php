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

		$uoms_default = [
			[
				'id' 			=> 1001,
				'name' 			=> 'Each',
				'uom_class_id' 	=> '1001',
				'default' 		=> true,
			],
			[
				'id' 			=> 1002,
				'name' 			=> 'm',
				'uom_class_id' 	=> '1002',
				'default' 		=> true,
			],
			[
				'id' 			=> 1003,
				'name' 			=> 'gm',
				'uom_class_id' 	=> '1003',
				'default' 		=> true,
			],
			[
				'id' 			=> 1004,
				'name' 			=> 'Litre',
				'uom_class_id' 	=> '1004',
				'default' 		=> true,
			],
			[
				'id' 			=> 1005,
				'name' 			=> 'Day',
				'uom_class_id' 	=> '1005',
				'default' 		=> true,
			],
			[
				'id' 			=> 1006,
				'name' 			=> 'K',
				'uom_class_id' 	=> '1006',
				'default' 		=> true,
			],
		];
		//
		Uom::insert($uoms_default);

		$uoms_count = [
			[
				'name' 			=> 'Pcs',
				'uom_class_id' 	=> '1001',
				'conversion' 	=> 1,
			],
			[
				'name' 			=> 'Unit',
				'uom_class_id' 	=> '1001',
				'conversion' 	=> 1,
			],
		];
		//
		Uom::insert($uoms_count);


		$uoms_length = [
			[
				'name' 			=> 'Cm',
				'uom_class_id' 	=> '1002',
				'conversion' 	=> 0.1,
			],
			[
				'name' 			=> 'Km',
				'uom_class_id' 	=> '1002',
				'conversion' 	=> 1000,
			],
			[
				'name' 			=> 'Feet',
				'uom_class_id' 	=> '1002',
				'conversion' 	=> 0.3048,
			],
			[
				'name' 			=> 'Yard',
				'uom_class_id' 	=> '1002',
				'conversion' 	=> 0.9144,
			],
		];
		// TODO
		// Uom::insert($uoms_length);

		$uoms_mass = [
			[
				'name' 			=> 'gm',
				'uom_class_id' 	=> '1003',
				'conversion' 	=> 0.1,
			],
			[
				'name' 			=> 'Pound',
				'uom_class_id' 	=> '1003',
				'conversion' 	=> 0.453592,
			],
			[
				'name' 			=> 'Ounce',
				'uom_class_id' 	=> '1003',
				'conversion' 	=> 0.0283495,
			],
		];
		// TODO
		// Uom::insert($uoms_mass);

		$uoms_capacity =[
			[
				'name' 			=> 'ml',
				'uom_class_id' 	=> '1004',
				'conversion' 	=> 0.001,
			],
			[
				'name' 			=> 'Gallon',
				'uom_class_id' 	=> '1004',
				'conversion' 	=> 4.54609,
			],
		];
		// TODO
		// Uom::insert($uoms_capacity);

		$uoms_time = [
			[
				'name' 			=> 'Hour',
				'uom_class_id' 	=> '1005',
				'conversion' 	=> 0.0416667,
			],
			[
				'name' 			=> 'Week',
				'uom_class_id' 	=> '1005',
				'conversion' 	=> 7,
			],
			[
				'name' 			=> 'Month',
				'uom_class_id' 	=> '1005',
				'conversion' 	=> 30,
			],
		];
		// TODO
		//Uom::insert($uoms_time);

	}
}
