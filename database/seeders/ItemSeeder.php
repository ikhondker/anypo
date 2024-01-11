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
				'name'			=> 'Lenovo ThinkPad E16 Business Laptop',
				'notes'			=> 'Lenovo ThinkPad E16 Business Laptop',
				'price'			=> 789,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1004,
				'oem_id'		=> 1005,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'ASUS Zenbook 15 Laptop,',
				'notes'			=> 'ASUS Zenbook 15 Laptop,',
				'price'			=> 799,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1004,
				'oem_id'		=> 1004,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'Apple 2023 15.3-Inch MacBook Air Laptop',
				'notes'			=> 'Apple 2023 15.3-Inch MacBook Air Laptop',
				'price'			=> 1049,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1003,
				'oem_id'		=> 1003,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'ASUS Zenbook S 13 OLED Ultra Laptop',
				'notes'			=> 'ASUS Zenbook S 13 OLED Ultra Laptop',
				'price'			=> 1349,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1004,
				'oem_id'		=> 1004,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'Dell Inspiron 16 5630 Laptop ',
				'notes'			=> 'Dell Inspiron 16 5630 Laptop ',
				'price'			=> 915,
				'stock'			=> 99999999,
				'reorder'		=> 99999999,
				'category_id'	=> 1004,
				'oem_id'		=> 1006,
				'uom_class_id'	=> 1001,
				'uom_id'		=> 1001,
			],
			[
				'name'			=> 'Dell Inspiron 14 Plus 7420 Laptop',
				'notes'			=> 'Dell Inspiron 14 Plus 7420 Laptop',
				'price'			=> 810,
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
