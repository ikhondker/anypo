<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Export;
use App\Enum\Tenant\EntityEnum;



class ExportSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$exports = [
			[
				'entity' 				=> EntityEnum::PR->value,
				'name' 					=> 'Purchase Requisition',
			],
            [
				'entity' 				=> EntityEnum::PRL->value,
				'name' 					=> 'Purchase Requisition Line',
			],
			[
				'entity' 				=> EntityEnum::PO->value,
				'name' 					=> 'Purchase Order',
			],
			[
				'entity' 				=> EntityEnum::POL->value,
				'name' 					=> 'Purchase Order Line',
			],
            [
				'entity' 				=> EntityEnum::RECEIPT->value,
				'name' 					=> 'Receipts',
			],
			[
				'entity' 				=> EntityEnum::INVOICE->value,
				'name' 					=> 'Invoice',
			],
            [
				'entity' 				=> EntityEnum::INVOICELINE->value,
				'name' 					=> 'Invoice Line',
			],
			[
				'entity' 				=> EntityEnum::PAYMENT->value,
				'name' 					=> 'Payment',
			],
			[
				'entity' 				=> EntityEnum::BUDGET->value,
				'name' 					=> 'Budget',
			],
			[
				'entity' 				=> EntityEnum::DEPTBUDGET->value,
				'name' 					=> 'Dept Budget',
			],
			[
				'entity' 				=> EntityEnum::AEL->value,
				'name' 					=> 'Accounting Line',
			],


		];
		Export::insert($exports);
	}
}
