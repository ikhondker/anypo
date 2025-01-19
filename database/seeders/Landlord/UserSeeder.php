<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// IQBAL
use Faker\Generator;
use App\Models\User;
//use AWS\CRT\Log;
use Str;
use Illuminate\Support\Facades\Log;

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
        //  config('bo.MASTER_ACCOUNT_ID')

		$seededUsers = [
			[
				'id'				=> Str::uuid(),
				'name'				=> 'SYS',
				'email'				=> config('bo.SYS_EMAIL_ID'),
				'role'				=> 'sys',
                'account_id'        => config('bo.MASTER_ACCOUNT_ID'),
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
				'backend'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'System',
				'email'				=> 'system@anypo.net',
				'role'				=> 'system',
                'account_id'        => config('bo.MASTER_ACCOUNT_ID'),
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
				'backend'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Support Manager',
				'email'				=> config('bo.SUPPORT_GROUP_EMAIL_ID'),
				'role'				=> 'supervisor',
                'account_id'        => config('bo.MASTER_ACCOUNT_ID'),
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
				'backend'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'ANONYMOUS',
                'email'				=> config('akk.ANONYMOUS_EMAIL_ID'),	// Don't change. Used in Seeder
				'role'				=> 'guest',
                'account_id'        => config('bo.MASTER_ACCOUNT_ID'),
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
				'backend'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Accounts Manager',
				'email'				=> 'accounts@anypo.net',
				'role'				=> 'accounts',
                'account_id'        => config('bo.MASTER_ACCOUNT_ID'),
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
				'backend'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Support Agent 1',
				'email'				=> 'agent1@anypo.net',
				'role'				=> 'support',
                'account_id'        => config('bo.MASTER_ACCOUNT_ID'),
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
				'backend'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Support Agent 2',
				'email'				=> 'agent2@anypo.net',
				'role'				=> 'support',
                'account_id'        => config('bo.MASTER_ACCOUNT_ID'),
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
				'backend'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Developer 1',
				'email'				=> 'dev1@anypo.net',
				'role'				=> 'developer',
                'account_id'        => config('bo.MASTER_ACCOUNT_ID'),
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
				'backend'			=> true,
			],
			[
				'id'				=> Str::uuid(),
				'name'				=> 'Developer 2',
				'email'				=> 'dev2@anypo.net',
				'role'				=> 'developer',
                'account_id'        => config('bo.MASTER_ACCOUNT_ID'),
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
				'backend'			=> true,
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


		/*
		$demoUsers = [

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
		];
			*/

		User::insert($seededUsers);

		// Find and report support manager email
		Log::debug('landlord.seeders.UserSeeder bo.SUPPORT_GROUP_EMAIL_ID = '.config('bo.SUPPORT_GROUP_EMAIL_ID'));
		$user = User::where('email', config('bo.SUPPORT_GROUP_EMAIL_ID'))->first();
		Log::debug('landlord.seeders.UserSeeder bo.SUPPORT_MGR_ID = ' . $user->id);
		Log::debug('landlord.seeders.UserSeeder ===> UPDATE config\bo.php bo.SUPPORT_MGR_ID manually onetime.');

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
