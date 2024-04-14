<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;

# 1. Models
# 2. Enums
# 3. Helpers
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
# 13. FUTURE 


// Models
use App\Models\User;
use App\Models\Tenant;
use App\Models\Domain;
use App\Models\Landlord\Admin\Service;
use App\Models\Landlord\Account;
use App\Models\Landlord\Ticket;
use App\Models\Landlord\Manage\Checkout;

// Enums
use App\Enum\UserRoleEnum;
// Helpers
use App\Helpers\Bo;

// Notification
use Notification;
use App\Notifications\Landlord\ServicePurchased;
use App\Notifications\Landlord\UserRegistered;

// Seeded
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;
use Str;

#Jobs
use App\Jobs\Landlord\CreateTenant;

# Package
use PDF;
use App\Jobs\Landlord\SubscriptionInvoicePaid;

//use Storage;

class TestController extends Controller
{
	public $random_password;

	public function run()
	{

		Log::debug('Value of config(app.domain)=' . config('app.domain'));
		Log::debug('Value of env(APP_DOMAIN)=' . env('APP_DOMAIN'));

		Log::debug('Value of config(app.url)=' . config('app.url'));
		Log::debug('Value of env(APP_URL)=' . env('APP_URL'));

		Log::debug('Value of env(ASSET_URL)=' . env('ASSET_URL'));

		

		exit;

		$tenant = Tenant::find('demo1');
		$account_name = 'aaaaaaaaaaaaaaaaa';
		$tenant->run(function($tenant) use ($account_name){
			Log::debug('Jobs.Landlord.CreateTenant.createTenantDb Tenant id =' . $tenant->id);

			$tenantSetup =  \App\Models\Tenant\Admin\Config::first();
			$tenantSetup->name =  $account_name;
			$tenantSetup->update();

			Log::debug('Jobs.Landlord.CreateTenant.createTenantDb  Tenant account updated=' . $account_name);

		}
		);
		exit;
			
			
		SubscriptionInvoicePaid::dispatch('1006');

		exit;

		$tenant = Tenant::where('id', 'demo1')->first();
		// run seeders in tenant
		$tenant->run(function () {
			$seeder = new \Database\Seeders\TenantSeeder();
			$seeder->run();
		});
		// Write event log
		Log::debug('Seeder run for tenant=' . $tenant->id);

		exit;



		$subdir = 'demo2';
		// copy logo and avatar default files
		//$service_id = self::copyCheckoutFiles(1004);
		exit;



		// Copy avatar.png to newly created tenant
		$path = public_path("ytenants\\" . $subdir . "\avatar");
		if (!File::isDirectory($path)) {
			File::makeDirectory($path, 0644, true, true);
		}
		File::copy(public_path('assets\avatar\avatar.png'), $path . '\avatar.png');

		// Copy logo.png to newly created tenant
		$path = public_path("ytenants\\" . $subdir . "\logo");
		if (!File::isDirectory($path)) {
			File::makeDirectory($path, 0644, true, true);
		}
		File::copy(public_path('assets\logo\logo.png'), $path . '\logo.png');
		dd('Copy File done at' . now() . '.');


		//Log::debug("path a= ".public_path('assets\avatar\avatar.png') );
		Log::debug("path = " . $path);
		//File::copy(public_path('assets\avatar\avatar.png'), public_path('xtenants\demo1\avatar\avatar.png'));
		File::copy(public_path('assets\avatar\avatar.png'), $path . '\avatar.png');

		$file = storage_path('app/file.zip');
		$destination = public_path('files/file.zip');
		//Storage::copy($file,$destination);
		Log::debug("source= " . $file);
		Log::debug("destination = " . $destination);

		//File::copy(public_path('assets\avatar\avatar.png'), public_path('xtenants/demo1/avatar/avatar.png'));
		//Log::debug("path l= ".public_path('assets\logo\logo.png') );
		//File::copy(public_path('assets\logo\logo.png'), public_path('xtenants/demo1/logo/avatar.png'));
		dd('Copy File done at' . now() . '.');


		Log::debug("app.names= " . config('app.name'));
		return redirect('/home')->with('success', 'Files Copied');
		exit;

		//$invoice_no=Bo::getInvoiceNo();
		//Log::debug("invoice_no= ".$invoice_no );
		//return redirect('/home')->with('success', 'Tenant created 1');
		//exit;

		Log::debug("app.names= " . config('app.name'));
		Log::debug("app.domain= " . config('app.domain'));
		Log::debug("app.url= " . config('app.url'));
		Log::debug("central_domains= " . config('bo.landlord_domain'));

		return view('landlord.pages.info')->with('title', 'Transaction Successful!')->with('msg', 'Thank you for purchasing ' . config('app.name') . ' service.
		We have sent the login and other details to your email address. Please check your email.');

		return redirect('/home')->with('success', 'Tenant created 1');
		exit;


		// CreateTenant::dispatch("1");
		// Log::debug("Creating Tenant for 1 ");
		// return redirect('/home')->with('success', 'Tenant created');
		// exit;

		// // auto run migration
		// $tenant_id = 'demo3';
		// $domain = $tenant_id . '.' . 'localhost';
		// $tenant = Tenant::create([
		//		'id' => $tenant_id
		// ]);

		// $tenant->createDomain([
		//	'domain' => $domain
		// ]);


		// //OK
		// $tenant->run(function()		{
		//	$seeder = new \Database\Seeders\UserSeeder();
		//	$seeder->run();
		// });

		// $tenant->run(function()
		// {
		//	User::create([
		//	'name' 		=> 'John Doe',
		// 		'email' 	=> 'john3@example.com',
		// 		'password' => bcrypt('password'),
		//	]);
		// });
		return redirect('/home')->with('success', 'Tenant created 1');
		exit;


		// CreateTenant::dispatch("1");
		// Log::debug("Creating Tenant for	1 ");
		// return redirect('/home')->with('success', 'Tenant created 1');
		// exit;


		$user				= new User();
		$random_password	= Str::random(12);
		$domain = Domain::where('tenant_id', 'demo1')->first();
		Log::debug('central random_password =' . $random_password);

		$tenant = Tenant::find('demo1');
		//tenancy()->initialize($tenant);
		// create your user for tenant here
		$x = $tenant->run(
			function ($tenant) {
				Log::debug('Admin User Creation inside tenant context');
				// create admin user in newly created tenant

				// $user = User::create([
				// 	'name' 		=> 'John Doe',
				// 	'email' 	=> 'john3@example.com',
				// 	'password' 	=> Hash::make($random_password),
				// ]);
				// Log::debug('User Created id=' . $user->id);
				Log::debug('Tenant random_password =' . $tenant);
				return 99;
			}
		);
		//Log::debug('Admin User Created by job');
		//tenancy()->end();

		Log::debug('x= = ' . $x);
		return redirect('/home')->with('success', 'Admin User Created created');
		exit;


		CreateTenant::dispatch("1");
		Log::debug("Creating Tenant for	1 ");
		return redirect('/home')->with('success', 'Tenant created');
		exit;

		// $tenant = Tenant::find('demo1');
		// tenancy()->initialize($tenant);
		// // create your user for tenant here
		// $tenant->run(function(){ // your code to create users here
		// 	// create admin user in newly created tenant
		// 	User::create([
		// 		'name' => 'John Doe',
		// 		'email' => 'john@example.com',
		// 		'password' => bcrypt('password'),
		// 	]);
		// 	}
		// );
		// return redirect('/home')->with('success', 'User John created');
		// exit;






		return redirect('/home')->with('success', 'Tenant created', $tenant_id);

		//$tickets = Ticket::latest();
		$tickets = Ticket::get();
		dd($tickets);

		// Send notification on new purchase

		$c1 = $this->child1();
		$c2 = $this->child2();

		//php artisan tenants:seed --class=UserSeeder --tenants=geda
		//$exitCode = Artisan::call('mail:send', ['user' => $user, '--queue' => 'default']);


		// Send notification on new user registration
		//$user = User::where('id', 1001)->first();
		//$user->notify(new UserRegistered($user));
		return redirect('/home')->with('error', 'Account updated successfully', $c1, $c2);


		// return redirect()->route('index.index')->with(array('warning' => 'warning message', 'success' => 'success message'));
		//return redirect('/dashboard')->with('status', 'Profile updated!');

		// return redirect()->route('index.index')
		//	->with('warning', 'warning message')
		//	->with('success', 'success message');

		// return redirect()->route('accounts.index')
		//	->with('success','Account updated successfully');

		return redirect('/login')
			->with('error', 'Account updated successfully');


		// return redirect()->route('pages.success')
		//	 ->with('success','Account updated successfully');

		// return view('pages.success')
		//	->with('success','Account updated successfully');

		//$role = UserRoleEnum::MANAGER;
		// https://www.scratchcode.io/laravel-notification-tutorial-with-example/
		// https://www.positronx.io/laravel-notification-example-create-notification-in-laravel/
		// https://blog.quickadminpanel.com/laravel-notifications-with-database-driver-internal-messages/

		//$account_id = 1002;
		// Send notification on new purchase
		//$account = Account::where('id', $account_id)->first();
		//$user = User::where('id', $account->owner_id)->first();
		//$user->notify(new ServicePurchased($user, $account));

		// Create a test invoice
		//$provision = new ProvisionController();
		//$provision->createInvoice($account_id);
		// Make test Payment
		//$provision->payInvoice($invoice_id);

		//return view('test',compact('addons'));
		//return view('test');

		//dd($role);
		//echo $role->value;

		// Log::channel('bo')->info('This is testing for ItSolutionStuff.com!');
		// $user_name = auth()->check() ? auth()->user()->name : 'Name here';
		// $user_email = auth()->check() ? auth()->user()->email : 'email here';
		// $user = ['name'=>$user_name, 'email'=>$user_email];
		// Log::channel('bo')->info('User details',[$user]);


		//$addons= Service::orderBy('id', 'ASC');
		//$addons= User::orderBy('id', 'ASC');
		//dd($addons);
		//return view('test',compact('addons'));

		// $user = Auth::user(); // Retrieve the currently authenticated user...
		// $id = Auth::id(); // Retrieve the currently authenticated user's ID...
		// $emp_id = Auth::user()->emp_id;

		// echo $id;
		// echo $emp_id;
		// $emp = Emp::where('id', $emp_id)->first();
		// echo $emp->code;
		//$this->authorize('update',$advance);
		//return view('testrun');
	}

	public function generatePDF()
	{
		$data = [
			'title' => 'Welcome to ItSolutionStuff.com',
		]; 
		$pdf = PDF::loadView('landlord.reports.formats.example2', $data);
		return $pdf->stream('fonts.pdf');
	}


	public static function copyCheckoutFiles($checkout_id = 0)
	{
		Log::channel('bo')->info('Copying Default Logo and Avatar png copied.');
		$checkout 		= Checkout::where('id', $checkout_id)->first();
		$subdir 		= $checkout->site;

		// Copy avatar.png to newly created tenant
		$path = public_path("tenant\\" . $subdir . "\avatar");
		Log::channel('bo')->info('Create Folder: ' . $path);
		if (!File::isDirectory($path)) {
			File::makeDirectory($path, 0644, true, true);
		}
		Log::channel('bo')->info('Copying avatar.png to ' . $path);
		File::copy(public_path('assets\avatar\avatar.png'), $path . '\avatar.png');

		// Copy logo.png to newly created tenant
		$path = public_path("tenants\\" . $subdir . "\logo");
		Log::channel('bo')->info('Create Folder: ' . $path);
		if (!File::isDirectory($path)) {
			File::makeDirectory($path, 0644, true, true);
		}
		Log::channel('bo')->info('Copying logo.png to ' . $path);
		File::copy(public_path('assets\logo\logo.png'), $path . '\logo.png');

		Log::channel('bo')->info('Default Logo and Avatar png copied.');
		return 0;
	}


	public function child1()
	{
		Log::channel('bo')->info('This is inside child1!');
		return 1;
	}

	public function child2()
	{
		Log::channel('bo')->info('This is inside child2!');
		return 2;
	}
}
