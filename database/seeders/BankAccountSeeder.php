<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Lookup\BankAccount;
use Faker\Generator;

class BankAccountSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		// $faker = app(Generator::class);

		// $bank_accounts =  [
		// 	[
		// 		'ac_name'		=> 'STD-'.$faker->bankAccountNumber,
		// 		'ac_number'		=> $faker->bankAccountNumber,
		// 		'routing_number'=> $faker->bankRoutingNumber,
		// 	],
		// 	[
		// 		'id'			=> '1002',
		// 		'ac_name'		=> 'DB-STD-756.1234.5678.97',
		// 		'ac_number'		=> '756.1234.5678.97',
		// 	],
		// 	[
		// 		'id'			=> '1003',
		// 		'ac_name'		=> 'VISA-756.1234.5678.98',
		// 		'ac_number'		=> '756.1234.5678.98',
		// 	],
		// 	[
		// 		'id'			=> '1004',
		// 		'ac_name'		=> 'VISA Credit Card',
		// 		'ac_number'		=> '756.1234.5678.99',
		// 	],
		// ];

		BankAccount::factory()->count(4)->create();

		//BankAccount::insert($bank_accounts);
	}
}
