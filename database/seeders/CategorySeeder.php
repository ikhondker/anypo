<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Lookup\Category;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//Schema::disableForeignKeyConstraints();
		//Category::truncate();
	   // Schema::enableForeignKeyConstraints();

		$categories =  [
			[
				'id' 	=> 1001,
				'name' 	=> 'General',
			],
			[
				'id' 	=> 1002,
				'name' => 'Tax/VAT/GST',
			],
			[
				'id' 	=> 1003,
				'name' => 'Logistics',
			],
			[
				'id' 	=> 1004,
				'name' => 'Computers',
			],
			[
				'id' 	=> 1005,
				'name' => 'Office Expenses',
			],
			[
				'id' 	=> 1006,
				'name' => 'Cafeteria',
			],
			[
				'id' 	=> 1007,
				'name' => 'Vehicle',
			],
			[
				'id' 	=> 1008,
				'name' => 'Office Equipment',
			],
			// [
			// 	'id' 	=> 1009,
			// 	'name' => 'Petty Cash',
			// ],
	  ];
	  //
	  Category::insert($categories);
	}
}
