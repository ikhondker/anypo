<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\ItemCategory;

class ItemCategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		$itemCategories = [
			[
				'id' 	=> 1001,
				'name' 	=> 'Seeded Category',
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
		ItemCategory::insert($itemCategories);
	}
}
