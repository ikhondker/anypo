<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\BankAccount;

class BankAccountSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$bank_accounts =  [
			[
				'id'			=> '1001',
				'ac_name'		=> 'DB-STD-756.1234.5678.96',
				'ac_number'		=> '756.1234.5678.96',
			],
			[
				'id'			=> '1002',
				'ac_name'		=> 'DB-STD-756.1234.5678.97',
				'ac_number'		=> '756.1234.5678.97',
			],
			[
				'id'			=> '1003',
				'ac_name'		=> 'VISA-756.1234.5678.97',
				'ac_number'		=> '756.1234.5678.97',
			],
			[
				'id'			=> '1004',
				'ac_name'		=> 'VISA Credit Card',
				'ac_number'		=> '756.****.5678.97',
			],
		];

		BankAccount::insert($bank_accounts);
	}
}
