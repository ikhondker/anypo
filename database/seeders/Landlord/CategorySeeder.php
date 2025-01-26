<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\Category;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$categories = [
			[
				'id'	=> '1001',
				'name' => 'General',
			],
            [
				'id'	=> '1002',
				'name' => 'Setup',
			],
			[
				'id'	=> '1003',
				'name' => 'User Issues',
			],
			[
				'id'	=> '1004',
				'name' => 'Billing Issue',
			],
			[
				'id'	=> '1005',
				'name' => 'Add-on Issues',
			],
			[
				'id'	=> '1006',
				'name' => 'Technical Issues',
			],
		];
		//
		Category::insert($categories);
	}
}
