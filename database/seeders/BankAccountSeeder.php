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

		//$faker = app(Generator::class);

		$bank_accounts =  [
		 	[
				'id' 			=> 1001,
		 		'ac_name'		=> 'STD-SEEDED',
				'ac_number'		=> '1234567890',
				'routing_number'=> '12345',

			],
		];
		
		BankAccount::insert($bank_accounts);

		//BankAccount::factory()->count(4)->create();
	}
}
