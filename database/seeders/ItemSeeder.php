<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\Item;


class ItemSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		//Item::factory()->count(10)->create();
	
		$items =  [
			[
				'name'			=> 'Tax',
				'notes'			=> 'Tax',
				'price'			=> 0,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1002,
				'oem_id'		=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'Shipping',
				'notes'			=> 'Shipping',
				'price'			=> 0,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1003,
				'oem_id'		=> 1001,
				'uom_id'		=> 1001,
			],
		
		];

		Item::insert($items);

	}
}
