<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

// IQBAL
use Faker\Generator;
use App\Models\User;
use App\Models\Dept;
use App\Models\Designation;
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
		| Tenant																	 +
		|-----------------------------------------------------------------------------
		*/

		//Schema::disableForeignKeyConstraints();
		//User::truncate();
		//Schema::enableForeignKeyConstraints();

		$faker = app(Generator::class);

		$usersSeeded = [
			[
				'id'				=> Str::uuid(),
				'name'				=> 'SYS (Seeded)',
				'email'				=> config('akk.SYS_EMAIL_ID'),	// Don't change. Used in Seeder
				'designation_id'	=> '1001',
				'dept_id'			=> '1001',
				'role'				=> 'sys',
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
				'backend'			=> true,
				'avatar'			=> 'sys.png',
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'System (Seeded)',
				'email'				=> 'system@anypo.net',
				'designation_id'	=> '1001',
				'dept_id'			=> '1001',
				'role'				=> 'system',
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
				'backend'			=> true,
				'avatar'			=> 'system.png',
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Support (Seeded)',
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
				'backend'			=> true,
				'avatar'			=> 'support.png',
			],
		];

		// used only form system generated who columns
		$usersAnonymous = [
			[
				'id'				=> Str::uuid(),
				'name'				=> 'ANONYMOUS',
				'email'				=> config('akk.ANONYMOUS_EMAIL_ID'),	// Don't change. Used in Seeder
				'designation_id'	=> '1001',
				'dept_id'			=> '1001',
				'role'				=> 'guest',
				//'email_verified_at' => '',
				'password'			=> bcrypt('password') , // password
				'remember_token'	=> '',
				'cell'				=> '01911358620',
				'address1'			=> $faker->address,
				'address2'			=> $faker->address,
				'city'				=> $faker->city,
				'zip'				=> $faker->postcode,
				'facebook'			=> $faker->url,
				'linkedin'			=> $faker->url,
				'enable'			=> false,
				'backend'			=> true,
				'avatar'			=> 'anonymous.png',
			],
		];

		User::insert($usersSeeded);
		User::insert($usersAnonymous);


	}
}
