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

		$pr = [
			[
				//'id' 					=> 1010,
				'code' 					=> 'pr',
				'entity' 				=> EntityEnum::PR->value,
				'name' 					=> 'Purchase Requisition',
				'summary' 				=> 'Printed Purchase Requisition Report',
				'article_id_required' 	=> true,
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 10,
				'order_by2' 			=> 10,
			],
			[
				//'id' 					=> 1020,
				'code' 					=> 'prlist',
				'entity' 				=> EntityEnum::PR->value,
				'name' 					=> 'Requisition Listing',
				'summary' 				=> 'List of Approved Purchase Requisitions (For a Date range, by Department)',
				'article_id_required' 	=> false,
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 10,
				'order_by2' 			=> 20,

			],
			[
				//'id' 					=> 1030,
				'code' 					=> 'prllist',
				'entity' 				=> EntityEnum::PR->value,
				'name' 					=> 'Requisition Line Listing',
				'summary' 				=> 'Approved Purchase Requisition Lines Report (For a Date range, by Department)',
				'article_id_required' 	=> false,
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 10,
				'order_by2' 			=> 30,

			],
		];
		Report::insert($pr);

		$po = [
			[
				//'id' 					=> 1015,
				'code' 					=> 'po',
				'entity' 				=> EntityEnum::PO->value,
				'name' 					=> 'Purchase Order',
				'summary' 				=> 'Printed Purchase Order Report',
				'article_id_required' 	=> true,
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 20,
				'order_by2' 			=> 10,
			],
			[
				//'id' 					=> 1025,
				'code' 					=> 'polist',
				'entity' 				=> EntityEnum::PO->value,
				'name' 					=> 'Purchase Order Listing',
				'summary' 				=> 'List of Approved Purchase Orders (For a Date range, by Department)',
				'article_id_required' 	=> false,
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 20,
				'order_by2' 			=> 20,
			],
			[
				//'id' 					=> 1035,
				'code' 					=> 'pollist',
				'entity' 				=> EntityEnum::PO->value,
				'name' 					=> 'Purchase Order Lines Listing',
				'summary' 				=> 'Approved Purchase Order Lines Report (For a Date range, by Department)',
				'article_id_required' 	=> false,
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 20,
				'order_by2' 			=> 30,
			],
		];
		Report::insert($po);

		$invoice = [
			[
				//'id' 					=> 1075,
				'code' 					=> 'invoice',
				'entity' 				=> EntityEnum::INVOICE->value,
				'name' 					=> 'Invoice Report',
				'summary' 				=> 'Printed Invoice Report',
				'article_id_required' 	=> true,
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 30,
				'order_by2' 			=> 10,
			],
			[
				//'id' 					=> 1045,
				'code' 					=> 'invoicelist',
				'entity' 				=> EntityEnum::INVOICE->value,
				'name' 					=> 'Invoice Register',
				'summary' 				=> 'Invoice Register (For a Date range, by Department)',
				'article_id_required' 	=> false,
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 30,
				'order_by2' 			=> 20,
			],
		];
		Report::insert($invoice);

		$payment = [
			[
				//'id' 					=> 1080,
				'code' 					=> 'payment',
				'entity' 				=> EntityEnum::PAYMENT->value,
				'name' 					=> 'Payment Report',
				'summary' 				=> 'Printed Payment Report',
				'article_id_required' 	=> true,
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 40,
				'order_by2' 			=> 10,
			],
			[
				//'id' 					=> 1050,
				'code' 					=> 'paymentlist',
				'entity' 				=> EntityEnum::PAYMENT->value,
				'name' 					=> 'Payment Register',
				'summary' 				=> 'Payment Register (For a Date range, by Department)',
				'article_id_required' 	=> false,
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 40,
				'order_by2' 			=> 20,
			],
		];
		Report::insert($payment);

		$receipt = [
			[
				//'id' 					=> 1085,
				'code' 					=> 'receipt',
				'entity' 				=> EntityEnum::RECEIPT->value,
				'name' 					=> 'Goods Receipt Report',
				'summary' 				=> 'Printed Goods Receipt Report',
				'article_id_required' 	=> true,
				'start_date' 			=> false,
				'start_date_required' 	=> false,
				'end_date' 				=> false,
				'end_date_required' 	=> false,
				'dept_id' 				=> false,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 50,
				'order_by2' 			=> 10,
			],
			[
				//'id' 					=> 1040,
				'code' 					=> 'receiptlist',
				'entity' 				=> EntityEnum::RECEIPT->value,
				'name' 					=> 'Goods Receipt Register',
				'summary' 				=> 'Goods Receipt detail Report (For a Date range, by Department)',
				'article_id_required' 	=> false,
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 50,
				'order_by2' 			=> 20,
			],
		];
		Report::insert($receipt);

		$project = [
			[
				//'id' 					=> 1060,
				'code' 					=> 'projectspend',
				'entity' 				=> EntityEnum::PROJECT->value,
				'name' 					=> 'Project Spend Report',
				'summary' 				=> 'Purchase Order Issued for a Project (For a Date range, for a Project)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'project_id' 			=> true,
				'project_id_required'	=> true,
				'order_by1' 			=> 60,
				'order_by2' 			=> 10,
			],
		];
		Report::insert($project);


		$supplier = [
			[
				//'id' 					=> 1065,
				'code' 					=> 'supplierspend',
				'entity' 				=> EntityEnum::SUPPLIER->value,
				'name' 					=> 'Supplier Spend Report',
				'summary' 				=> 'Purchase Order Issued to a Supplier (For a Date range, for a Supplier)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'supplier_id' 			=> true,
				'supplier_id_required'	=> true,
				'order_by1' 			=> 70,
				'order_by2' 			=> 10,

			],
		];
		Report::insert($supplier);


		$tax = [
			[
				//'id' 					=> 1055,
				'code' 					=> 'taxregister',
				'entity' 				=> EntityEnum::TAX->value,
				'name' 					=> 'Tax/GST Register',
				'summary' 				=> 'Tax/GST Register (For a Date range)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'dept_id' 				=> true,
				'dept_id_required' 		=> false,
				'order_by1' 			=> 80,
				'order_by2' 			=> 10,

			],
		];
		Report::insert($tax);

		$aeh = [
			[
				//'id' 					=> 1070,
				'code' 					=> 'aellist',
				'entity' 				=> EntityEnum::AEH->value,
				'name' 					=> 'Accounting Reports',
				'summary' 				=> 'Accounting Reports (For a Date range)',
				'start_date' 			=> true,
				'start_date_required' 	=> true,
				'end_date' 				=> true,
				'end_date_required' 	=> true,
				'supplier_id' 			=> false,
				'supplier_id_required'	=> false,
				'order_by1' 			=> 90,
				'order_by2' 			=> 10,
			],
		];
		Report::insert($aeh);

	}
}
