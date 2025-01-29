<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// TODO Remove Testing
use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;
use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;

use App\Models\Tenant\Lookup\Currency;
use App\Models\Tenant\Lookup\BankAccount;

use App\Models\Tenant\Admin\Setup;
use App\Models\User;
use App\Models\Tenant\Workflow\Hierarchyl;
use App\Http\Controllers\Tenant\PrController;
use App\Http\Controllers\Tenant\PoController;

use App\Enum\Tenant\AuthStatusEnum;

use Faker\Generator;

use Str;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class DemoSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{

            $faker = app(Generator::class);

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
		// TODO Must comment in Production
		User::insert($usersDemo);




		// ========================================================

		$this->call(\Database\Seeders\PrSeeder::class);
		$this->call(\Database\Seeders\PrlSeeder::class);
		$this->call(\Database\Seeders\PoSeeder::class);
		$this->call(\Database\Seeders\PolSeeder::class);

        // get sys user id and update timestamp
		$sys = User::where('email', config('akk.SYS_EMAIL_ID'))->firstOrFail();
		Pr::where('created_by',NULL)->update(['created_by' => $sys->id,'updated_by' => $sys->id]);
		Prl::where('created_by',NULL)->update(['created_by' => $sys->id,'updated_by' => $sys->id]);
		Po::where('created_by',NULL)->update(['created_by' => $sys->id,'updated_by' => $sys->id]);
		Pol::where('created_by',NULL)->update(['created_by' => $sys->id,'updated_by' => $sys->id]);

        // set demo config and hierarchy
		Pr::query()->update(['currency' => 'BDT']);
		Po::query()->update(['currency' => 'BDT']);
		Setup::query()->update(['currency' => 'BDT','country' => 'BD','freezed' => true]);

		// Enable BDT
		Currency::where('currency','BDT')->update(['enable'=>true]);

		// Change currency of BankAccount
		BankAccount::query()->update(['currency' => 'BDT']);

        try {
			$admin = User::where('role', 'admin')->firstOrFail();
	 	} catch (ModelNotFoundException $exception) {
			Log::error("message");('tenant.TimestampSeeder.run admin not found!');
			$admin = User::where('email', config('akk.ANONYMOUS_EMAIL_ID'))->firstOrFail();
	 	}

		// create inset approver in Hierarchy
		$pr=Hierarchyl::create([
			'hid'			=> 1001,
			'approver_id'	=> $sys->id,
		]);
		$po=Hierarchyl::create([
			'hid'			=> 1002,
			'approver_id'	=> $sys->id,
		]);


		// recalculate Pr
		$pr = new PrController();
		$pr1001 = Pr::where('id', '1001')->firstOrFail();
		$result = $pr->recalculate($pr1001);
		$pr1002 = Pr::where('id', '1002')->firstOrFail();
		$result = $pr->recalculate($pr1002);
		$pr1003 = Pr::where('id', '1003')->firstOrFail();
		$result = $pr->recalculate($pr1003);

		// Approve 1 pr
		$pr1001->auth_status	= AuthStatusEnum::APPROVED->value;
		$pr1001->auth_date		= date('Y-m-d H:i:s');
		$pr1001->auth_user_id	= $sys->id;
		//$pr1001->save();

		// recalculate Po
		$po = new PoController();
		$po1001 = Po::where('id', '1001')->firstOrFail();
		$result = $po->recalculate($po1001);
		$po1002 = Po::where('id', '1002')->firstOrFail();
		$result = $po->recalculate($po1002);
		$po1003 = Po::where('id', '1003')->firstOrFail();
		$result = $po->recalculate($po1003);

		// Approve 1 po
		$po1001->auth_status	= AuthStatusEnum::APPROVED->value;
		$po1001->auth_date		= date('Y-m-d H:i:s');
		$po1001->auth_user_id	= $sys->id;
		//$po1001->save();

		// $this->call(\Database\Seeders\ReceiptSeeder::class);
		// $this->call(\Database\Seeders\InvoiceSeeder::class);
		// $this->call(\Database\Seeders\PaymentSeeder::class);
		// ========================================================

	}
}
