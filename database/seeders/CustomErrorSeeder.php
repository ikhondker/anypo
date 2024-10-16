<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Manage\CustomError;

use App\Enum\Tenant\EntityEnum;

class CustomErrorSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		$customErrors = [
			[
				'code'		=> 'E000',
				'entity'	=> EntityEnum::CORE->value,
				'message'	=> 'Un-handled Error!',
			],
			[
				'code'		=> 'E999',
				'entity'	=> EntityEnum::CORE->value,
				'message'	=> 'Unknown Error! Please contact Support.',
			],
			[
				'code'		=> 'E001',
				'entity'	=> EntityEnum::BUDGET->value,
				'message'	=> 'Budget Not Found!',
			],
			[
				'code'		=> 'E002',
				'entity'	=> EntityEnum::DEPTBUDGET->value,
				'message'	=> 'DeptBudget Not Found!',
			],
			[
				'code'		=> 'E003',
				'entity'	=> EntityEnum::DEPTBUDGET->value,
				'message'	=> 'Not Enough DeptBudget Available!',
			],
			[
				'code'		=> 'E004',
				'entity'	=> EntityEnum::PROJECT->value,
				'message'	=> 'Not Enough Project Budget Available!',
			],

			[
				'code'		=> 'E006',
				'entity'	=> EntityEnum::ITEM->value,
				'message'	=> 'Item code already Exists!',
			],
			[
				'code'		=> 'E007',
				'entity'	=> EntityEnum::ITEM->value,
				'message'	=> 'Invalid Category Name!',
			],
			[
				'code'		=> 'E008',
				'entity'	=> EntityEnum::ITEM->value,
				'message'	=> 'Invalid OEM Name!',
			],
			[
				'code'		=> 'E009',
				'entity'	=> EntityEnum::ITEM->value,
				'message'	=> 'Invalid UoM Name!',
			],
			[
				'code'		=> 'E010',
				'entity'	=> EntityEnum::ITEM->value,
				'message'	=> 'Invalid GL_TYPE Name!',
			],
			[
				'code'		=> 'E015',	// Not used Yet
				'entity'	=> EntityEnum::PR->value,
				'message'	=> 'Current Exchange rate not found for this currency! Try after sometime.',
			],
			[
				'code'		=> 'E020',	// Not used Yet
				'entity'	=> EntityEnum::PO->value,
				'message'	=> 'Current Exchange rate not found for this currency! Try after sometime.',
			],

		];
		//
		CustomError::insert($customErrors);
	}
}
