<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Admin\Category;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$categories =  [
			[
				'name' => 'General',
			],
			[
				'name' => 'User Issues',
			],
			[
				'name' => 'Billing Issue',
			],
			[
				'name' => 'Add-on Issues',
			],
		  ];
		//
		Category::insert($categories);
	}
}
