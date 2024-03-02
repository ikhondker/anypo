<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Faker\Generator;

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
		$faker = app(Generator::class);


		$budgets =  [
			[
				'fy'				=> '2023',
				'name'				=> 'Budget for 2023',
				'start_date'		=> Carbon::parse('2023-01-01'),
				'end_date'			=> Carbon::parse('2023-12-31'),
				//TODO remove after this
				'notes'				=> $faker->paragraph,
				'amount'			=> 1400000,  
				'amount_pr_booked'	=> $faker->numberBetween(3000,100000),
				'amount_pr_issued'	=> $faker->numberBetween(3000,100000),
				'amount_po_booked'	=> $faker->numberBetween(3000,100000),
				'amount_po_issued'	=> $faker->numberBetween(3000,100000),
				'amount_grs'		=> $faker->numberBetween(3000,100000),
				'amount_invoice'	=> $faker->numberBetween(3000,100000),
				'amount_payment'	=> $faker->numberBetween(3000,100000),
				'count_pr'			=> $faker->numberBetween(3,30),
				'count_po'			=> $faker->numberBetween(3,30),
				'count_grs'			=> $faker->numberBetween(3,30),
				'count_invoice'		=> $faker->numberBetween(3,30),
				'count_payment'		=> $faker->numberBetween(3,30),
			],
			[
				'fy'				=> '2024',
				'name'				=> 'Budget for 2024',
				'start_date'		=> Carbon::parse('2024-01-01'),
				'end_date'			=> Carbon::parse('2024-12-31'),
				//TODO remove after this
				'notes'				=> $faker->paragraph,
				'amount'			=> 700000,  
				'amount_pr_booked'	=> $faker->numberBetween(2000,70000),
				'amount_pr_issued'	=> $faker->numberBetween(2000,70000),
				'amount_po_booked'	=> $faker->numberBetween(2000,70000),
				'amount_po_issued'	=> $faker->numberBetween(2000,70000),
				'amount_grs'		=> $faker->numberBetween(2000,70000),
				'amount_invoice'	=> $faker->numberBetween(2000,70000),
				'amount_payment'	=> $faker->numberBetween(2000,70000),
				'count_pr'			=> $faker->numberBetween(3,20),
				'count_po'			=> $faker->numberBetween(3,20),
				'count_grs'			=> $faker->numberBetween(3,20),
				'count_invoice'		=> $faker->numberBetween(3,20),
				'count_payment'		=> $faker->numberBetween(3,20),
			],

			// [
			// 	'fy'			=> '2024',
			// 	'name'			=> 'Budget for 2024',
			// 	'start_date'	=> Carbon::parse('2024-01-01'),
			// 	'end_date'		=> Carbon::parse('2024-12-31'),
			// 	'amount'		=> 700000,  //TODO remove
			// 	'notes'			=> $faker->paragraph,
			// ],
			// [
			//	 'fy'			=> '2025',
			//	 'name'			=> 'Budget for 2025',
			//	 'start_date'	=> Carbon::parse('2025-01-01'),
			//	 'end_date'		=> Carbon::parse('2025-12-31'),
			// ],
			// [
			//	 'fy'			=> '2026',
			//	 'name'			=> 'Budget for 2026',
			//	 'start_date'	=> Carbon::parse('2026-01-01'),
			//	 'end_date'		=> Carbon::parse('2026-12-31'),
			// ],
			// [
			//	 'fy'			=> '2027',
			//	 'name'			=> 'Budget for 2027',
			//	 'start_date'	=> Carbon::parse('2027-01-01'),
			//	 'end_date'		=> Carbon::parse('2027-12-31'),
			// ],
			// [
			//	 'fy'			=> '2028',
			//	 'name'			=> 'Budget for 2028',
			//	 'start_date'	=> Carbon::parse('2028-01-01'),
			//	 'end_date'		=> Carbon::parse('2028-12-31'),
			// ],
			// [
			//	 'fy'			=> '2029',
			//	 'name'			=> 'Budget for 2029',
			//	 'start_date'	=> Carbon::parse('2029-01-01'),
			//	 'end_date'		=> Carbon::parse('2029-12-31'),
			// ],
			// [
			//	 'fy'			=> '2030',
			//	 'name'			=> 'Budget for 2030',
			//	 'start_date'	=> Carbon::parse('2030-01-01'),
			//	 'end_date'		=> Carbon::parse('2030-12-31'),
			// ],
		];

		Budget::insert($budgets);
	}
}
