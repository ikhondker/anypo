<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Po;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Project;

use Faker\Generator;

class PoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$faker = app(Generator::class);
	
		$pos = [
				[
					'summary'			=> 'PO#1 for IT - BDT',
					'currency'			=> 'BDT',
					'requestor_id'		=> 1004,
					'buyer_id'			=> 1008,
					'dept_id'			=> 1001,
					'supplier_id'		=> '1001',
					'project_id'		=> '1001',
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 700,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 780,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#2 for IT - BDT',
					'currency'			=> 'BDT',
					'requestor_id'		=> 1004,
					'buyer_id'			=> 1008,
					'dept_id'			=> 1001,
					'supplier_id'		=> '1001',
					'project_id'		=> '1001',
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 800,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 880,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#3 for IT - USD',
					'currency'			=> 'USD',
					'requestor_id'		=> 1005,
					'buyer_id'			=> 1008,
					'dept_id'			=> 1001,
					'supplier_id'		=> '1001',
					'project_id'		=> '1001',
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 800,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 880,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#4 for Sales - BDT',
					'currency'			=> 'BDT',
					'requestor_id'		=> 1006,
					'buyer_id'			=> 1009,
					'dept_id'			=> 1005,
					'supplier_id'		=> '1002',
					'project_id'		=> '1002',
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 500,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 580,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#5 for Sales - BDT',
					'currency'			=> 'BDT',
					'requestor_id'		=> 1006,
					'buyer_id'			=> 1009,
					'dept_id'			=> 1005,
					'supplier_id'		=> '1002',
					'project_id'		=> '1002',
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 600,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 680,
					'fc_currency'		=> 'BDT',
				],
				[
					'summary'			=> 'PO#6 for Sales - USD',
					'currency'			=> 'USD',
					'requestor_id'		=> 1007,
					'buyer_id'			=> 1009,
					'dept_id'			=> 1005,
					'supplier_id'		=> '1002',
					'project_id'		=> '1002',
					'notes'				=> $faker->paragraph,
					'sub_total'			=> 600,
					'tax'				=> 50,
					'gst'				=> 30,
					'amount'			=> 680,
					'fc_currency'		=> 'BDT',
				],
			];

		Po::insert($pos);
	}
}
