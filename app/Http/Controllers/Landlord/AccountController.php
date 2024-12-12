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

use App\Models\Landlord\Manage\Config;
use App\Models\Landlord\Ticket;
//use App\Models\Landlord\Comment;
use App\Models\Landlord\Account;


use App\Models\Landlord\Lookup\Country;
use App\Models\Landlord\Lookup\Product;

use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;
use App\Models\Landlord\Admin\Service;

use App\Models\Landlord\Manage\Checkout;
# 2. Enums
//use App\Enum\UserRoleEnum;
use App\Enum\Landlord\AccountStatusEnum;
//use App\Enum\Landlord\CheckoutStatusEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\FileUpload;
use App\Helpers\EventLog;
# 4. Notifications
use Notification;
use App\Notifications\Landlord\AddonPurchased;
# 5. Jobs
use App\Jobs\Landlord\AddAddon;
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Str;
use DB;
use Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
# 13. FUTURE




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
		$this->authorize('viewAll', Account::class);
		$accounts = Account::with('status')->with('owner')->orderBy('id', 'DESC')->paginate(10);
		return view('landlord.accounts.index', compact('accounts'));

		//$this->authorize('viewAll', Account::class);
		//$accounts = Account::with('status')->with('owner')->byAccount()->orderBy('id', 'DESC')->paginate(10);
		//return view('landlord.accounts.index', compact('accounts'));
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
		//$services = Service::with('account')->byAccount()->orderBy('id', 'ASC')->paginate(10);
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
			$path = Storage::disk('s3l')->put('logo/'.$uploadedImage, file_get_contents($image));

			//resize to thumbnail and upload
			$image_resize = Image::make($image->getRealPath());
			$image_resize->fit(160, 160);
			$path = Storage::disk('s3l')->put('logo/'.$thumbImage, $image_resize->stream()->__toString());

			$request->merge(['logo' => $thumbImage]);
		}


		$account->update($request->all());

		if ($request->input('name') <> $account->name) {
			EventLog::event('account', $account->id, 'update', 'name', $account->dept_id);
		}

		return redirect()->route('dashboards.index')->with('success', 'Account updated successfully');
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
		Log::channel('bo')->info('Deleting Account id = ' . $account_id);
		EventLog::event('account', $account->id, 'deleted', 'id', $account_id);

		$tickets = Ticket::where('account_id', $account_id)->get();
		$tickets->each(function ($tickets) {
			$tickets->comments()->delete();
			$tickets->delete();
		});

		$result = Payment::where('account_id', $account_id)->delete();
		Log::channel('bo')->info('Payment Deleted = ' . $result);

		$result = Invoice::where('account_id', $account_id)->delete();
		Log::channel('bo')->info('Invoice Deleted = ' . $result);

		$result = Service::where('account_id', $account_id)->delete();
		Log::channel('bo')->info('Service Deleted = ' . $result);

		$result = Checkout::where('account_id', $account_id)->delete();
		Log::channel('bo')->info('Checkout Deleted = ' . $result);

		$result = Domain::where('tenant_id', $account->site)->delete();
		Log::channel('bo')->info('Domain Deleted = ' . $result);

		$result = Tenant::where('id', $account->site)->delete();
		Log::channel('bo')->info('Tenant Deleted = ' . $result);

		$result = Account::where('id', $account_id)->delete();
		Log::channel('bo')->info('Account Deleted = ' . $result);

		$result = User::where('account_id', $account->id)->delete();
		Log::channel('bo')->info('User Deleted = ' . $result);

		return redirect()->route('accounts.index')->with('success', 'Account Deleted successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Account $account
	 * @return \Illuminate\Http\Response
	 */
	public function tenant(Account $account)
	{
		$this->authorize('delete', $account);
		if ($account->tenant_id ==''){
			return redirect()->route('accounts.index')->with('error', 'Tenant Id is empty!');
		}

		$tenant = Tenant::find( $account->tenant_id);
		Log::debug('Landlord.Accounts.tenant Updating Tenant Setup enable column for tenant_id='.$tenant->id);


		$result = $tenant->run(function(){
			Log::debug('Landlord.Accounts.tenant Updating Tenant Setup enable column');
			$tenantSetup 			= \App\Models\Tenant\Admin\Setup::first();
			$tenantSetup->fill(['enable'=>!$tenantSetup->enable]);
			$tenantSetup->update();
			}
		);
		// update account $account->tenant_enable
		EventLog::event('tenant', $account->id, $account->tenant_enable, 'id', $account->tenant_id);
		$account->tenant_enable = !$account->tenant_enable;
		$account->update();
		return redirect()->route('accounts.index')->with('success', 'Tenant Status change!');
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Account $account
	 * @return \Illuminate\Http\Response
	 */
	public function reset(Account $account)
	{

		$this->authorize('reset', $account);

		$account_id = $account->id;
		Log::debug('landlord.AccountController.resets reset account_id = '. $account_id);
		Log::debug('landlord.AccountController.resets setting one months back');

		$sql= "
		UPDATE accounts SET
			start_date = DATE_SUB(curdate(), INTERVAL 1 MONTH),
			end_date = curdate(),
			next_bill_generated = false, next_invoice_no = null,
			last_bill_date = DATE_SUB(curdate(), INTERVAL 1 MONTH)
			WHERE id = ".$account_id.";
		";
		//Log::debug('landlord.AccountController.resets reset sql = '. $sql);
		DB::statement($sql);
		return redirect()->route('accounts.all')->with('success', 'Account Reset.');
	}

	public function export()
	{
		$this->authorize('export', Account::class);
		//$data = Size::all()->toArray();
		if (auth()->user()->isBackend()) {
			$data = DB::select("SELECT id, site, name, currency, tagline, address1, address2, city, state, zip, country, website, facebook, linkedin, email, cell, owner_id, primary_product_id, base_mnth, base_user, base_gb, base_price, mnth, user, gb, price, start_date, end_date, last_bill_from_date, last_bill_to_date, bill_generated, bill_gen_date, expired_at, count_user, count_product, used_gb, maintenance, status_code, logo, created_by, created_at, updated_by, updated_at, FROM accounts");
		} elseif (auth()->user()->isAdmin()) {
			$data = DB::select("SELECT id, site, name, currency, tagline, address1, address2, city, state, zip, country, website, facebook, linkedin, email, cell,
				FROM accounts
				WHERE id = " . auth()->user()->account_id);
		} else {
			$data = DB::select("SELECT id, site, name, currency, tagline, address1, address2, city, state, zip, country, website, facebook, linkedin, email, cell,
				FROM accounts
				WHERE id = " . auth()->user()->account_id);
		}

		$dataArray = json_decode(json_encode($data), true);
		// export to CSV
		return Export::csv('accounts', $dataArray);
	}


}

