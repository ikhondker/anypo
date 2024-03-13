<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			AccountController.php
* @brief		This file contains the implementation of the AccountController
* @path			\app\Http\Controllers\Landlord
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

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\StoreAccountRequest;
use App\Http\Requests\Landlord\UpdateAccountRequest;

# 1. Models
use App\Models\User;

use App\Models\Domain;
use App\Models\Tenant;

use App\Models\Landlord\Ticket;
use App\Models\Landlord\Comment;
use App\Models\Landlord\Account;


use App\Models\Landlord\Lookup\Country;
use App\Models\Landlord\Lookup\Product;

use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;
use App\Models\Landlord\Admin\Service;

use App\Models\Landlord\Manage\Checkout;
# 2. Enums
//use App\Enum\UserRoleEnum;
use App\Enum\LandlordCheckoutStatusEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\FileUpload;
use App\Helpers\LandlordEventLog;
# 4. Notifications
use Notification;
use App\Notifications\Landlord\AddonPurchased;
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Support\Facades\Log;
use Image;
use Str;
use Illuminate\Support\Facades\Storage;
# 13. TODO 



class AccountController extends Controller
{
	// define entity constant for file upload and workflow
	public const ENTITY	= 'ACCOUNT';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$accounts = Account::with('status')->with('owner')->byAccount()->orderBy('id', 'DESC')->paginate(10);

		$addons = Product::where('addon', true)->where('enable', true)->orderBy('id', 'ASC')->get();
	

		return view('landlord.accounts.index', compact('accounts','addons'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{
		$this->authorize('viewAll', Account::class);
		$accounts = Account::with('status')->with('owner')->orderBy('id', 'DESC')->paginate(10);
		return view('landlord.accounts.all', compact('accounts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\StoreAccountRequest$request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreAccountRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Account $account
	 * @return \Illuminate\Http\Response
	 */
	public function show(Account $account)
	{
		$this->authorize('view', $account);
		$entity = static::ENTITY;
		return view('landlord.accounts.show', compact('account', 'entity'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Account $account
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Account $account)
	{
		$this->authorize('update', $account);
		$countries = Country::getAll();
		return view('landlord.accounts.edit', compact('account', 'countries'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\UpdateAccountRequest $request
	 * @param \App\Models\Account $account
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateAccountRequest $request, Account $account)
	{
		$this->authorize('update', $account);

		if ($image = $request->file('file_to_upload')) {
			
			// extract the uploaded file
			$image = $request->file('file_to_upload');

			$token			= $account->id . "-" . uniqid();
			$extension		= '.' . $image->extension();

			$uploadedImage	= $token . "-uploaded" . $extension;
			$thumbImage		= $token . $extension;

			// upload uploaded image
			$path = Storage::disk('s3ll')->put($uploadedImage, file_get_contents($image));

			//resize to thumbnail and upload
			$image_resize = Image::make($image->getRealPath());
			$image_resize->fit(160, 160);
			$path = Storage::disk('s3ll')->put($thumbImage, $image_resize->stream()->__toString());

			$request->merge(['logo' => $thumbImage]);
		}


		$account->update($request->all());

		if ($request->input('name') <> $account->name) {
			LandlordEventLog::event('account', $account->id, 'update', 'name', $account->dept_id);
		}

		return redirect()->route('accounts.index')->with('success', 'Account updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Account $account
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Account $account)
	{

		$this->authorize('delete', $account);

		$account_id = $account->id;
		Log::channel('bo')->info('Deleting Account id=' . $account_id);

		$tickets = Ticket::where('account_id', $account_id)->get();
		$tickets->each(function ($tickets) {
			$tickets->comments()->delete();
			$tickets->delete();
		});

		$result = Payment::where('account_id', $account_id)->delete();
		Log::channel('bo')->info('Payment Deleted =' . $result);

		$result = Invoice::where('account_id', $account_id)->delete();
		Log::channel('bo')->info('Invoice Deleted =' . $result);

		$result = Service::where('account_id', $account_id)->delete();
		Log::channel('bo')->info('Service Deleted =' . $result);

		$result = Checkout::where('account_id', $account_id)->delete();
		Log::channel('bo')->info('Checkout Deleted =' . $result);

		$result = Domain::where('tenant_id', $account->site)->delete();
		Log::channel('bo')->info('Domain Deleted =' . $result);

		$result = Tenant::where('id', $account->site)->delete();
		Log::channel('bo')->info('Tenant Deleted =' . $result);

		$result = Account::where('id', $account_id)->delete();
		Log::channel('bo')->info('Account Deleted =' . $result);

		$result = User::where('account_id', $account->id)->delete();
		Log::channel('bo')->info('User Deleted =' . $result);

		return redirect()->route('accounts.index')->with('success', 'Account Deleted successfully');
	}

	public function export()
	{
		$this->authorize('export', Account::class);
		//$data = Size::all()->toArray();
		if (auth()->user()->isSeeded()) {
			$data = DB::select("SELECT id, site, name, currency, tagline, address1, address2, city, state, zip, country, website, facebook, linkedin, email, cell, owner_id, primary_product_id, base_mnth, base_user, base_gb, base_price, mnth, user, gb, price, start_date, end_date, last_bill_from_date, last_bill_to_date, bill_generated, bill_gen_date, expired_at, count_user, count_product, used_gb, maintenance, status_code, logo, created_by, created_at, updated_by, updated_at, FROM accounts");
		} elseif (auth()->user()->isAdmin()) {
			$data = DB::select("SELECT id, site, name, currency, tagline, address1, address2, city, state, zip, country, website, facebook, linkedin, email, cell,
				FROM accounts
				WHERE id=" . auth()->user()->account_id);
		} else {
			$data = DB::select("SELECT id, site, name, currency, tagline, address1, address2, city, state, zip, country, website, facebook, linkedin, email, cell,
				FROM accounts
				WHERE id=" . auth()->user()->account_id);
		}

		$dataArray = json_decode(json_encode($data), true);
		// export to CSV
		return Export::csv('accounts', $dataArray);
	}

	/**
	 * IQBAL Upgrade package. Applicable only for logged-in user
	 */
	public function upgrade($new_service_id)
	{
		// NOTE: current user is logged in and have existing account_id
		// Log::debug("Upgrading account=". $account_id." service_id=".$new_service_id);
		// 0. check if already upgraded
		// 1. disable old service and addon- in account_services
		// 2. created new active services
		// 3. update account with new service id and new resource limit
		// 4. update date of expire (not sure)
		// don't change start or expire ate

		// get current logged-in user account_id
		$account_id		= auth()->user()->account_id;

		// disable existing service and addons
		$update_product = DB::table('account_services')
			->where('account_id', $account_id)
			->where('enable', true)
			->update(['end_date' => now(), 'enable' => false]);

		// create new AccountService
		$service = Service::where('id', $new_service_id)->first();

		$accountService					= new AccountService();

		$accountService->service_id		= $new_service_id;
		$accountService->name			= $service->name;

		$accountService->account_id		= $account_id;
		$accountService->owner_id		= auth()->user()->id;

		$accountService->mnth			= $service->mnth;
		$accountService->user			= $service->user;
		$accountService->gb				= $service->gb;
		$accountService->price			= $service->price;
		$accountService->start_date		= now();
		//$accountService->end_date		= now()->addMonth($service->mnth);
		$accountService->save();

		//$account_service_id			= $accountService->id;
		//Log::debug('Account Service Created id='. $accountService->id);
		LandlordEventLog::event('accountService', $accountService->id, 'create');

		// Find and update the account with new parameter
		$account = Account::where('id', $account_id)->first();
		$account->service_id		= $new_service_id;
		$account->owner_id			= auth()->user()->id;

		$account->base_mnth			= $service->mnth;
		$account->base_user			= $service->user;
		$account->base_gb			= $service->gb;
		$account->base_price		= $service->price;

		$account->mnth				= $service->mnth;
		$account->user				= $service->user;
		$account->gb				= $service->gb;
		$account->price				= $service->price;

		$account->save();
		LandlordEventLog::event('account', $account->id, 'updated');

		// Send notification on service upgrade
		$user = User::where('id', auth()->user()->id)->first();
		$user->notify(new ServiceUpgraded($user, $account));

		return redirect()->route('services.index')->with('success', 'Addon added successfully.');
	}

	/**
	 * IQBAL add-addon package when no payment is needed
	*/

	public function addAddon($account_id, $addon_id)
	{

		Log::channel('bo')->info('Buying new addon account='. $account_id . ' product_id=' . $addon_id);

		if (auth()->user()->account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not generate Invoice as no valid Account Found!');
		}

		// update account with user+GB+service name
		$account			= Account::where('id', $account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('landlord.invoice.create Unpaid invoice exists for Account #' . $account->id . ' Invoice not created.');
			return redirect()->route('invoices.index')->with('error', 'Unpaid invoice exists for Account id=' . $account->id . '! Can not create more Invoices.');
		}
	
		// get product
		$product = Product::where('id', $addon_id)
			->where('addon', true)
			->where('enable', true)
			->first();

		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

		$lineItems = [];
		$lineItems[] = [
			'price_data' => [
				'currency' => 'usd',
				'product_data' => [
					'name' => $product->name,
					// 'images' => [$product->image]
				],
				'unit_amount' => $product->price * 100,
			],
			'quantity' => 1,
		];

		$session = \Stripe\Checkout\Session::create([
			'line_items' => $lineItems,
			'mode' => 'payment',
			'success_url' => route('checkout.success-addon', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'cancel_url' => route('checkout.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
			'metadata' 	=> ['trx_type' => 'ADDON'],
		]);

		// create checkout row
		$checkout					= new Checkout;
		$checkout->addon			= true;
		$checkout->session_id		= $session->id;
		$checkout->checkout_date	= date('Y-m-d H:i:s');

		$checkout->site				= $account->site;
		$checkout->account_name		= $account->name;
		$checkout->existing_user	= true;
		$checkout->owner_id			= auth()->user()->id;
		$checkout->email			= auth()->user()->email;
		$checkout->address1			= auth()->user()->address1;
		$checkout->address2			= auth()->user()->address2;
		$checkout->city				= auth()->user()->city;
		$checkout->state			= auth()->user()->state;
		$checkout->zip				= auth()->user()->zip;
		$checkout->country			= auth()->user()->country;

		// get product
		$checkout->product_id		= $product->id;
		$checkout->product_name		= $product->name;
		$checkout->tax				= $product->tax;
		$checkout->vat				= $product->vat;
		$checkout->price			= $product->price;
		$checkout->mnth				= $product->mnth;
		$checkout->user				= $product->user;
		$checkout->gb				= $product->gb;

		$checkout->start_date		= now();
		$checkout->end_date			= now()->addMonth($product->mnth);

		$checkout->status_code		= LandlordCheckoutStatusEnum::DRAFT->value;
		$checkout->ip				= '127.0.0.1';

		$checkout->save();

		return redirect($session->url);

	}	
	public function oldaddAddon($account_id, $addon_id)
	{

		Log::channel('bo')->info('Buying new addon account='. $account_id . ' product_id=' . $addon_id);

		// add addon to Service
		$addon = Product::where('id', $addon_id)
			->where('addon', true)
			->where('enable', true)
			->first();

		// update account with user+GB+service name
		$account			= Account::where('id', $account_id)->first();

		$account->user		= $account->user + $addon->user;
		$account->gb		= $account->gb + $addon->gb;
		$account->price		= $account->price + $addon->price;
		$account->save();
		Log::channel('bo')->info('Account qty updated for account_id=' .  $account->id);

		LandlordEventLog::event('account', $account->id, 'update', 'user', $account->user);
		LandlordEventLog::event('account', $account->id, 'update', 'gb', $account->gb);
		LandlordEventLog::event('account', $account->id, 'update', 'price', $account->price);

		// add service row
		$service				= new Service();
		$service->addon			= true;
		$service->product_id	= $addon->id;
		$service->name			= $addon->name;
		$service->name			= $addon->name;
		$service->account_id	= $account->id;
		$service->owner_id		= $account->owner_id;
		$service->mnth			= $addon->mnth;
		$service->user			= $addon->user;
		$service->gb			= $addon->gb;
		$service->price			= $addon->price;

		$service->start_date	= now();
		$service->save();

		Log::channel('bo')->info('New Service added=' .  $service->id);

		LandlordEventLog::event('service', $service->id, 'created');

		// Send notification on add-on bought
		$user = User::where('id', auth()->user()->id)->first();
		$user->notify(new AddonPurchased($user, $account));

		return redirect()->route('services.index')->with('success', 'Addon added to account successfully.');
	}
}
