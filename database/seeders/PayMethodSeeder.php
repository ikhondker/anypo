<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\PayMethod;
use Faker\Generator;

class PayMethodSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		PayMethod::truncate();

		$faker = app(Generator::class);

		$bank_accounts =  [
			[
				'id'				=> '1001',
				'name'				=> 'DB-STD-756.1234.5678.96',
				'pay_method_number' => '756.1234.5678.96',
			],
			[
				'id'				=> '1002',
				'name'				=> 'DB-STD-756.1234.5678.97',
				'pay_method_number' => '756.1234.5678.97',
			],
			[
				'id'				=> '1003',
				'name'				=> 'VISA-756.1234.5678.97',
				'pay_method_number' => '756.1234.5678.97',
			],
			[
				'id'				=> '1004',
				'name'				=> 'SCB-CD-756.1234.5678.98',
				'pay_method_number' => '756.1234.5678.98',
			],
		];

		PayMethod::insert($bank_accounts);
	}
}
