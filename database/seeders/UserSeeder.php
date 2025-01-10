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
				'name'				=> 'SYSTEM',
				'email'				=> config('akk.SYSTEM_EMAIL_ID'),	// Don't change. Used in Seeder
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
				'backend'			=> true,
				'avatar'			=> 'system.png',
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Systems Admin',
				'email'				=> 'sysadmin@anypo.net',
				'designation_id'	=> '1001',
				'dept_id'			=> '1001',
				'role'				=> 'sysadmin',
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
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Support User (Seeded)',
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


		$usersDemo = [
			[
				'id'				=> Str::uuid(),
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
				'id'				=> Str::uuid(),
				'name'				=> 'Mr. User 1 (IT) (Temp)',
				'email'				=> 'user1it@anypo.net',		// Don't change. Used in Seeder
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
				'id'				=> Str::uuid(),
				'name'				=> 'Mr User 2 (IT) (Temp)',
				'email'				=> 'user2it@anypo.net',		// Don't change. Used in Seeder
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
				'id'				=> Str::uuid(),
				'name'				=> 'Mr. User 1 (Sales) (Temp)',
				'email'				=> 'user1sales@anypo.net',	// Don't change. Used in Seeder
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
				'id'				=> Str::uuid(),
				'name'				=> 'Mr User 2 (Sales) (Temp)',
				'email'				=> 'user2sales@anypo.net',	// Don't change. Used in Seeder
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
				'id'				=> Str::uuid(),
				'name'				=> 'Mr Buyer 1 (IT) (Temp)',
				'email'				=> 'buyer1@anypo.net',		// Don't change. Used in Seeder
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
				'id'				=> Str::uuid(),
				'name'				=> 'Mr Buyer 2 (Sales) (Temp)',
				'email'				=> 'buyer2@anypo.net',		// Don't change. Used in Seeder
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
				'id'				=> Str::uuid(),
				'name'				=> 'Mr HoD (IT) (Temp)',
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
				'id'				=> Str::uuid(),
				'name'				=> 'Mr HoD (Sales) (Temp)',
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
				'id'				=> Str::uuid(),
				'name'				=> 'Mr CxO (Temp)',
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
        User::insert($usersAnonymous);
		// TODO Must comment in Production
		User::insert($usersDemo);


		// Mask as backend user and Activate
		// User::where('id', 1001)->update(['enable' => true,'backend' => false]);	// SYSTEM must make it true
		// User::where('id', 1002)->update(['enable' => true,'backend' => true]);
		// User::where('id', 1003)->update(['enable' => true,'backend' => false]);	// ADMIN must make it true

		// Mark as enable for testing
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
