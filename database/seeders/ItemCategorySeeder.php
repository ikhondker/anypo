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

		//$colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
		$itemCategories = [
			[
				'id' 		=> 1001,
				'name' 		=> 'Seeded Category',
				'bg_color'	=> 'primary',
			],
			[
				'id' 		=> 1002,
				'name' 		=> 'Tax/VAT/GST',
				'bg_color'	=> 'secondary',
			],
			[
				'id' 		=> 1003,
				'name' 		=> 'Logistics',
				'bg_color'	=> 'success',
			],
			[
				'id' 		=> 1004,
				'name' 		=> 'Computers',
				'bg_color'	=> 'danger',
			],
			[
				'id' 		=> 1005,
				'name' 		=> 'Office Expenses',
				'bg_color'	=> 'warning',
			],
			[
				'id' 		=> 1006,
				'name' 		=> 'Cafeteria',
				'bg_color'	=> 'info',
			],
			[
				'id' 		=> 1007,
				'name' 		=> 'Vehicle',
				'bg_color'	=> 'primary',
			],
			[
				'id' 		=> 1008,
				'name' 		=> 'Office Equipment',
				'bg_color'	=> 'secondary',
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
