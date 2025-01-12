<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			TestController.php
* @brief		This file contains the implementation of the TestController
* @path			\App\Http\Controllers\Tenant
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Http\Controllers\Tenant\Test;
use App\Http\Controllers\Controller;

// Controller
use App\Http\Controllers\Landlord\ProvisionController;

// Models
use App\Models\User;
use App\Models\Tenant\Prl;
use App\Models\Tenant\Pol;
use App\Models\Landlord\Service;
use App\Models\Tenant\Invoice;
use App\Models\Landlord\Account;
use App\Models\Tenant;
use App\Helpers\Tenant\Akk;

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

use App\Enum\EntityEnum;
use App\Enum\Tenant\EventEnum;
use App\Helpers\Tenant\ChartData;

#Jobs
use App\Jobs\Tenant\RecordDeptBudgetUsage;

use Exception;
use Illuminate\Support\Facades\Session;
use Stancl\Tenancy\Resolvers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TestController extends Controller
{

	public function addTodo($id, $name)
	{
		Log::debug("INSIDE add-todo");
	}

	public function run()
	{
		//https://stackoverflow.com/questions/41758870/how-to-convert-result-table-to-json-array-in-mysql


        return view('tenant.documentations.index');


		Log::debug('Value of config(app.domain)=' . config('app.domain'));
		Log::debug('Value of env(APP_DOMAIN)=' . env('APP_DOMAIN'));

		Log::debug('Value of config(app.url)=' . config('app.url'));
		Log::debug('Value of env(APP_URL)=' . env('APP_URL'));

		Log::debug('Value of env(ASSET_URL)=' . env('ASSET_URL'));

		echo "Done";
		exit;


		//$admin = User::where('role', 'admin')->firstOrFail();
		try {
			 $admin = User::where('role', 'admin1')->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			$admin = User::where('email', config('akk.SYSTEM_EMAIL_ID'))->firstOrFail();
		}

		Log::debug('tenant.test.run admin name = '.$admin->name);
		exit;


		$prId = '1002';
		//$prls	= Prl::all()->where('pr_id', $prId);
		$prls	= Prl::where('pr_id', $prId)->get();
		foreach ($prls as $prl) {
			Log::debug('tenant.model.pr.insertPrlsIntoPols max prl line_num $prl->id = '.$prl->id);
			Log::debug('tenant.model.pr.insertPrlsIntoPols max prl line_num $prl->item_description = '.$prl->item_description);
		}

		exit;

		$poId = '1033302';
		Log::debug('tenant.test.run max prl poId = '.$poId);
		// get last line num from POL
		$last_pol_line_num = Pol::where('po_id', $poId )->max('line_num');
		Log::debug('tenant.test.run max prl line_num = '.$last_pol_line_num);
		if (empty($last_pol_line_num)){
			Log::debug('tenant.test.run max YES Empty');
		}

		exit;



		$invoiceId='1002';

		$data = Invoice::select('id','currency','amount','invoice_date','summary','supplier_id','po_id')->where('id', $invoiceId)->first();
		Log::debug('Value of data=' . $data);

		$sql = "SELECT id,currency,amount FROM invoices WHERE id = '1002'";
		Log::debug('Value of sql=' . $sql);
		$result = DB::selectOne($sql);
		Log::debug('Value of result id =' . $result->id);


		$sql = "SELECT JSON_OBJECT('id',id,'currency',currency) as 'aa' FROM invoices WHERE id = '1002'";
		Log::debug('Value of sql=' . $sql);
		$result = DB::select($sql);

		//$rows = [];
		foreach ($result as $row) {
			Log::debug('Value of rows=' . $row->aa);
			//Log::debug('Value of rows=' . print_r($row['aa']));
			// $rows[] = [
			// 'id'			=> $row['id'],
			// 'currency'	=> $row['currency'],
			// ];
		}

		//Log::debug('Value of rows=' . print_r($rows));

		exit;



		//$data = Invoice::select('id','currency','summary','supplier_id')->with('supplier:id,name')->where('id', $id)->first();
		//$data = Invoice::select('id','currency','summary','supplier_id','po_id')->with('supplier:id,name')->with('po:id,summary')->where('id', $invoiceId)->first();

		//SELECT JSON_ARRAYAGG(JSON_OBJECT('name', name, 'phone', phone)) from Person;

		//$sql = "SELECT JSON_OBJECT('id',id,'currency',currency,'amount',amount) FROM invoices WHERE id = '1002'";

		// $sql = "
		// SELECT CONCAT(
		// '[',
		// GROUP_CONCAT(JSON_OBJECT('id', id, 'currency', currency)),
		// ']'
		// )
		// FROM invoices WHERE id = '1002'
		// ";

		$sql = "SELECT 'id','currency','amount' FROM invoices WHERE id = '1002'";
		Log::debug('Value of sql=' . $sql);
		$result = DB::select($sql);


		$rows = [];
		foreach ($result as $row) {
			$rows[] = [
				'id' => $row['id'],
				'currency' => $row['text'],
			];
		}


		// works
		$data = [];
		foreach($result as $r){
			$data[] = $r;
		}

		//dd($data);
		$response			= [];
		$response['data'] 	= $data;


		// works
		$dataArray = json_decode(json_encode($result), true);
		dd($dataArray);
		Log::debug('Value of dataArray=' . $dataArray);

		exit;
		dd($data2);
		Log::debug('Value of data2=' . json_encode($data2));

		$data = Invoice::select('id','currency','amount','invoice_date','summary','supplier_id','po_id')->with('supplier:id,name')->with('po:id,summary')->where('id', $invoiceId)->first();
		Log::debug('Value of data=' . $data);

		exit;
		return response()->json($data);

		//Log::error(tenant('id'). ' tenant.budget.attach1 user_id = '. DomainTenantResolver::currentDomain );
		//Log::error(tenant('id'). \Stancl\Tenancy\Resolvers\DomainTenantResolver::class->currentDomain);
		//Log::error(tenant('id'). Tenant::find(tenant('id'))->path());
		//$aa= Tenant::find(tenant('id')->path());
		//$aa= Tenancy::find('b07aa3b0-dc68-11e9-9352-9159b2055c42')
		//$aa= Tenancy::find(tenant('id'));

		//dd(tenant()->where('id',tenant('id'))->with('domains'));
		//dd(tenant()->where('id',tenant('id'))->domains(tenant('id')));
		// ok

		//Log::debug('domain='.getDomainName());
		Log::debug('domain='.Akk::getDomainName());

		//dd(tenant()->domains->first()->domain);

		//Log::debug('tenant='.tenant('id'));
		//Log::debug('domain='.tenant('id')->domains()->domain);
		//Log::debug('domain='. Akk::getDomainFromTenantId(tenant('id')));

		exit;


		// Unhandled Exception handing
		//try {
			$id='100111';
			$user = User::where('id', $id )->get()->firstOrFail();
			Log::info('tenant.test.run '. $user->name);
		//} catch (Exception $e) {
			//Log::error(tenant('id'). ' tenant.budget.attach1 user_id ='. $id. ' Message = '. print_r($e->getMessage(),true));
			//Log::error(tenant('id'). ' tenant.budget.attach1 user_id ='. $id. ' Message = '. $e->getMessage());
			Log::error(tenant('id'). ' tenant.budget.attach1 user_id = '. $id.' class = '.get_class($e). ' Message = '. $e->getMessage());

			//Log::error(tenant('id'). ' tenant.budget.attach1 user_id ='. $id. ' Message = '. json_encode($e->getMessage(), true));

			//Log::error('class'. get_class($e));
			//Log::error('class'. substr( get_class($e), strrpos( get_class($e),'\\') +1));

			//$error = sprintf('[%s],[%d] ERROR:[%s]', __METHOD__, __LINE__, json_encode($e->getMessage(), true));
			//$errors = Session::get('errors');
			//Log::error($errors);
		//}
		//echo $user->name;
		echo 'Done';

		exit;



		ChartData::budget();
		ChartData::deptBudget();
		ChartData::project();
		ChartData::supplier();
		echo "Done";
		exit;

		return view('tenant.manage.test');
		exit;

		$landlordSetup = tenancy()->central(function ($tenant) {
			return \App\Models\Landlord\Manage\Setup::where('id', 1)->first();
		});
		//dd($landlordSetup);
		Log::debug('count cnt=' . $landlordSetup->name);
		exit;


		$cnt		= Pol::where('po_id','1004')->count();

		Log::debug('count cnt=' . $cnt);
		exit;

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PR->value, 1001, EventEnum::BOOK->value);
		exit;


		$rs= Prl::where('id',1001)->get( array(
			DB::raw('SUM(sub_total) as sub_total'),
			DB::raw('SUM(tax) as tax'),
			DB::raw('SUM(gst) as gst'),
			DB::raw('SUM(amount) as amount'),
		));

		Log::debug('Value of id=' . $rs);
		//Log::debug('Value of tax=' . $r->tax);

		foreach($rs as $r) {
			Log::debug('results sub_total ='. $r['sub_total']);
			Log::debug('results tax ='. $r['tax']);
			Log::debug('results gst ='. $r['gst']);
			Log::debug('results amount ='. $r['amount']);
			}

		$sql = "SELECT SUM(sub_total) as sub_total, SUM(tax) as tax FROM prls WHERE id = :ID";
		$results = DB::select($sql,['ID'=>1001]);

		Log::debug('Value of results=' . print_r($results));
		//Log::debug('Value of tax=' . $result->tax);
		foreach($results as $result) {
			Log::debug('r tax ='. $result['tax']);
			}

		exit;
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
		//		"data": {
		//		"EUR": 0.6794070148,
		//		"USD": 0.7479654271
		//		}
		// }

		// https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_rjxI0w322t8Mgu1ReRztUcoqwqCYEQwyRAnKCpCZ&currencies=EUR%2CUSD%2CCAD
		// {
		//		"data": {
		//			"CAD": 1.3369601907,
		//			"EUR": 0.9083401321,
		//			"USD": 1
		//		}
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


		return redirect('/login')
			->with('error','Account updated successfully');


		// Send notification on new user registration
		//$user = User::where('id', 1001)->first();
		//$user->notify(new UserRegistered($user));
		//return redirect('/home')->with('error','Account updated successfully',$c1,$c2);


		// return redirect()->route('index.index')->with(array('warning' => 'warning message', 'success' => 'success message'));
		//return redirect('/dashboard')->with('status', 'Profile updated!');

		// return redirect()->route('index.index')
		//		->with('warning', 'warning message')
		//		->with('success', 'success message');

		// return redirect()->route('accounts.index')
		//		->with('success','Account updated successfully');

		return redirect('/login')
			->with('error','Account updated successfully');


		// return redirect()->route('pages.success')
		//		->with('success','Account updated successfully');

		// return view('pages.success')
		//		->with('success','Account updated successfully');

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

