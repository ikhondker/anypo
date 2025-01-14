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

		$dummyBudgets = [
			[
				'fy'				=> '2023',
				'name'				=> 'Budget for 2023',
				'start_date'		=> Carbon::parse('2023-01-01'),
				'end_date'			=> Carbon::parse('2023-12-31'),
				'notes'				=> $faker->paragraph,
				'amount'			=> 140000,
				'amount_pr_booked'	=> $faker->numberBetween(3000,100000),
				'amount_pr'			=> $faker->numberBetween(3000,100000),
				'amount_po_booked'	=> $faker->numberBetween(3000,100000),
				'amount_po'			=> $faker->numberBetween(3000,100000),
				'amount_grs'		=> $faker->numberBetween(3000,100000),
				'amount_invoice'	=> $faker->numberBetween(3000,100000),
				'amount_payment'	=> $faker->numberBetween(3000,100000),
				'count_pr'			=> $faker->numberBetween(3,30),
				'count_po'			=> $faker->numberBetween(3,30),
				'count_grs'			=> $faker->numberBetween(3,30),
				'count_invoice'		=> $faker->numberBetween(3,30),
				'count_payment'		=> $faker->numberBetween(3,30),
                'bg_color'		    => 'primary',
			],
			[
				'fy'				=> '2024',
				'name'				=> 'Budget for 2024',
				'start_date'		=> Carbon::parse('2024-01-01'),
				'end_date'			=> Carbon::parse('2024-12-31'),
				'notes'				=> $faker->paragraph,
				'amount'			=> 700000,
				'amount_pr_booked'	=> $faker->numberBetween(2000,70000),
				'amount_pr'			=> $faker->numberBetween(2000,70000),
				'amount_po_booked'	=> $faker->numberBetween(2000,70000),
				'amount_po'			=> $faker->numberBetween(2000,70000),
				'amount_grs'		=> $faker->numberBetween(2000,70000),
				'amount_invoice'	=> $faker->numberBetween(2000,70000),
				'amount_payment'	=> $faker->numberBetween(2000,70000),
				'count_pr'			=> $faker->numberBetween(3,20),
				'count_po'			=> $faker->numberBetween(3,20),
				'count_grs'			=> $faker->numberBetween(3,20),
				'count_invoice'		=> $faker->numberBetween(3,20),
				'count_payment'		=> $faker->numberBetween(3,20),
                'bg_color'		    => 'secondary',
			],


		];

		$budgets23 = [
			[
				'fy'			=> '2023',
				'name'			=> 'Budget for 2023',
				'start_date'	=> Carbon::parse('2023-01-01'),
				'end_date'		=> Carbon::parse('2023-12-31'),
				'amount'		=> 400000, //TODO remove
                'notes'			=> $faker->paragraph,
                'bg_color'		=> 'info',
			],
		];

		$budgets24 = [
			[
				'fy'			=> '2024',
				'name'			=> 'Budget for 2024',
				'start_date'	=> Carbon::parse('2024-01-01'),
				'end_date'		=> Carbon::parse('2024-12-31'),
				'amount'		=> 400000, //TODO remove
                'notes'			=> $faker->paragraph,
                'bg_color'		=> 'secondary',
			],
		];

        $budgets25 = [
			[
				'fy'			=> '2025',
				'name'			=> 'Budget for 2025',
				'start_date'	=> Carbon::parse('2025-01-01'),
				'end_date'		=> Carbon::parse('2025-12-31'),
				'amount'		=> 400000, //TODO remove
                'notes'			=> $faker->paragraph,
                'bg_color'		=> 'primary',
			],
		];


		//Budget::insert($dummyBudgets);
		Budget::insert($budgets23);
		Budget::insert($budgets24);
        Budget::insert($budgets25);
	}
}
