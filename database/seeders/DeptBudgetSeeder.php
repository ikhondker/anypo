<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Faker\Generator;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;

class DeptBudgetSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		//Schema::disableForeignKeyConstraints();
		//DeptBudget::truncate();
		//Schema::enableForeignKeyConstraints();

		$faker = app(Generator::class);

		$deptBudget24 =  [
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1002',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
			],
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1003',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
			],
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1004',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
			],
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1005',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
			],
			// [
			// 	'budget_id'			=> '1001',
			// 	'dept_id'			=> '1006',
			// 	'amount'			=> 100000,
			// 	'notes'				=> $faker->paragraph,
			// ],
			// [
			// 	'budget_id'			=> '1001',
			// 	'dept_id'			=> '1007',
			// 	'amount'			=> 100000,
			// 	'notes'				=> $faker->paragraph,
			// ],
		  ];
		
		  $deptBudget23 =  [
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1002',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
			],
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1003',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
			],
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1004',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
			],
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1005',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
			],
			// [
			// 	'budget_id'			=> '1002',
			// 	'dept_id'			=> '1006',
			// 	'amount'			=> 100000,
			// 	'notes'				=> $faker->paragraph,
			// ],
			// [
			// 	'budget_id'			=> '1002',
			// 	'dept_id'			=> '1007',
			// 	'amount'			=> 100000,
			// 	'notes'				=> $faker->paragraph,
			// ],
		  ];
				
		$deptBudget23Dummy =  [
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1002',
				'amount'			=> 200000,
				'notes'				=> $faker->paragraph,
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
			],
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1003',
				'amount'			=> 200000,
				'notes'				=> $faker->paragraph,
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
			],
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1004',
				'amount'			=> 200000,
				'notes'				=> $faker->paragraph,
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
			],
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1005',
				'amount'			=> 200000,
				'notes'				=> $faker->paragraph,
				'amount_pr_booked'	=> $faker->numberBetween(3000,100000),
				'amount_pr'	=> $faker->numberBetween(3000,100000),
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
			],
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1006',
				'amount'			=> 200000,
				'notes'				=> $faker->paragraph,
				'amount_pr_booked'	=> $faker->numberBetween(3000,100000),
				'amount_pr'	=> $faker->numberBetween(3000,100000),
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
			],
			[
				'budget_id'			=> '1001',
				'dept_id'			=> '1007',
				'amount'			=> 200000,
				'notes'				=> $faker->paragraph,
				'amount_pr_booked'	=> $faker->numberBetween(3000,100000),
				'amount_pr'	=> $faker->numberBetween(3000,100000),
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
			],
		  ];

		  $deptBudget24Dummy =  [
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1001',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
				'amount_pr_booked'	=> $faker->numberBetween(3000,100000),
				'amount_pr'	=> $faker->numberBetween(3000,100000),
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
			],
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1002',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
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
			],
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1003',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
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
			],
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1004',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
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
			],
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1005',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
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
			],
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1006',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
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
			],
			[
				'budget_id'			=> '1002',
				'dept_id'			=> '1007',
				'amount'			=> 100000,
				'notes'				=> $faker->paragraph,
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
			],
		  ];

		
		DeptBudget::insert($deptBudget23);
		DeptBudget::insert($deptBudget24);
		//DeptBudget::insert($deptBudget23Dummy);
		//DeptBudget::insert($deptBudget24Dummy);

	}
}
