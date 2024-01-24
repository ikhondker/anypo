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

		$users =  [
			[
				'id'				=> '1001',
				'name'				=> 'System Owner',
				'email'				=> 'system@example.com',
				
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
			],
			[
				'id'				=> '1002',
				'name'				=> 'Mr Support User',
				'email'				=> 'support@example.com',
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
			],
			// TODO Must Remove 
			[
				'id'				=> '1003',
				'name'				=> 'Admin User (Remove)',
				'email'				=> 'admin@example.com',
				'designation_id'	=> '1001',
				'dept_id'			=> '1001',
				'role'				=> 'admin',
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
			],

			[
				'id'				=> '1004',
				'name'				=> 'Mr. User 1',
				'email'				=> 'user1@example.com',
				'designation_id'	=> '1007',
				'dept_id'			=> '1003',
				'role'				=> 'user',
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
			],
			[
				'id'				=> '1005',
				'name'				=> 'Mr User 2',
				'email'				=> 'user2@example.com',
				'designation_id'	=> '1007',
				'dept_id'			=> '1004',
				'role'				=> 'user',
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
			],
			[
				'id'				=> '1006',
				'name'				=> 'Mr Buyer 1',
				'email'				=> 'buyer1@example.com',
				'designation_id'	=> '1002',
				'dept_id'			=> '1009',
				'role'				=> 'buyer',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'zip'				 => $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
			],
			[
				'id'				=> '1007',
				'name'				=> 'Mr Buyer 2',
				'email'				=> 'buyer2@example.com',
				'designation_id'	=> '1002',
				'dept_id'			=> '1009',
				'role'				=> 'buyer',
				'email_verified_at' => now(),
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> Str::random(10),
				'cell'				=> $faker->PhoneNumber(),
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'zip'				 => $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
			],
			[
				'id'				=> '1008',
				'name'				=> 'Mr HoD',
				'email'				=> 'hod@example.com',
				'designation_id'	=> '1004',
				'dept_id'			=> '1003',
				'role'				=> 'hod',
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
			],
			[
				'id'				=> '1009',
				'name'				=> 'Mr CxO',
				'email'				=> 'cxo@example.com',
				'designation_id'	=> '1003',
				'dept_id'			=> '1007',
				'role'				=> 'cxo',
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
			],
			
		];

		User::insert($users);
		
		// Mask as seeded user and Activate
		User::where('id', 1001)->update(['enable' => true,'seeded' => true]);
		User::where('id', 1002)->update(['enable' => true,'seeded' => true]);
		User::where('id', 1003)->update(['enable' => true,'seeded' => true]);
		

		// TODO Mark as enable for testing 
		User::where('id', 1004)->update(['enable' => true]);
		User::where('id', 1005)->update(['enable' => true]);
		User::where('id', 1006)->update(['enable' => true]);
		User::where('id', 1007)->update(['enable' => true]);
		User::where('id', 1008)->update(['enable' => true]);
		User::where('id', 1009)->update(['enable' => true]);
	}
}
