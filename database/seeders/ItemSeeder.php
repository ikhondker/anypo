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
		//TODO change item code to laptop/tables/mobile etc..
		$items =  [
			[
				'name'			=> 'Tax',
				'notes'			=> 'Tax',
				'price'			=> 0,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1002,
				'oem_id'		=> 1001,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'GST',
				'notes'			=> 'GRT',
				'price'			=> 0,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1002,
				'oem_id'		=> 1001,
				'uom_class_id'	=> 1001,
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
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'Laptop (Lenovo)',
				'notes'			=> 'Laptop (Lenovo)',
				'price'			=> 789,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1004,
				'oem_id'		=> 1005,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'Laptop (ASUS)',
				'notes'			=> 'Laptop (ASUS)',
				'price'			=> 799,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1004,
				'oem_id'		=> 1004,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'MacBook Air Laptop',
				'notes'			=> 'MacBook Air Laptop',
				'price'			=> 1049,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1004,
				'oem_id'		=> 1003,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'Laptop (Dell)',
				'notes'			=> 'Laptop (Dell)',
				'price'			=> 915,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1004,
				'oem_id'		=> 1006,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
		];

		Item::insert($items);

	}
}
