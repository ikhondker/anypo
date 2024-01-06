<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Budget;
use Carbon\Carbon;

class BudgetSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		
		//Schema::disableForeignKeyConstraints();
		//Budget::truncate();
		//Schema::enableForeignKeyConstraints();

		$budgets =  [
			// [
			// 	'fy'            => '2023',
			// 	'name'          => 'Budget for 2023',
			// 	'start_date'    => Carbon::parse('2023-01-01'),
			// 	'end_date'      => Carbon::parse('2023-12-31'),
			// 	'amount'        => 6000000,  //TODO remove
			// ],
			[
			    'fy'			=> '2024',
			    'name'			=> 'Budget for 2024',
			    'start_date'	=> Carbon::parse('2024-01-01'),
			    'end_date'		=> Carbon::parse('2024-12-31'),
				'amount'		=> 7000,  //TODO remove
			],
			// [
			//     'fy'            => '2025',
			//     'name'          => 'Budget for 2025',
			//     'start_date'    => Carbon::parse('2025-01-01'),
			//     'end_date'      => Carbon::parse('2025-12-31'),
			// ],
			// [
			//     'fy'            => '2026',
			//     'name'          => 'Budget for 2026',
			//     'start_date'    => Carbon::parse('2026-01-01'),
			//     'end_date'      => Carbon::parse('2026-12-31'),
			// ],
			// [
			//     'fy'            => '2027',
			//     'name'          => 'Budget for 2027',
			//     'start_date'    => Carbon::parse('2027-01-01'),
			//     'end_date'      => Carbon::parse('2027-12-31'),
			// ],
			// [
			//     'fy'            => '2028',
			//     'name'          => 'Budget for 2028',
			//     'start_date'    => Carbon::parse('2028-01-01'),
			//     'end_date'      => Carbon::parse('2028-12-31'),
			// ],
			// [
			//     'fy'            => '2029',
			//     'name'          => 'Budget for 2029',
			//     'start_date'    => Carbon::parse('2029-01-01'),
			//     'end_date'      => Carbon::parse('2029-12-31'),
			// ],
			// [
			//     'fy'            => '2030',
			//     'name'          => 'Budget for 2030',
			//     'start_date'    => Carbon::parse('2030-01-01'),
			//     'end_date'      => Carbon::parse('2030-12-31'),
			// ],
		];

		Budget::insert($budgets);
	}
}
