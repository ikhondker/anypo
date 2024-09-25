<?php

namespace App\Http\Controllers;


use App\Models\Tenant;

use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Http\Controllers\Landlord\HomeController;

# 1. Models
use App\Models\Landlord\Lookup\Product;
use App\Models\Landlord\Manage\Checkout;
# 2. Enums
use App\Enum\LandlordCheckoutStatusEnum;
# 3. Helpers
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
use App\Jobs\Landlord\CreateTenant;
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Str;
use Validator;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
# 13. FUTURE


class TenantController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$tenants = Tenant::latest()->orderBy('id', 'asc')->paginate(20);
		return view('tenants.index', compact('tenants'))->with('i', (request()->input('page', 1) - 1) * 20);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Tenant::class);
		$product = Product::where('id', config('bo.DEFAULT_PRODUCT_ID'))->first();
		return view('tenants.create', compact('product'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreTenantRequest $request)
	{
		$this->authorize('create', Tenant::class);
		
		Validator::extend('without_spaces', function($attr, $value){
			return preg_match('/^\S*$/u', $value);
		});

		$request->validate([
			'site'					=> 'required|alpha_num:ascii|without_spaces|max:10|unique:accounts,site',
			//'name'				=> 'required|max:100',
			'email'					=> 'required|email|max:100|unique:users,email',
			'account_name'			=> 'required|max:100|',
		],[
			'site.required' 		=> 'Site name is Required!',
			'site.unique'			=> 'This site code is already in use. Please try another.',
			'site.without_spaces'	=> 'Whitespace not allowed.',
			'email.unique'			=> 'This email is already registered. Please login first and then purchase this service.',
		]);
		
		// create checkout row
		$sessionId = Str::uuid()->toString();

		$checkout_id = (new HomeController)->createCheckoutForBuy($sessionId, $request->input('site'), $request->input('account_name'), $request->input('email'));
		Log::debug('landlord.TenantController.storee created checkout_id = '. $checkout_id);
		// Write to Log
		EventLog::event('checkout', $checkout_id, 'create');

		// create tenant
		$checkout = Checkout::where('session_id', $sessionId)->first();
		if (!$checkout) {
			throw new NotFoundHttpException();
		}
		if ($checkout->status_code == LandlordCheckoutStatusEnum::DRAFT->value) {
			Log::debug('landlord.home.success checkout_id = '. $checkout->id);
			CreateTenant::dispatch($checkout->id); // TODO uncomment
		}
		return redirect()->route('tenants.index')->with('success', 'Tenant '.$request->input('site').' created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Tenant $tenant)
	{
		$this->authorize('view', $tenant);
		return view('tenants.show', compact('tenant'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Tenant $tenant)
	{
		$this->authorize('update', $tenant);
		return view('tenants.edit', compact('tenant'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTenantRequest $request, Tenant $tenant)
	{
		$this->authorize('update', $tenant);


		$tenant->update($request->all());

		// Write to Log
		EventLog::event('tenant', $tenant->id, 'update', 'name', $request->name);

		return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Tenant $tenant)
	{
		//
	}

	/**
	 *
	 * Export selected column to csv format
	 *
	 */
	public function export()
	{

		//$data = Uom::all()->toArray();
		$data = DB::select("SELECT a.id, a.object_name, a.object_id, a.event_name ,a.column_name, a.prior_value, a.url,a.role, a.user_id, a.created_at
				 FROM activities a
				 ");

		$dataArray = json_decode(json_encode($data), true);

		// export to CSV
		return exportCSV('activities', $dataArray);
	}
}
