<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Report;

class ReportSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$reports =  [
			[
				'id' 	=> 1001,
				'name' 	=> 'Test Reports',
			],
			[
				'id' 	=> 1002,
				'name' => '*Printed PR pdf',
			],
			[
				'id' 	=> 1003,
				'name' => '*Printed PO pdf',
			],
			[
				'id' 	=> 1004,
				'name' => 'Purchase Requisition Details Report*',
			],
			[
				'id' 	=> 1005,
				'name' => 'Purchase Order Details Report',
			],
			[
				'id' 	=> 1006,
				'name' => 'Goods Receipt Details Report',
			],
			[
				'id' 	=> 1007,
				'name' => 'Payment Details Report',
			],
			[
				'id' 	=> 1008,
				'name' => 'Budget Utilization Report',
			],
			[
				'id' 	=> 1009,
				'name' => 'Dept Budget Utilization Report',
			],
			[
				'id' 	=> 1010,
				'name' => 'Project Spend Report (**)',
			],
			[
				'id' 	=> 1011,
				'name' => 'Supplier Spend Report (**)',
			],
	  	];
	  
		  	$reports =  [
				[
					'id' 					=> 1002,
					'name' 					=> '*Printed PR pdf',
					'summary' 				=> '*Printed PR pdf',
				],
				[
					'id' 					=> 1003,
					'name' 					=> '*Printed PO pdf',
					'summary' 				=> 'Approved Purchase Requisition Detail Report (For a Date range, by Department)',
				],
			];
			Report::insert($reports);

		  	$reports =  [
				[
					'id' 					=> x1004,
					'name' 					=> 'Requisition Listing',
					'summary' 				=> 'List of Approved Purchase Requisitions (For a Date range, by Department)',
					'start_date' 			=> true,
					'start_date_required' 	=> true,
					'end_date' 				=> true,
					'end_date_required' 	=> true,
					'dept_id' 				=> true,
					'dept_id_required' 		=> false,
				],
				[
					'id' 					=> x1005,
					'name' 					=> 'Purchase Order Listing',
					'summary' 				=> 'List of Approved Purchase Orders (For a Date range, by Department)',
					'start_date' 			=> true,
					'start_date_required' 	=> true,
					'end_date' 				=> true,
					'end_date_required' 	=> true,
					'dept_id' 				=> true,
					'dept_id_required' 		=> false,
				],

				[
					'id' 					=> 1004,
					'name' 					=> 'Requisition Detail Report',
					'summary' 				=> 'Approved Purchase Requisition Detail Report (For a Date range, by Department)',
					'start_date' 			=> true,
					'start_date_required' 	=> true,
					'end_date' 				=> true,
					'end_date_required' 	=> true,
					'dept_id' 				=> true,
					'dept_id_required' 		=> false,
				],
				[
					'id' 					=> 1005,
					'name' 					=> 'Purchase Order Detail Report',
					'summary' 				=> 'Approved Purchase Order Detail Report (For a Date range, by Department)',
					'start_date' 			=> true,
					'start_date_required' 	=> true,
					'end_date' 				=> true,
					'end_date_required' 	=> true,
					'dept_id' 				=> true,
					'dept_id_required' 		=> false,
				],
				[
					'id' 					=> 1006,
					'name' 					=> 'Goods Receipt Register',
					'summary' 				=> 'Goods Receipt Detail Report (For a Date range, by Department)',
					'start_date' 			=> true,
					'start_date_required' 	=> true,
					'end_date' 				=> true,
					'end_date_required' 	=> true,
					'dept_id' 				=> true,
					'dept_id_required' 		=> false,
				],
				[
					'id' 					=> 1007,
					'name' 					=> 'Invoice Register',
					'summary' 				=> 'Invoice Register (For a Date range, by Department)',
					'start_date' 			=> true,
					'start_date_required' 	=> true,
					'end_date' 				=> true,
					'end_date_required' 	=> true,
					'dept_id' 				=> true,
					'dept_id_required' 		=> false,
				],
				[
					'id' 					=> 1008,
					'name' 					=> 'Payment Register',
					'summary' 				=> 'Payment Register (For a Date range, by Department)',
					'start_date' 			=> true,
					'start_date_required' 	=> true,
					'end_date' 				=> true,
					'end_date_required' 	=> true,
					'dept_id' 				=> true,
					'dept_id_required' 		=> false,
				],
			];
		Report::insert($reports);


		$reports =  [
			[
				'id' 					=> 1009,
				'name' 					=> 'Tax/GST Register(**)',
				'summary' 				=> 'Tax/GST Register (For a Date range)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
			],
			[
				'id' 					=> 1010,
				'name' 					=> 'Project Spend Report (**)',
				'summary' 				=> 'Payment Register (For a Date range)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
			],
			[
				'id' 					=> 1011,
				'name' 					=> 'Supplier Spend Report (**)',
				'summary' 				=> 'Payment Register (For a Date range)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
			],
	  	];
	  	Report::insert($reports);
	}
}
