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
	 
		
		
			// Disabled. Not called by reports.run method
		  	$reports =  [
				[
					//'id' 					=> 1010,
					'code' 					=> 'pr',
					'name' 					=> '*Printed PR pdf',
					'summary' 				=> '*Printed Purchase Requisition Report',
					'enable' 				=> false,
				],
				[
					//'id' 					=> 1015,
					'code' 					=> 'po',
					'name' 					=> '*Printed PO pdf',
					'summary' 				=> '*Printed  Purchase Order Report',
					'enable' 				=> false,
				],
			];
			Report::insert($reports);

		  	$reports =  [
				[
					//'id' 					=> 1020,
					'code' 					=> 'prlist',
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
					//'id' 					=> 1025,
					'code' 					=> 'polist',
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
					//'id' 					=> 1030,
					'code' 					=> 'prdetail',
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
					//'id' 					=> 1035,
					'code' 					=> 'podetail',
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
					//'id' 					=> 1040,
					'code' 					=> 'receiptregister',
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
					//'id' 					=> 1045,
					'code' 					=> 'invocieregister',
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
					//'id' 					=> 1050,
					'code' 					=> 'paymentregister',
					'name' 					=> 'Payment Register',
					'summary' 				=> 'Payment Register (For a Date range, by Department)',
					'start_date' 			=> true,
					'start_date_required' 	=> true,
					'end_date' 				=> true,
					'end_date_required' 	=> true,
					'dept_id' 				=> true,
					'dept_id_required' 		=> false,
				],
				[
					//'id' 					=> 1055,
					'code' 					=> 'taxregsiter',
					'name' 					=> 'Tax/GST Register(**)',
					'summary' 				=> 'Tax/GST Register (For a Date range)',
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
				//'id' 					=> 1060,
				'code' 					=> 'projectspend',
				'name' 					=> 'Project Spend Report (**)',
				'summary' 				=> 'Payment Register (For a Date range)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'project_id' 			=> true,
				'project_id_required'	=> true,

			],
	  	];
	  	Report::insert($reports);

		$reports =  [
			[
				//'id' 					=> 1065,
				'code' 					=> 'supplierspend',
				'name' 					=> 'Supplier Spend Report (**)',
				'summary' 				=> 'Payment Register (For a Date range)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'supplier_id' 			=> true,
				'supplier_id_required'	=> true,
			],
	  	];	
	  	Report::insert($reports);

		$reports =  [
			[
				//'id' 					=> 1070,
				'code' 					=> 'aeh',
				'name' 					=> 'Accounting Reports (**)',
				'summary' 				=> 'Accounting Reports (For a Date range)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'supplier_id' 			=> false,
				'supplier_id_required'	=> false,
			],
	  	];
	  	Report::insert($reports);


		  $reports =  [
			[
				//'id' 					=> 1075,
				'code' 					=> 'invoice',
				'name' 					=> 'Printed Invoice Report (TBD)',
				'summary' 				=> 'Printed Invoice Report',
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
			],
			[
				//'id' 					=> 1080,
				'code' 					=> 'payment',
				'name' 					=> 'Printed Payment Report (TBD)',
				'summary' 				=> 'Printed Payment Report',
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
			],
			[
				//'id' 					=> 1085,
				'code' 					=> 'receipt',
				'name' 					=> 'Printed Receipt Report (TBD)',
				'summary' 				=> 'Printed Receipt Report',
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
			],
	  	];
	  	Report::insert($reports);

	}
}
