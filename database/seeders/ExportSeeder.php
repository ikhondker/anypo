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
				'entity' 				=> EntityEnum::PO->value,
				'name' 					=> 'Purchase Requisition',
			],
			[
				'entity' 				=> EntityEnum::RECEIPT->value,
				'name' 					=> 'Purchase Requisition',
			],
			[
				'entity' 				=> EntityEnum::INVOICE->value,
				'name' 					=> 'Purchase Requisition',
			],
			[
				'entity' 				=> EntityEnum::PAYMENT->value,
				'name' 					=> 'Purchase Requisition',
			],
			[
				'entity' 				=> EntityEnum::BUDGET->value,
				'name' 					=> 'Purchase Requisition',
			],
			[
				'entity' 				=> EntityEnum::DEPTBUDGET->value,
				'name' 					=> 'Purchase Requisition',
			],

		];
		Export::insert($exports);
	}
}
