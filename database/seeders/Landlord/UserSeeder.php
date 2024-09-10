<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// IQBAL
use Faker\Generator;
use App\Models\User;
use Str;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		/*
		|-----------------------------------------------------------------------------
		| Landlord																	 + 
		|-----------------------------------------------------------------------------
		*/
		
		//User::factory()->count(10)->create();
		$faker = app(Generator::class);
		//User::truncate();

		$seededUsers = [
			[
				'id'				=> Str::uuid(),
				'name'				=> 'System Admin',
				'email'				=> config('bo.SYSTEM_EMAIL_ID'),
				'role'				=> 'system',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> '01911310509',
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'seeded'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Guest',
				'email'				=> 'guest@anypo.net',
				'role'				=> 'guest',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'seeded'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Support Supervisor',
				'email'				=> 'support@anypo.net',
				'role'				=> 'supervisor',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'seeded'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Accounts Manager',
				'email'				=> 'accounts@anypo.net',
				'role'				=> 'accounts',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'seeded'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Support Agent 1',
				'email'				=> 'agent1@anypo.net',
				'role'				=> 'support',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'seeded'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Support Agent 2',
				'email'				=> 'agent2@anypo.net',
				'role'				=> 'support',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'seeded'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Developer 1',
				'email'				=> 'dev1@anypo.net',
				'role'				=> 'developer',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'seeded'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Developer 2',
				'email'				=> 'dev2@anypo.net',
				'role'				=> 'developer',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'seeded'			=> true,
			],
		];

		$demoUsers = [
		/*
			[
				'id'				=> '1007',
				'name'				=> 'User 1 Account 1',
				'email'				=> 'u1ac1@example.com',
				'role'				=> 'user',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
			],
			[
				'id'				=> '1008',
				'name'				=> 'User 2 Account 1',
				'email'				=> 'u2ac1@example.com',
				'role'				=> 'user',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
			],
			[
				'id'				=> '1009',
				'name'				=> 'Admin 1 Account 1',
				'email'				=> 'adm1ac1@example.com',
				'role'				=> 'admin',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
			],
			[
				'id'				=> '1010',
				'name'				=> 'User 1 Account 2',
				'email'				=> 'u1ac2@example.com',
				'role'				=> 'user',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
			],
			[
				'id'				=> '1011',
				'name'				=> 'User 2 Account 2',
				'email'				=> 'u2ac2@example.com',
				'role'				=> 'user',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
			],
			[
				'id'				=> '1012',
				'name'				=> 'Admin 1 Account 2',
				'email'				=> 'adm1ac2@example.com',
				'role'				=> 'admin',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'state'				=> 'N/A',
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
			],
			*/
		];
		
		User::insert($seededUsers);
		//User::where('id', 1001)->update(['avatar' => 'sys.png']);
		//User::where('id', 1005)->update(['avatar' => 's1.png']);
		//User::where('id', 1006)->update(['avatar' => 's2.png']);

		//User::where('id', 1007)->update(['avatar' => 'account1u1.png']);
		//User::where('id', 1008)->update(['avatar' => 'account1u2.png']);
		//User::where('id', 1009)->update(['avatar' => 'account1a1.png']);

		//User::where('id', 1010)->update(['avatar' => 'account2u1.png']);
		//User::where('id', 1011)->update(['avatar' => 'account2u2.png']);
		//User::where('id', 1012)->update(['avatar' => 'account2a1.png']);

	}
}
