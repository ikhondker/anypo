<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\Rating;

class RatingSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		//Rating::truncate();
		$ratings =  [
			[
				'name' => '*',
			],
			[
				'name' => '**',
			],
			[
				'name' => '***',
			],
			[
				'name' => '****',
			],
			[
				'name' => '****',
			],
		];
		//
		Rating::insert($ratings);
	}
}
