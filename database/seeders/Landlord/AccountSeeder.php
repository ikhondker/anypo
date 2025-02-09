<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Landlord\Account;
use Str;
// IQBAL
use Faker\Generator;
use Carbon\Carbon;

class AccountSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$faker = app(Generator::class);
		//Account::factory()->count(2)->create();
		// get system user id
		$sys = User::where('email', config('bo.SYS_EMAIL_ID'))->firstOrFail();

		$accounts = [
			[
				'id'				=> '1001',
				//'name'				=> config('app.name'),
				'name'				=> 'Master Site',
				'site'				=> 'master',
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> $faker->stateAbbr,
				'zip'				=> $faker->postcode,
				'owner_id'			=> $sys->id,
				'primary_product_id'=> '1001',
				'start_date'		=> Carbon::parse('2025-01-01'),
				'end_date'			=> Carbon::parse('2035-12-31'),
				'last_bill_date'	=> null ,
				'expired_at' 		=> null ,
//				'start_date'		=> $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
//				'end_date'			=> $faker->dateTimeBetween($startDate = 'now', $endDate = '1 years', $timezone = null),
//				'last_bill_date'	=> $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
//				'expired_at' 		=> $faker->dateTimeBetween($startDate = 'now', $endDate = '1 years', $timezone = null),
				'website'			=> $faker->domainName,
				'cell'				=> $faker->PhoneNumber,
				'email'				=> $faker->email,
				'created_by'		=> $sys->id,
				'updated_by'		=> $sys->id,
			],
		];
		//
		Account::insert($accounts);

		// $user1it = User::where('email', 'user1it@anypo.net')->firstOrFail();
		// $user2it = User::where('email', 'user2it@anypo.net')->firstOrFail();
		// $user1sales = User::where('email', 'user1sales@anypo.net')->firstOrFail();
		// $user2sales = User::where('email', 'user2sales@anypo.net')->firstOrFail();

		// Link User with Accounts
		// User::where('id', 1007)->update(['account_id' => '1001']);
		// User::where('id', 1008)->update(['account_id' => '1001']);
		// User::where('id', 1009)->update(['account_id' => '1001']);

		// User::where('id', 1010)->update(['account_id' => '1002']);
		// User::where('id', 1011)->update(['account_id' => '1002']);
		// User::where('id', 1012)->update(['account_id' => '1002']);

		// Account::where('id', 1001)->update(['logo' => 'account1.png']);
		// Account::where('id', 1002)->update(['logo' => 'account2.png']);




	}
}
