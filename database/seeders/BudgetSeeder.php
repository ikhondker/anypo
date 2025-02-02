<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Faker\Generator;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Lookup\Dept;

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

		// get year
		$currentYear = date('Y');
		Log::debug('tenenet.BudgetSeeder.run currentYear =' . $currentYear);
		//TODO
		// count dept
		$count_dept = Dept::count();
		Log::debug('tenenet.BudgetSeeder.run count_dept =' . $count_dept);
		// create budge for that year
		// get CY budget id
		// loop and creare dept budge for that year
		$budgetCY = [
			[
				'fy'			=> '2025',
				'name'			=> 'Budget for 2025',
				'start_date'	=> Carbon::parse('2025-01-01'),
				'end_date'		=> Carbon::parse('2025-12-31'),
				'amount'		=> 400000, //TODO remove
				'notes'			=> 'Budget for 2025',
				'bg_color'		=> 'primary',
			],
		];

		// $projects = Project::orderBy('id', 'ASC')->get();
		// foreach ($projects as $project) {
			// $pr = new PrController();
			// $pr1001 = Pr::where('id', '1001')->firstOrFail();
			// $result = $pr->recalculate($pr1001);
			// $pr1002 = Pr::where('id', '1002')->firstOrFail();
			// $result = $pr->recalculate($pr1002);
			// $pr1003 = Pr::where('id', '1003')->firstOrFail();
			// $result = $pr->recalculate($pr1003);

			// Approve 1 pr
			// $pr1001->auth_status	= AuthStatusEnum::APPROVED->value;
			// $pr1001->auth_date		= date('Y-m-d H:i:s');
			// $pr1001->auth_user_id	= $sys->id;
			//$pr1001->save();
		//}


		//Budget::insert($budgets25);
	}
}
