<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// IQBAL
use Faker\Generator;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		//User::factory()->count(10)->create();
		$faker = app(Generator::class);
		//User::truncate();

		$users =  [
			[
				'id'                => '1001',
				'name'              => 'System Admin',
				'email'             => 'system@example.com',
				'role'              => 'system',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => '01911310509',
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1002',
				'name'              => 'Guest',
				'email'             => 'guest@example.com',
				'role'              => 'guest',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1003',
				'name'              => 'Support Manager 1',
				'email'             => 'manager@example.com',
				'role'              => 'manager',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1004',
				'name'              => 'Accounts Manager',
				'email'             => 'accounts@example.com',
				'role'              => 'accounts',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1005',
				'name'              => 'Support Agent 1',
				'email'             => 'agent1@example.com',
				'role'              => 'support',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1006',
				'name'              => 'Support Agent 2',
				'email'             => 'agent2@example.com',
				'role'              => 'support',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1007',
				'name'              => 'Developer 1',
				'email'             => 'dev1@example.com',
				'role'              => 'developer',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1008',
				'name'              => 'Developer 2',
				'email'             => 'dev2@example.com',
				'role'              => 'developer',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],

		   /*
			[
				'id'                => '1007',
				'name'              => 'User 1 Account 1',
				'email'             => 'u1ac1@example.com',
				'role'              => 'user',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1008',
				'name'              => 'User 2 Account 1',
				'email'             => 'u2ac1@example.com',
				'role'              => 'user',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1009',
				'name'              => 'Admin 1 Account 1',
				'email'             => 'adm1ac1@example.com',
				'role'              => 'admin',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1010',
				'name'              => 'User 1 Account 2',
				'email'             => 'u1ac2@example.com',
				'role'              => 'user',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1011',
				'name'              => 'User 2 Account 2',
				'email'             => 'u2ac2@example.com',
				'role'              => 'user',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			[
				'id'                => '1012',
				'name'              => 'Admin 1 Account 2',
				'email'             => 'adm1ac2@example.com',
				'role'              => 'admin',
				'email_verified_at' => now(),
				'password'          => bcrypt('password') , // password
				'remember_token'    => Str::random(10),
				'cell'              => $faker->PhoneNumber(),
				'address1'          => $faker->address,
				'address2'          => $faker->address,
				'city'              => $faker->city,
				'state'             => 'N/A',
				'zip'               => $faker->postcode,
				'facebook'          => $faker->url,
				'linkedin'          => $faker->url,
			],
			*/
			
		];
		
		User::insert($users);

		User::where('id', 1001)->update(['avatar' => 'sys.png']);
		User::where('id', 1005)->update(['avatar' => 's1.png']);
		User::where('id', 1006)->update(['avatar' => 's2.png']);

		//User::where('id', 1007)->update(['avatar' => 'account1u1.png']);
		//User::where('id', 1008)->update(['avatar' => 'account1u2.png']);
		//User::where('id', 1009)->update(['avatar' => 'account1a1.png']);

		//User::where('id', 1010)->update(['avatar' => 'account2u1.png']);
		//User::where('id', 1011)->update(['avatar' => 'account2u2.png']);
		//User::where('id', 1012)->update(['avatar' => 'account2a1.png']);

	}
}
