<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

// IQBAL
use Faker\Generator;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Dept;
use App\Models\Designation;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{


		/*
		|-----------------------------------------------------------------------------
		| Tenant																	 +
		|-----------------------------------------------------------------------------
		*/

		//Schema::disableForeignKeyConstraints();
		//User::truncate();
		//Schema::enableForeignKeyConstraints();

		$faker = app(Generator::class);
		// TODO $faker->city,

		$usersSeeded =  [
			[
				'id'				=> '1001',
				'name'				=> 'System Owner',
				'email'				=> 'system@anypo.net',
				'designation_id'	=> '1001',
				'dept_id'			=> '1001',
				'role'				=> 'system',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> '01911310509',
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'seeded'			=> true,
				'avatar'			=> 'system.png',
			],
			[
				'id'				=> '1002',
				'name'				=> 'Mr Support User',
				'email'				=> 'support@anypo.net',
				'designation_id'	=> '1001',
				'dept_id'			=> '1001',
				'role'				=> 'support',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'seeded'			=> true,
				'avatar'			=> 'support.png',
			],
		];

		$usersDemo =  [
			[
				'id'				=> '1003',
				'name'				=> 'Dummy Admin (Temp)',
				'email'				=> 'admin@anypo.net',
				'designation_id'	=> '1001',
				'dept_id'			=> '1001',
				'role'				=> 'admin',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> '3939 Lawrence Ave, E#108,',
				'address2'			=> '',
				'city'				=> 'Scarborough',  
				'state'				=> 'ON',  
				'zip'				=> 'M1G1R9',
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'admin.png',
			],
			[
				'id'				=> '1004',
				'name'				=> 'Mr. User 1 (IT)',
				'email'				=> 'user1it@anypo.net',
				'designation_id'	=> '1007',
				'dept_id'			=> '1001',
				'role'				=> 'user',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'ON',  
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'u1-it.png',
			],
			[
				'id'				=> '1005',
				'name'				=> 'Mr User 2 (IT)',
				'email'				=> 'user2it@anypo.net',
				'designation_id'	=> '1007',
				'dept_id'			=> '1001',
				'role'				=> 'user',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'ON',  
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'u2-it.png',
			],
			[
				'id'				=> '1006',
				'name'				=> 'Mr. User 1 (Sales)',
				'email'				=> 'user1sales@anypo.net',
				'designation_id'	=> '1007',
				'dept_id'			=> '1005',
				'role'				=> 'user',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'ON',  
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'u1-sales.png',
			],
			[
				'id'				=> '1007',
				'name'				=> 'Mr User 2 (Sales)',
				'email'				=> 'user2sales@anypo.net',
				'designation_id'	=> '1007',
				'dept_id'			=> '1005',
				'role'				=> 'user',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'ON',  
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'u2-sales.png',
			],
			[
				'id'				=> '1008',
				'name'				=> 'Mr Buyer 1 (IT)',
				'email'				=> 'buyer1@anypo.net',
				'designation_id'	=> '1002',
				'dept_id'			=> '1002',
				'role'				=> 'buyer',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'ON',  
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'buyer1.png',
			],
			[
				'id'				=> '1009',
				'name'				=> 'Mr Buyer 2 (Sales)',
				'email'				=> 'buyer2@anypo.net',
				'designation_id'	=> '1002',
				'dept_id'			=> '1002',
				'role'				=> 'buyer',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'ON',  
				'zip'				 => $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'buyer2.png',
			],
			[
				'id'				=> '1010',
				'name'				=> 'Mr HoD (IT)',
				'email'				=> 'hodit@anypo.net',
				'designation_id'	=> '1005',
				'dept_id'			=> '1001',
				'role'				=> 'hod',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'ON',  
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'hod-it.png',
			],
			[
				'id'				=> '1011',
				'name'				=> 'Mr HoD (Sales)',
				'email'				=> 'hodsales@anypo.net',
				'designation_id'	=> '1005',
				'dept_id'			=> '1005',
				'role'				=> 'hod',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'ON',  
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'hod-sales.png',
			],
			[
				'id'				=> '1012',
				'name'				=> 'Mr CxO',
				'email'				=> 'cxo@anypo.net',
				'designation_id'	=> '1004',
				'dept_id'			=> '1003',
				'role'				=> 'cxo',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'ON',  
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> true,
				'avatar'			=> 'cxo.png',
			],

		];

		User::insert($usersSeeded);
		// TODO Must comment in Production
		User::insert($usersDemo);


		// Mask as seeded user and Activate	// TODO
		// User::where('id', 1001)->update(['enable' => true,'seeded' => false]);	// SYSTEM must make it true
		// User::where('id', 1002)->update(['enable' => true,'seeded' => true]);
		// User::where('id', 1003)->update(['enable' => true,'seeded' => false]);	// ADMIN must make it true

		// TODO Mark as enable for testing
		// User::where('id', 1004)->update(['enable' => true]);
		// User::where('id', 1005)->update(['enable' => true]);
		// User::where('id', 1006)->update(['enable' => true]);
		// User::where('id', 1007)->update(['enable' => true]);
		// User::where('id', 1008)->update(['enable' => true]);
		// User::where('id', 1009)->update(['enable' => true]);
		// User::where('id', 1010)->update(['enable' => true]);
		// User::where('id', 1011)->update(['enable' => true]);
		// User::where('id', 1012)->update(['enable' => true]);

	}
}
