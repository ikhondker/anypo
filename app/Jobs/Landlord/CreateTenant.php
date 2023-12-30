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

use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;
use App\Models\Landlord\Admin\Service;

use App\Models\Landlord\Lookup\Product;
use App\Models\Landlord\Manage\Checkout;

// Enums
use App\Enum\UserRoleEnum;
use App\Enum\LandlordInvoiceStatusEnum;
use App\Enum\PaymentMethodEnum;
use App\Enum\LandlordPaymentStatusEnum;
use App\Enum\LandlordInvoiceTypeEnum;
use App\Enum\LandlordCheckoutStatusEnum;

// Helpers
use App\Helpers\Bo;
use App\Helpers\LandlordEventLog;

// Notification
use Notification;
use App\Notifications\Landlord\UserCreated;
use App\Notifications\Landlord\InvoiceCreated;
use App\Notifications\Landlord\InvoicePaid;
//use App\Notifications\Landlord\ServicePurchased;
use App\Notifications\Landlord\FirstTenantAdminCreated;

// Event
use Illuminate\Auth\Events\Registered;

// Seeded
use Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


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
		Log::debug('0. Processing Site='.$checkout->site);

		// create or update user
		Log::debug('1. Calling  createUpdateCheckoutUser');
		$user_id= self::createUpdateCheckoutUser($this->checkout_id);
		
		// Create account 
		Log::debug('2. Calling  createCheckoutAccount');
		$account_id		= self::createCheckoutAccount($this->checkout_id);

		// update account_id in checkout
		$checkout		= Checkout::where('id', $this->checkout_id)->first();
		$checkout->account_id     = $account_id;
		$checkout->save();

		// update user account_id
		$user = User::where('id', $user_id)->first();
		$user->account_id    = $account_id;
		$user->save();
		Log::debug('User account_id update uid=' . $user->id);
		LandlordEventLog::event('user', $user->id, 'update', $account_id);
		
		// create service	
		Log::debug('3. Calling  createCheckoutService');
		$service_id = self::createCheckoutService($this->checkout_id);

		// generate first invoice for this account and notify
		Log::debug('4. Calling  createCheckoutInvoice');
		$invoice_id = self::createCheckoutInvoice($this->checkout_id);
		$checkout->invoice_id     = $invoice_id;
		$checkout->save();

		// pay this first invoice and notify
		//$payment_id = self::payInvoice($invoice_id);
		Log::debug('5. Calling  payCheckoutInvoice');
		$payment_id = self::payCheckoutInvoice($checkout->invoice_id );

		// update account with billed date
		//$account = Account::where('id', $account_id)->first();
		//$invoice = Invoice::where('id', $invoice_id)->first();
		
		

		// TODO Send notification on new purchase
		// Do we need this notification
		// $user->notify(new ServicePurchased($user, $account));

		// update product sold_qty column
		$product				= Product::where('id', $checkout->product_id )->first();
		$product->sold_qty     = $product->sold_qty+1;
		$product->save();

		// Create new tenant TODO
		Log::debug("Creating Tenant for checkout ID= ".$this->checkout_id);
		Log::debug('6. Calling  createTenant');
		$tenant_id= self::createTenant();

		// mark checkout as complete
		$checkout->status_code =  LandlordCheckoutStatusEnum::COMPLETED->value;
		$checkout->update();
		
		// copy logo and avatar default files Not needed after AWS CDN
		// Log::debug('7. Calling  copyCheckoutFiles');
		// $service_id = self::copyCheckoutFiles($this->checkout_id);

	}

	public function test()
	{
		Log::debug("in side test= ".$this->checkout_id);
	}


	public static function createUpdateCheckoutUser($checkout_id = 0)
	{
		$checkout = Checkout::where('id', $checkout_id)->first();

		// make existing user admin if not admin
		if ($checkout->existing_user) {
			// for existing user  owner_id is already set in checkout for existing user SslCommerzPaymentController.index
			$user           = User::where('id', $checkout->owner_id)->first();
			$user->role     = UserRoleEnum::ADMIN->value;
			$user->save();
			Log::debug('Existing User Role updated for id=' . $user->id);
			// Write event log
			LandlordEventLog::event('user', $user->id, 'update', UserRoleEnum::ADMIN->value);
			$user_id = $checkout->owner_id;
		} else {
			// create new admin user			
			$user               = new User();
			$user->name         = $checkout->account_name;
			$user->email        = $checkout->email;
			$user->role         = UserRoleEnum::ADMIN->value;
			$random_password    = Str::random(12);
			$user->password     = bcrypt($random_password);
			//TODO MUST comment
			$user->password     = bcrypt('password');
			$user->save();

			// update owner_id in checkout
			$checkout->owner_id = $user->id;
			$checkout->update();

			// Write event log
			LandlordEventLog::event('user', $user->id, 'create');

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
		//$product = Product::where('id', $checkout->product_id)->first();

		// create new Account
		// id name tagline address1 address2 city state zip postcode country web fbpage lipage email cell user_count service_count enable logo created_by created_at updated_by updated_at
		$account                    = new Account();
		$account->name              = $checkout->account_name;
		$account->email             = $checkout->email;

		$account->site              = $checkout->site;
		$account->primary_product_id = $checkout->product_id;
		$account->owner_id          = $checkout->owner_id;

		$account->base_mnth         = $checkout->mnth;
		$account->base_user         = $checkout->user;
		$account->base_gb           = $checkout->gb;
		$account->base_price        = $checkout->price;

		$account->mnth              = $checkout->mnth;
		$account->user              = $checkout->user;
		$account->gb                = $checkout->gb;
		$account->price         	= $checkout->price;

		//Log::debug('$checkout->mnth=' . $checkout->mnth);
		//Log::debug('$end date=' . now()->addMonth($checkout->mnth));
		$account->start_date    	= now();
		$account->end_date      	= now()->addMonth($checkout->mnth);
		// defaulted
		$account->next_bill_generated    = false;
		$account->next_invoice_no    = 0;
		$account->last_bill_date    = now();;

		$account->save();

		//$account_id             = $account->id;
		Log::debug('Account Created id=' . $account->id);
		// Write event log
		LandlordEventLog::event('account', $account->id, 'create');

		return $account->id;
	}

	public static function createCheckoutService($checkout_id = 0)
	{

		$checkout		= Checkout::where('id', $checkout_id)->first();

		//$account = Account::where('id', $account_id)->first();
		//$product = Product::where('id', $account->primary_product_id)->first();


		// create new Service for this account
		// id name account_id is_addon addon_type owner_id base_mnth base_user base_gb base_price mnth user gb price
		// subtotal tax vat amount notes start_date end_date enable created_by created_at updated_by updated_at
		$service                 = new Service();

		$service->product_id    = $checkout->product_id;
		$service->name          = $checkout->product_name;

		$service->account_id    = $checkout->account_id;
		$service->owner_id      = $checkout->owner_id;

		$service->mnth          = $checkout->mnth;
		$service->user          = $checkout->user;
		$service->gb            = $checkout->gb;
		$service->price         = $checkout->price;
		$service->start_date    = now();

		$service->end_date       = now()->addMonth($checkout->mnth);
		$service->save();
		//$account_service_id             = $service->id;

		Log::debug('Account Service created id=' . $service->id);
		LandlordEventLog::event('service', $service->id, 'create');
		return $service->id;
	}

	public static function createCheckoutInvoice($checkout_id = 0)
	{

		$checkout		= Checkout::where('id', $checkout_id)->first();

		Log::debug('Generating Checkout Invoice for account_id= ' . $checkout->account_id );

		if ($checkout->account_id == 0) {
			//return redirect()->back()->with(['error' => 'Could you find account.']);
			return 0;
		}
		
		//$account = Account::where('id', $account_id)->first();

		// create new Invoice
		// logic: create invoice from the next date, after current billed date
		$invoice                = new Invoice();

		// get unique invoice_no
		$invoice->invoice_no    = Bo::getInvoiceNo();

		$invoice->invoice_date  = now();
		//Log::channel('bo')->info('Account id='. $account_id.' last_bill_from_date '.$account->last_bill_from_date);

		// this is the first bill for initial purchase
		$invoice->invoice_type  = LandlordInvoiceTypeEnum::CHECKOUT->value;
		$invoice->from_date     = $checkout->start_date;
		$invoice->to_date       = $checkout->end_date;
		Log::channel('bo')->info('Account id=' . $checkout->account_id . ' FIRST inv start ' . $invoice->from_date . ' to date ' . $invoice->to_date);
		//Log::channel('bo')->info('password='.$random_password);

		$invoice->due_date      = $checkout->end_date;
		$invoice->summary       = 'Invoice for ' . $checkout->account_name . ' for site' . $checkout->site;
		$invoice->price         = $checkout->price;
		$invoice->subtotal      = $checkout->price;
		$invoice->amount        = $checkout->price; // TODO ??
		$invoice->account_id    = $checkout->account_id;
		$invoice->owner_id      = $checkout->owner_id;

		// create invoice
		$invoice->currency      = 'USD';
		$invoice->status_code   = LandlordInvoiceStatusEnum::DUE->value;
		$invoice->save();

		Log::debug('Invoice Generated id=' . $invoice->id);
		LandlordEventLog::event('invoice', $invoice->id, 'create');

		// post invoice creation update
		$user           = User::where('id', $checkout->owner_id)->first();

		// Invoice Created Notification
		$user->notify(new InvoiceCreated($user, $invoice));

		//Log::debug('Account Created id='. $account->id);
		//return redirect()->route('processes.index')->with('success','Invoice Generation Process completed successfully.');
		return $invoice->id;
	}	


	public static function payCheckoutInvoice($invoice_id = 0)
	{

		$invoice = Invoice::where('id', $invoice_id)->first();
		Log::debug('Inside payCheckoutInvoice => Invoice id=' . $invoice->id);
		Log::debug('inside payCheckoutInvoice => Invoice account_id=' . $invoice->account_id);
		// summary pay_date invoice_id account_id owner_id payment_method_id amount cheque_no payment_token reference_id notes status ip created_by created_at updated_by updated_at

		// create payment
		$payment                     = new Payment();
		$payment->summary            = 'Payment for Invoice #' . $invoice->invoice_no;
		$payment->pay_date           = now();
		$payment->invoice_id         = $invoice->id;
		$payment->account_id         = $invoice->account_id;
		$payment->owner_id           = $invoice->owner_id; // Might be guest as well
		$payment->payment_method_id  = PaymentMethodEnum::CARD->value;
		$payment->amount             = $invoice->amount;
		$payment->status_code        = LandlordPaymentStatusEnum::PAID->value;
		//$payment->ip               = $request->ip(); // ERROR
		$payment->save();

		Log::debug('payment account id =' . $payment->account_id);
		Log::debug('Invoice Payment ID=' . $payment->id);
		LandlordEventLog::event('payment', $payment->id, 'create');

		// update paid amount in invoice as paid
		$invoice->status_code        = LandlordInvoiceStatusEnum::PAID->value;
		$invoice->amount_paid        = $invoice->amount_paid + $payment->amount;
		$invoice->save();
		LandlordEventLog::event('invoice', $invoice->id, 'update', 'status', LandlordPaymentStatusEnum::PAID->value);

		// Invoice Paid Notification
		$user = User::where('id', $invoice->owner_id)->first();
		$user->notify(new InvoicePaid($user, $invoice, $payment));

		return $payment->id;
	}


	public function createTenant()
	{
		//$checkout_id = $this->checkout_id;
		$checkout = Checkout::where('id', $this->checkout_id)->first();
		//$product = Product::where('id', $checkout->product_id)->first();
		Log::debug("checkout_id= ".$this->checkout_id);

		$tenant_id = $checkout->site;
		$domain = $tenant_id . '.' . config('app.domain');
		$tenant = Tenant::create([
			'id' 				=> $tenant_id,
			// Custom columns inside data
			//'initial_owner_id' 	=> $checkout->owner_id,
		]);

		// // this auto run migrations
		$tenant->createDomain([
			'domain' => $domain
		]);

		// run seeders in tenant
		$tenant->run(function () {
			$seeder = new \Database\Seeders\TenantSeeder();
			$seeder->run();
		});
		// Write event log
		//Log::debug('Tenant Created id=' . $tenant->id);
		LandlordEventLog::event('tenant', $tenant->id, 'create');

		// create first tenant admin for tenant
		$email 			= $checkout->email;
		$account_name 	= $checkout->account_name;
		$random_password    = \Illuminate\Support\Str::random(12);

		$tenant = Tenant::find($tenant_id);

		$tenant->run(function($tenant) use ($account_name, $email,$random_password){
			Log::debug('Tenant id =' . $tenant->id);

			// create admin user in newly created tenant
			$user = User::create([
				'name' 		=> $account_name,
				'email' 	=> $email,
				'email_verified_at'	=> NOW(),   // TODO this is not verified Already Verified in tenant
				'role'      => \App\Enum\UserRoleEnum::ADMIN->value,
				'password' 	=> Hash::make($random_password),
				'enable' 	=> true,
				//'password' 	=> bcrypt($random_password),

			]);
			Log::debug('Tenant Admin User Created id=' . $user->id);

			// TODO Send Verification Email from tenant context
			// event(new Registered($user));

		}
		);
		//Log::debug('Admin User Created by job');

		// Send notification to this new tenant admin user from landlord
		$user = User::where('id', $checkout->owner_id)->first();
		$domain = \App\Models\Domain::where('tenant_id', $tenant->id)->first();
		$user->notify(new FirstTenantAdminCreated($user, $random_password, $domain));
		Log::debug('Admin User Notified '.$user->name);

		return $tenant->id;

	}

}
