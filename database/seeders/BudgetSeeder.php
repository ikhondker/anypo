<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Faker\Generator;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Lookup\Dept;

use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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

		// set dept budget amount
		$amount = 100000;

		// get year
		$currentYear = date('Y');
		Log::debug('tenant.BudgetSeeder.run currentYear =' . $currentYear);
		//TODO
		// count dept
		$count_dept = Dept::where('enable',true)->count();
		Log::debug('tenant.BudgetSeeder.run count_dept =' . $count_dept);
		// create budge for that year
		$budget = Budget::create([
			'fy'			=> $currentYear,
			'name'			=> 'Budget for '.$currentYear. ' (Seeded)',
			'start_date'	=> Carbon::parse($currentYear.'-01-01'),
			'end_date'		=> Carbon::parse($currentYear.'-12-31'),
			'amount'		=> $amount * $count_dept,
			'notes'			=> 'Budget for '.$currentYear. '.  Seeded. Please edit as necessary.',
			'bg_color'		=> 'primary',
		]);
		Log::debug('tenant.BudgetSeeder.run created budget_id =' . $budget->id);


		// insert dept_budgets lines
		$sql= "INSERT INTO dept_budgets(
			budget_id, dept_id, amount, notes)
		SELECT ".
			$budget->id.",id, ".$amount.", 'Seeded. Please edit as necessary.'
			FROM depts
			WHERE enable = 1";
		//Log::debug('tenant.BudgetSeeder.run created sql =' . $sql);
		DB::INSERT($sql);

        Log::debug('tenant.BudgetSeeder.run inserted into dept_budgets table.');

	}
}
