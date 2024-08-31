<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Report;
use App\Enum\EntityEnum;

class ReportSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
	 
		$pr =  [
			[
				//'id' 					=> 1010,
				'code' 					=> 'pr',
				'entity' 				=> EntityEnum::PR->value,
				'name' 					=> '*Printed PR pdf',
				'summary' 				=> '*Printed Purchase Requisition Report',
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'enable' 				=> false,
			],
			[
				//'id' 					=> 1020,
				'code' 					=> 'prlist',
				'entity' 				=> EntityEnum::PR->value,
				'name' 					=> 'Requisition Listing',
				'summary' 				=> 'List of Approved Purchase Requisitions (For a Date range, by Department)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'enable' 				=> true,
			],
			[
				//'id' 					=> 1030,
				'code' 					=> 'prdetail',
				'entity' 				=> EntityEnum::PR->value,
				'name' 					=> 'Requisition Detail Report',
				'summary' 				=> 'Approved Purchase Requisition Detail Report (For a Date range, by Department)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'enable' 				=> true,
			],
		];
		Report::insert($pr);

		$po =  [
			[
				//'id' 					=> 1015,
				'code' 					=> 'po',
				'entity' 				=> EntityEnum::PO->value,
				'name' 					=> '*Printed PO pdf',
				'summary' 				=> '*Printed  Purchase Order Report',
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'enable' 				=> false,
			],
			[
				//'id' 					=> 1025,
				'code' 					=> 'polist',
				'entity' 				=> EntityEnum::PO->value,
				'name' 					=> 'Purchase Order Listing',
				'summary' 				=> 'List of Approved Purchase Orders (For a Date range, by Department)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'enable' 				=> true,
			],
			[
				//'id' 					=> 1035,
				'code' 					=> 'podetail',
				'entity' 				=> EntityEnum::PO->value,
				'name' 					=> 'Purchase Order Detail Report',
				'summary' 				=> 'Approved Purchase Order Detail Report (For a Date range, by Department)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'enable' 				=> true,
			],
		];
		Report::insert($po);

		$receipt =  [
			[
				//'id' 					=> 1085,
				'code' 					=> 'receipt',
				'entity' 				=> EntityEnum::RECEIPT->value,
				'name' 					=> 'Printed Receipt Report (TBD)',
				'summary' 				=> 'Printed Receipt Report',
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'enable' 				=> false,
			],
			[
				//'id' 					=> 1040,
				'code' 					=> 'receiptregister',
				'entity' 				=> EntityEnum::RECEIPT->value,
				'name' 					=> 'Goods Receipt Register',
				'summary' 				=> 'Goods Receipt Detail Report (For a Date range, by Department)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'enable' 				=> true,
			],
	  	];
	  	Report::insert($receipt);

		$invoice =  [
			[
				//'id' 					=> 1075,
				'code' 					=> 'invoice',
				'entity' 				=> EntityEnum::INVOICE->value,
				'name' 					=> 'Printed Invoice Report (TBD)',
				'summary' 				=> 'Printed Invoice Report',
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'enable' 				=> false,
			],
			[
				//'id' 					=> 1045,
				'code' 					=> 'invocieregister',
				'entity' 				=> EntityEnum::INVOICE->value,
				'name' 					=> 'Invoice Register',
				'summary' 				=> 'Invoice Register (For a Date range, by Department)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'enable' 				=> true,
			],
	  	];
	  	Report::insert($invoice);


		$payment =  [
			[
				//'id' 					=> 1080,
				'code' 					=> 'payment',
				'entity' 				=> EntityEnum::PAYMENT->value,
				'name' 					=> 'Printed Payment Report (TBD)',
				'summary' 				=> 'Printed Payment Report',
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'enable' 				=> false,
			],
			[
				//'id' 					=> 1050,
				'code' 					=> 'paymentregister',
				'entity' 				=> EntityEnum::PAYMENT->value,
				'name' 					=> 'Payment Register',
				'summary' 				=> 'Payment Register (For a Date range, by Department)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'enable' 				=> true,
			],
	  	];
	  	Report::insert($payment);


		  $tax =  [
			[
				//'id' 					=> 1055,
				'code' 					=> 'taxregsiter',
				'entity' 				=> EntityEnum::TAX->value,
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
	  	Report::insert($tax);

		  $projects =  [
			[
				//'id' 					=> 1060,
				'code' 					=> 'projectspend',
				'entity' 				=> EntityEnum::PROJECT->value,
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
	  	Report::insert($projects);


		  $supplier =  [
			[
				//'id' 					=> 1065,
				'code' 					=> 'supplierspend',
				'entity' 				=> EntityEnum::SUPPLIER->value,
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
	  	Report::insert($supplier);


		  $aeh =  [
			[
				//'id' 					=> 1070,
				'code' 					=> 'aeh',
				'entity' 				=> EntityEnum::AEH->value,
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
	  	Report::insert($aeh);

	}
}
