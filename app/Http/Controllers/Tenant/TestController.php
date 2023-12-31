<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

// Controller
use App\Http\Controllers\Landlord\ProvisionController;

// Models
use App\Models\User;
use App\Models\Landlord\Service;
use App\Models\Landlord\Account;

// Enums
use App\Enum\UserRoleEnum;
// Helpers
use App\Helpers\BackOffice;
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

use Illuminate\Support\Facades\Http;


class TestController extends Controller
{

	public function addTodo($id, $name)
	{
		Log::debug("INSIDE addTODO");
	}

	public function run()
	{

		$tenant = Tenant::where('id', 'demo1')->first();
		// run seeders in tenant
		$tenant->run(function () {
			//$seeder = new \Database\Seeders\UserSeeder();
			$seeder = new \Database\Seeders\TenantSeeder();
			$seeder->run();
		});
		// Write event log
		Log::debug('Seeder run for tenant=' . $tenant->id);

		exit;


		//$a=BackOffice::ReportError('PR','Test111 22 33 44');
		$a=BackOffice::ReportInfo('PR','Test111 22 33 44');
		dd($a . now());


		// https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR%2CUSD&base_currency=CAD
		// {
		//     "data": {
		//       "EUR": 0.6794070148,
		//       "USD": 0.7479654271
		//     }
		// }

		// https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR%2CUSD%2CCAD
		// {
		//     "data": {
		//       "CAD": 1.3369601907,
		//       "EUR": 0.9083401321,
		//       "USD": 1
		//     }
		// }

		//https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR&base_currency=CAD
		$response = Http::get('https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR');
		$jsonData = $response->json();
		$data= $jsonData['data'];

		Log::debug("EUR=".$data['EUR']);
		Log::debug("response->ok()=".$response->ok());
		Log::debug("response->successful()=".$response->successful());
		Log::debug("response->serverError()=".$response->serverError() );

		// [2023-08-08 18:27:40] local.DEBUG: EUR=0.9083401321
		// [2023-08-08 18:27:40] local.DEBUG: response->ok()=1
		// [2023-08-08 18:27:40] local.DEBUG: response->successful()1
		// [2023-08-08 18:27:40] local.DEBUG: response->serverError()


		// Boolean checks on the response
		// $response->ok() : bool;
		// $response->clientError(): bool;
		// $response->successful() : bool;
		// $response->serverError() : bool;
		// $response->clientError() : bool;

		// $amount = ($request->amount)?($request->amount):(1);
		// $apikey = 'fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ';
		// $from_Currency = urlencode($request->from_currency);
		// $to_Currency = urlencode($request->to_currency);
		// $query = "{$from_Currency}_{$to_Currency}";

		dd($data);

		$data = [
			'title' => 'Company XYZ',
			'date' 	=> date('m/d/Y'),
			//'products' => Product::all()
		];

		//return view('rnd.livewire')->with('title','Company XYZ')->with('date',date('m/d/Y'));
		//return view('rnd.modal')->with('title','Company XYZ')->with('date',date('m/d/Y'));
		//return view('rnd.bs5')->with('title','Company XYZ')->with('date',date('m/d/Y'));
		// return view('reports.htmltable')->with('title','Company XYZ')->with('date',date('m/d/Y'));
		//return view('reports.htmltable')->with('data',$data);
		//return view('reports.style3');
		//return view('reports.appstack');
		//return view('errors.404');
		// Send notification on new purchase

		Log::debug("I AM HERE INSIDE RUN");

		return redirect('/login')
			->with('error','Account updated successfully');


		// Send notification on new user registration
		//$user = User::where('id', 1001)->first();
		//$user->notify(new UserRegistered($user));
		//return redirect('/home')->with('error','Account updated successfully',$c1,$c2);


		// return redirect()->route('index.index')->with(array('warning' => 'warning message', 'success' => 'success message'));
		//return redirect('/dashboard')->with('status', 'Profile updated!');

		// return redirect()->route('index.index')
		//     ->with('warning', 'warning message')
		//     ->with('success', 'success message');

		// return redirect()->route('accounts.index')
		//     ->with('success','Account updated successfully');

		return redirect('/login')
			->with('error','Account updated successfully');


		// return redirect()->route('pages.success')
		//      ->with('success','Account updated successfully');

		// return view('pages.success')
		//     ->with('success','Account updated successfully');

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

	public function child1() {
		Log::channel('bo')->info('This is inside child1!');
		return 1;
	}

	public function child2() {
		Log::channel('bo')->info('This is inside child2!');
		return 2;
	}

}

