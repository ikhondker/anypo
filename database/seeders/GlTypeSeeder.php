<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\GlType;

class GlTypeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		//GlType::truncate();
		//Schema::enableForeignKeyConstraints();

		$gl_types =  [
			[
				'code'		=> 'E',
				'name'		=> 'Expense',
			],
			[
				'code'		=> 'A',
				'name'		=> 'Assets',
			],
			[
				'code'		=> 'I',
				'name'		=> 'Inventory',
			],
		];
		//
		GLType::insert($gl_types);
	}
}
