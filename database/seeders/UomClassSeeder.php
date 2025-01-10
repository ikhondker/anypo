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
		//$colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
		$uomClasses = [
			[
				'id' 		=> 1001,
				'name' 		=> 'Count',
				'bg_color'	=> 'primary',
			],
			[
				'id' 		=> 1002,
				'name' 		=> 'Length',
				'bg_color'	=> 'secondary',
			],
			[
				'id' 		=> 1003,
				'name' 		=> 'Mass',
				'bg_color'	=> 'success',
			],
			[
				'id' 		=> 1004,
				'name' 		=> 'Capacity',
				'bg_color'	=> 'danger',
			],
			[
				'id' 		=> 1005,
				'name' 		=> 'Time',
				'bg_color'	=> 'warning',
			],
			[
				'id' 		=> 1006,
				'name' 		=> 'Temperature',
				'bg_color'	=> 'info',
			],



		];
		//
		UomClass::insert($uomClasses);
	}
}
