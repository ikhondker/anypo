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
		//$colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];

		$uoms_default = [
			[
				'id' 			=> 1001,
				'name' 			=> 'Each',
				'uom_class_id' 	=> '1001',
				'default' 		=> true,
				'bg_color'		=> 'primary',
			],
			[
				'id' 			=> 1002,
				'name' 			=> 'm',
				'uom_class_id' 	=> '1002',
				'default' 		=> true,
				'bg_color'		=> 'secondary',
			],
			[
				'id' 			=> 1003,
				'name' 			=> 'gm',
				'uom_class_id' 	=> '1003',
				'default' 		=> true,
				'bg_color'		=> 'success',
			],
			[
				'id' 			=> 1004,
				'name' 			=> 'Litre',
				'uom_class_id' 	=> '1004',
				'default' 		=> true,
				'bg_color'		=> 'danger',
			],
			[
				'id' 			=> 1005,
				'name' 			=> 'Day',
				'uom_class_id' 	=> '1005',
				'default' 		=> true,
				'bg_color'		=> 'warning',
			],
			[
				'id' 			=> 1006,
				'name' 			=> 'K',
				'uom_class_id' 	=> '1006',
				'default' 		=> true,
				'bg_color'		=> 'info',
			],
		];
		//
		Uom::insert($uoms_default);

		$uoms_count = [
			[
				'name' 			=> 'Pcs',
				'uom_class_id' 	=> '1001',
				'conversion' 	=> 1,
				'bg_color'		=> 'primary',
			],
			[
				'name' 			=> 'Unit',
				'uom_class_id' 	=> '1001',
				'conversion' 	=> 1,
				'bg_color'		=> 'primary',
			],
		];
		//
		Uom::insert($uoms_count);


		$uoms_length = [
			[
				'name' 			=> 'Cm',
				'uom_class_id' 	=> '1002',
				'conversion' 	=> 0.1,
				'bg_color'		=> 'secondary',
			],
			[
				'name' 			=> 'Km',
				'uom_class_id' 	=> '1002',
				'conversion' 	=> 1000,
				'bg_color'		=> 'secondary',
			],
			[
				'name' 			=> 'Feet',
				'uom_class_id' 	=> '1002',
				'conversion' 	=> 0.3048,
				'bg_color'		=> 'secondary',
			],
			[
				'name' 			=> 'Yard',
				'uom_class_id' 	=> '1002',
				'conversion' 	=> 0.9144,
				'bg_color'		=> 'secondary',
			],
		];
		// TODO
		// Uom::insert($uoms_length);

		$uoms_mass = [
			[
				'name' 			=> 'gm',
				'uom_class_id' 	=> '1003',
				'conversion' 	=> 0.1,
				'bg_color'		=> 'success',
			],
			[
				'name' 			=> 'Pound',
				'uom_class_id' 	=> '1003',
				'conversion' 	=> 0.453592,
				'bg_color'		=> 'success',
			],
			[
				'name' 			=> 'Ounce',
				'uom_class_id' 	=> '1003',
				'conversion' 	=> 0.0283495,
				'bg_color'		=> 'success',
			],
		];
		// TODO
		// Uom::insert($uoms_mass);

		$uoms_capacity =[
			[
				'name' 			=> 'ml',
				'uom_class_id' 	=> '1004',
				'conversion' 	=> 0.001,
				'bg_color'		=> 'danger',
			],
			[
				'name' 			=> 'Gallon',
				'uom_class_id' 	=> '1004',
				'conversion' 	=> 4.54609,
				'bg_color'		=> 'danger',
			],
		];
		// TODO
		// Uom::insert($uoms_capacity);

		$uoms_time = [
			[
				'name' 			=> 'Hour',
				'uom_class_id' 	=> '1005',
				'conversion' 	=> 0.0416667,
				'bg_color'		=> 'warning',
			],
			[
				'name' 			=> 'Week',
				'uom_class_id' 	=> '1005',
				'conversion' 	=> 7,
				'bg_color'		=> 'warning',
			],
			[
				'name' 			=> 'Month',
				'uom_class_id' 	=> '1005',
				'conversion' 	=> 30,
				'bg_color'		=> 'warning',
			],
		];
		// TODO
		//Uom::insert($uoms_time);

	}
}
