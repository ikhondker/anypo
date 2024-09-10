<?php

namespace App\Jobs\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Models
use App\Models\User;
use App\Models\Tenant;
use App\Models\Domain;

use App\Models\Landlord\Account;

//use App\Models\Landlord\Admin\Invoice;
//use App\Models\Landlord\Admin\Payment;
//use App\Models\Landlord\Admin\Service;

use App\Models\Landlord\Lookup\Product;
use App\Models\Landlord\Manage\Checkout;
use App\Models\Landlord\Manage\Config;

// Enums
use App\Enum\UserRoleEnum;
use App\Enum\LandlordInvoiceStatusEnum;
use App\Enum\PaymentMethodEnum;
use App\Enum\LandlordPaymentStatusEnum;
use App\Enum\LandlordInvoiceTypeEnum;
use App\Enum\LandlordCheckoutStatusEnum;

// Helpers
use App\Helpers\Landlord\Bo;

use App\Helpers\EventLog;

// Notification
use Notification;
use App\Notifications\Landlord\UserCreated;
use App\Notifications\Landlord\InvoiceCreated;
use App\Notifications\Landlord\InvoicePaid;
use App\Notifications\Landlord\ServicePurchased;
use App\Notifications\Landlord\FirstTenantAdminCreated;

// Event
use Illuminate\Auth\Events\Registered;

// Seeded
use Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Facades\Auth;

class CreateTenant implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	//The process "D:\xampp\php\php.exe artisan queue:work --once --name=default --queue=default --backoff=0 --memory=128 --sleep=3 --tries=1" exceeded the timeout of 60 seconds.
	public $timeout = 1200;
	public $failOnTimeout = true;

	protected $checkout_id;

	/**
	 * Create a new job instance.
	 */
	public function __construct($checkout_id)
	{
		$this->checkout_id = $checkout_id;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		// 1. create billing user & make user admin
		// 2. create account (for support add general account)
		// 3. Add service to that account
		// 4. set user account_id
		// 5. mail him the support account
		// 6. create tenant
		// 7. create tenant admin account
		// 8. mail the tenant login <details

		// mark checkout as processing
		$checkout = Checkout::where('id', $this->checkout_id )->first();
		$checkout->status_code = LandlordCheckoutStatusEnum::PROCESSING->value ;
		$checkout->update();
		Log::debug('Jobs.Landlord.CreateTenant 0. Processing Site = '.$checkout->site);

		// create or update user
		Log::debug('Jobs.Landlord.CreateTenant 1. Calling self::createUpdateCheckoutUser');
		$user_id= self::createUpdateCheckoutUser($this->checkout_id);

		// Create account
		Log::debug('Jobs.Landlord.CreateTenant 2. Calling self::createCheckoutAccount');
		$account_id		= self::createCheckoutAccount($this->checkout_id);

		// update account_id in checkout
		$checkout		= Checkout::where('id', $this->checkout_id)->first();
		$checkout->account_id	= $account_id;
		$checkout->save();

		// update user account_id
		$user = User::where('id', $user_id)->first();
		$user->account_id = $account_id;
		$user->save();
		Log::debug('Jobs.Landlord.CreateTenant User account_id update user_id = ' . $user->id);
		EventLog::event('user', $user->id, 'update', $account_id);

		// create service
		Log::debug('Jobs.Landlord.CreateTenant 3. Calling bo.createServiceForCheckout');
		$service_id = bo::createServiceForCheckout($this->checkout_id);

		// generate first invoice for this account and notify
		Log::debug('Jobs.Landlord.CreateTenant 4. Calling bo.createInvoiceForCheckout');
		$invoice_id 			= bo::createInvoiceForCheckout($this->checkout_id);
		$checkout->invoice_id	= $invoice_id;
		$checkout->save();

		// pay this first invoice and notify
		//$payment_id = self::payInvoice($invoice_id);
		Log::debug('Jobs.Landlord.CreateTenant 5. Calling bo.payCheckoutInvoice');
		$payment_id = bo::payCheckoutInvoice($checkout->invoice_id );

		// update account with billed date
		//$invoice = Invoice::where('id', $invoice_id)->first();

		// update product sold_qty column
		$product			= Product::where('id', $checkout->product_id )->first();
		$product->sold_qty	= $product->sold_qty+1;
		$product->save();

		// Create new tenant TODO
		Log::debug("Jobs.Landlord.CreateTenant Creating Tenant for checkout ID= ".$this->checkout_id);
		Log::debug('Jobs.Landlord.CreateTenant 6. Calling self::createTenantDb');
		$tenant_id= self::createTenantDb();

		// mark checkout as complete
		$checkout->status_code = LandlordCheckoutStatusEnum::COMPLETED->value;
		$checkout->update();

		// Send notification to Landlord system on new purchase
		$account 	= Account::where('id', $account_id)->first();
		//TODO 
		//$system 	= User::where('id', config('bo.SYSTEM_USER_ID'))->first();
		//$system->notify(new ServicePurchased($user, $account));

		// copy logo and avatar default files Not needed after AWS CDN
		// Log::debug('7. Calling copyCheckoutFiles');
		// $service_id = self::copyCheckoutFiles($this->checkout_id);
	}

	public static function createUpdateCheckoutUser($checkout_id = 0)
	{
		$checkout = Checkout::where('id', $checkout_id)->first();
		$config = Config::first();

		// make existing user admin if not admin
		if ($checkout->existing_user) {
			// for existing user owner_id is already set in checkout for existing user SslCommerzPaymentController.index
			$user			= User::where('id', $checkout->owner_id)->first();
			$user->role		= UserRoleEnum::ADMIN->value;
			$user->save();

			Log::debug('Jobs.Landlord.CreateTenant Existing User Role updated for id = ' . $user->id);
			// Write event log
			EventLog::event('user', $user->id, 'update', UserRoleEnum::ADMIN->value);
			$user_id = $checkout->owner_id;
		} else {
			// create new admin user
			$user			= new User();
			$user->name		= $checkout->account_name;
			$user->email	= $checkout->email;
			$user->role		= UserRoleEnum::ADMIN->value;
			$random_password= Str::random(12);
			$user->password	= bcrypt($random_password);
			// TODO MUST comment
			// $user->password	= bcrypt('password');

			// default address
			$user->address1			= $config->address1;
			$user->address2			= $config->address2;
			$user->city				= $config->city;
			$user->state			= $config->state;
			$user->zip				= $config->zip;
			$user->country			= $config->country;
			$user->facebook			= $config->facebook;
			$user->linkedin			= $config->linkedin;

			$user->save();

			// update owner_id in checkout
			$checkout->owner_id = $user->id;
			$checkout->update();

			// Write event log
			EventLog::event('user', $user->id, 'create');

			// Send Verification Email
			event(new Registered($user));

			// Send notification on new user creation with initial password
			$user->notify(new UserCreated($user, $random_password));

			$user_id = $user->id;
		}

		return $user_id;
	}

	public static function copyCheckoutFiles($checkout_id = 0)
	{
		Log::channel('bo')->info('Copying Default Logo and Avatar png copied.');
		$checkout 		= Checkout::where('id', $checkout_id)->first();
		$subdir 		=$checkout->site;

		// Copy avatar.png to newly created tenant
		$path = public_path("tenant\\".$subdir."\avatar");
		Log::channel('bo')->info('Create Folder: '.$path);
		if(!File::isDirectory($path)){
			File::makeDirectory($path, 0644, true, true);
		}
		Log::channel('bo')->info('Copying avatar.png to '.$path);
		File::copy(public_path('assets\avatar\avatar.png'), $path.'\avatar.png');

		// Copy logo.png to newly created tenant
		$path = public_path("tenant\\".$subdir."\logo");
		Log::channel('bo')->info('Create Folder: '.$path);
		if(!File::isDirectory($path)){
			File::makeDirectory($path, 0644, true, true);
		}
		Log::channel('bo')->info('Copying logo.png to '.$path);
		File::copy(public_path('assets\logo\logo.png'), $path.'\logo.png');

		Log::channel('bo')->info('Default Logo and Avatar png copied.');
		return 0;
	}

	public static function createCheckoutAccount($checkout_id = 0)
	{

		// id name sku is_addon addon_type base_mnth base_user base_gb base_price mnth user gb price price_3 price_6 price_12 price_24 tax_pc vat_pc
		// subtotal tax vat amount notes sold_qty photo enable created_by created_at updated_by updated_at
		$checkout = Checkout::where('id', $checkout_id)->first();
		$config = Config::first();
		//$product = Product::where('id', $checkout->product_id)->first();

		// create new Account
		// id name tagline address1 address2 city state zip postcode country web fbpage lipage email cell user_count service_count enable logo created_by created_at updated_by updated_at
		$account					= new Account();
		$account->name				= $checkout->account_name;
		$account->email				= $checkout->email;

		$account->site				= $checkout->site;
		$account->primary_product_id = $checkout->product_id;
		$account->owner_id			= $checkout->owner_id;

		$account->base_mnth			= $checkout->mnth;
		$account->base_user			= $checkout->user;
		$account->base_gb			= $checkout->gb;
		$account->base_price		= $checkout->price;

		$account->mnth				= $checkout->mnth;
		$account->user				= $checkout->user;
		$account->gb				= $checkout->gb;
		$account->price				= $checkout->price;

		// default address
		$account->address1			= $config->address1;
		$account->address2			= $config->address2;
		$account->city				= $config->city;
		$account->state				= $config->state;
		$account->zip				= $config->zip;
		$account->country			= $config->country;
		$account->website			= $config->website;
		$account->facebook			= $config->facebook;
		$account->linkedin			= $config->linkedin;

		//Log::debug('$checkout->mnth = ' . $checkout->mnth);
		//Log::debug('$end date = ' . now()->addMonth($checkout->mnth));
		$account->start_date		= now();
		$account->end_date			= now()->addMonth($checkout->mnth);
		// defaulted
		$account->next_bill_generated	= false;
		$account->next_invoice_no		= 0;
		$account->last_bill_date		= now();

		$account->save();

		//$account_id		= $account->id;
		Log::debug('Jobs.Landlord.CreateTenant.createCheckoutAccount account created account_id = ' . $account->id);
		// Write event log
		EventLog::event('account', $account->id, 'create');

		return $account->id;
	}


	public function createTenantDb()
	{
		//$checkout_id = $this->checkout_id;
		//$product = Product::where('id', $checkout->product_id)->first();
		$checkout = Checkout::where('id', $this->checkout_id)->first();
		Log::debug("Jobs.Landlord.CreateTenant.createTenantDb checkout_id = ".$checkout->id);
		Log::debug("Jobs.Landlord.CreateTenant.createTenantDb checkout->site = ".$checkout->site);

		$tenant_id 	= $checkout->site;
		$domain 	= $tenant_id . '.' . config('app.domain');
		Log::debug("Jobs.Landlord.CreateTenant.createTenantDb tenant_id = ".$tenant_id);
		Log::debug("Jobs.Landlord.CreateTenant.createTenantDb domain = ".$domain);

		$tenant 	= Tenant::create([
			'id' 	=> $tenant_id,
			// Custom columns inside data
			//'initial_owner_id' 	=> $checkout->owner_id,
		]);

		// this auto run migrations
		$tenant->createDomain([
			'domain' => $domain
		]);
		Log::debug('Jobs.landlord.createTenant.createTenantDb Tenant Created tenant_id = ' . $tenant_id);
		Log::debug('Jobs.landlord.createTenant.createTenantDb Tenant Created tenant->id = ' . $tenant->id);

		// run seeders in tenant
		Log::debug('Jobs.landlord.createTenant.createTenantDb Running seeder in tenant->id = ' . $tenant->id);
		$tenant->run(function () {
			$seeder = new \Database\Seeders\TenantSeeder();
			$seeder->run();
		});

		// Write event log
		EventLog::event('tenant', $tenant->id, 'create');

		// create first tenant admin for tenant
		$email 			= $checkout->email;
		$account_name 	= $checkout->account_name;
		$random_password= \Illuminate\Support\Str::random(12);

		// ??
		//$tenant = Tenant::find($tenant_id);
		Log::debug('Jobs.landlord.createTenant.createTenantDb finding newly created tenant_id = ' . $tenant_id);
		Log::debug('Jobs.landlord.createTenant.createTenantDb finding newly created tenant->id = ' . $tenant->id);

		$tenant->run(function($tenant) use ($account_name, $email, $random_password){
			Log::debug('Jobs.Landlord.CreateTenant.createTenantDb inside tenant_id = ' . $tenant->id);

			// create first and admin user in newly created tenant
			$user = User::create([
				'name'				=> $account_name,
				'address1'			=> '3939 Lawrence Ave, E#108,',
				'address2'			=> '',
				'city'				=> 'Scarborough',  
				'state'				=> 'ON',  
				'zip'				=> 'M1G1R9',
				'email'				=> $email,
				'email_verified_at'	=> NOW(),	// TODO this is not verified Already Verified in tenant
				'role'				=> \App\Enum\UserRoleEnum::ADMIN->value,
				'password'			=> Hash::make($random_password),
				'designation_id'	=> 1001,	// System/IT Administrator
				'dept_id'			=> 1001,	// IT
				'facebook'			=> 'https://www.facebook.com/my.anyponet',
				'linkedin'			=> 'https://www.linkedin.com/company/anypo-net',
				'enable'			=> true,
				//'password' 	=> bcrypt($random_password),
			]);
			Log::debug('Jobs.Landlord.CreateTenant.createTenantDb Tenant Admin User created user_id = ' . $user->id);

			// Update tenant config->name in the tenant database
			Log::debug('Jobs.Landlord.CreateTenant.createTenantDb Updating Tenant Setup for account_name and admin_id');
			$tenantSetup 			= \App\Models\Tenant\Admin\Setup::first();
			$tenantSetup->name 		= $account_name;
			$tenantSetup->admin_id 	= $user->id;
			$tenantSetup->facebook 	= 'https://www.facebook.com/my.anyponet';
			$tenantSetup->linkedin 	= 'https://www.linkedin.com/company/anypo-net';
			$tenantSetup->update();

			// Insert Rows in Hierarchyl Table
			Log::debug('Jobs.Landlord.CreateTenant.createTenantDb Inserting two Rows for Seeded Approval Workflow Hierarchy.');
			$pr=\App\Models\Tenant\Workflow\Hierarchyl::create([
				'hid'			=> 1001,
				'approver_id'	=> $user->id,
			]);
			$po=\App\Models\Tenant\Workflow\Hierarchyl::create([
				'hid'			=> 1002,
				'approver_id'	=> $user->id,
			]);

			
			// Set dept approval hierarchy: Hardcoded in Tenant->DeptSeeder.php 1001 and 1002

			// Update tenant demo project pm in the tenant database
			Log::debug('Jobs.Landlord.CreateTenant.createTenantDb Updating pm for Seeded Project to admin_id');
			$tenantProject 			= \App\Models\Tenant\Lookup\Project::first();
			$tenantProject->pm_id 	= $user->id;
			$tenantProject->update();

			Log::debug('Jobs.Landlord.CreateTenant.createTenantDb Tenant Setup Name Updated setup_id = ' . $tenantSetup->id);

			// TODO Send Verification Email from tenant context
			// event(new Registered($user));

		}
		);
		//Log::debug('Admin User Created by job');

		// Send notification to this new tenant admin user from landlord
		$user = User::where('id', $checkout->owner_id)->first();
		$domain = \App\Models\Domain::where('tenant_id', $tenant->id)->first();
		$user->notify(new FirstTenantAdminCreated($user, $random_password, $domain));
		Log::debug('Jobs.Landlord.CreateTenant.createTenantDb Admin User Notified : '.$user->name);

		return $tenant->id;

	}

}
