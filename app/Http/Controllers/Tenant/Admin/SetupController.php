<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			SetupController.php
* @brief		This file contains the implementation of the SetupController
* @path			\app\Http\Controllers\Tenant\Admin
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
namespace App\Http\Controllers\Tenant\Admin;
use App\Http\Controllers\Controller;

//use App\Models\Setup;
use App\Models\Tenant\Admin\Setup;

use App\Http\Requests\Tenant\Admin\StoreSetupRequest;
use App\Http\Requests\Tenant\Admin\UpdateSetupRequest;

# 1. Models
use App\Models\User;
use App\Models\Tenant\Budget;
use App\Models\Tenant\Lookup\Country;
use App\Models\Tenant\Lookup\Currency;
use App\Models\Tenant\Lookup\BankAccount;

# 2. Enums
use App\Helpers\EventLog;
use App\Helpers\Tenant\FileUpload;
//use App\Helpers\Export;
# 3. Helpers
# 4. Notifications
# 5. Jobs
use App\Jobs\Tenant\ImportAllRate;
# 6. Mails
# 7. Rules
//use App\Rules\Tenant\GlCode;
# 8. Packages
use Image;
# 9. Exceptions
# 10. Events
# 11. Seeded
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Str;
# 12. FUTURE

class SetupController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		abort(403);
		$this->authorize('viewAny', Setup::class);
		$setups = Setup::latest()->orderBy('id', 'desc')->paginate(10);
		return view('tenant.admin.setups.index', compact('setups'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreSetupRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreSetupRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Setup  $setup
	 * @return \Illuminate\Http\Response
	 */
	public function show(Setup $setup)
	{
		$this->authorize('view', $setup);
		return view('tenant.admin.setups.show', compact('setup'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Setup  $setup
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Setup $setup)
	{
		$this->authorize('update', $setup);

		//$currencies = Currency::getAll();
		$countries = Country::All();
		$admins = User::tenantadmin()->get();

		return view('tenant.admin.setups.edit', compact('setup', 'admins', 'countries'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateSetupRequest  $request
	 * @param  \App\Models\Setup  $setup
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateSetupRequest $request, Setup $setup)
	{
		$this->authorize('update', $setup);

		$request->merge([
			'ac_accrual' => Str::upper($request['ac_accrual']),
			'ac_liability' => Str::upper($request['ac_liability']),
		]);

		if ($image = $request->file('file_to_upload')) {
			// $request->validate([
			// 	'file_to_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			// ]);

			// extract the uploaded file
			$image = $request->file('file_to_upload');

			$token			= tenant('id') ."-". $setup->id ."-" . uniqid();
			$extension		= '.'.$image->extension();

			$uploadedImage	= $token . "-uploaded" . $extension;
			$thumbImage		= $token. $extension;

			// upload uploaded image
			$path = Storage::disk('s3t')->put('logo/'.$uploadedImage, file_get_contents($image));

			//resize to thumbnail and upload
			$image_resize = Image::make($image->getRealPath());
			$image_resize->fit(160, 160);
			$path =Storage::disk('s3t')->put('logo/'.$thumbImage, $image_resize->stream()->__toString());

			$request->merge(['logo' => $thumbImage]);
		}
		
		// Write to Log
		EventLog::event('setup', $setup->id, 'update', 'name', $request->name);
		$setup->update($request->all());

		return redirect()->route('setups.show', $setup->id)->with('success', 'Setup updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Setup  $setup
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Setup $setup)
	{
		abort(403);
		//$this->authorize('delete', $setup);
	}

	public function tc(Setup $setup)
	{
		$this->authorize('update', $setup);

		return view('tenant.admin.setups.tc', compact('setup'));
	}

	public function updateTc(Request $request, Setup $setup)
	{
		$this->authorize('update', $setup);

		$setup->update($request->all());

		// Write to Log
		EventLog::event('setup', $setup->id, 'update', 'tc', 'Terms and Conditions');

		return redirect()->route('setups.show', $setup->id)->with('success', 'Terms and Conditions updated.');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Setup  $setup
	 * @return \Illuminate\Http\Response
	 */
	public function notice(Setup $setup)
	{
		$this->authorize('update', $setup);

		return view('tenant.admin.setups.announcement', compact('setup'));
	}

	public function updateNotice(Request $request, Setup $setup)
	{
		$this->authorize('update', $setup);

		Log::debug('tenant.admin.setup.updateNotice updating banner_show.');
		// check box
		if($request->has('banner_show')) {
			//Checkbox checked
			$request->merge(['banner_show' => 1]);
		} else {
			//Checkbox not checked
			$request->merge([ 'banner_show' => 0]);
		}

		$setup->update($request->all());

		// Write to Log
		EventLog::event('setup', $setup->id, 'update', 'banner_show', $request->show_banner);

		return redirect()->route('setups.show', $setup->id)->with('success', 'Announcement setting saved.');
	}

	public function freeze(Request $request, Setup $setup)
	{
		$this->authorize('update', $setup);

		Log::debug('tenant.admin.setup.freeze updating old setup->currency = '.$setup->currency);

		Log::debug('tenant.setup.freeze request input currency = '.$request->input('currency'));
		Log::debug('tenant.setup.freeze request input country = '.$request->input('country'));
		$default_currency = $request->input('currency');
		$default_country = $request->input('country');

		// Enable that default_currency currency
		$currency = Currency::where('currency', $default_currency)->first();
		$currency->enable = true;
		$currency->save();

		// update setup currency and country.
		Log::debug('tenant.admin.setup.freeze freezing setup_id = ' . $setup->id);
		$request->merge(['freezed'	=> true ]);
		$setup->update($request->all());
		Log::debug('tenant.admin.setup.freeze updating setup->currency = '.$setup->currency);

		// Update currency of seeded bank account
		Log::debug('tenant.admin.setup.freeze updating seeded bankAccount currency = '.$setup->currency);
		$bankAccount = BankAccount ::where('id', 1001)->first();
		$bankAccount->ac_name = 'STD-SEEDED-'.$default_currency;
		$bankAccount->currency = $default_currency;
		$bankAccount->country = $default_country;
		$bankAccount->save();

		Log::debug('tenant.admin.setup.freeze updating country for Users, warehouses and suppliers to = '.$default_country);
		// update users country
		DB::statement("UPDATE users 		SET country = '".$default_country."'");
		// update warehouse country
		DB::statement("UPDATE warehouses 	SET country = '".$default_country."'");
		// supplier
		DB::statement("UPDATE suppliers 	SET country = '".$default_country."'");

		// Write to Log
		EventLog::event('setup', $setup->id, 'update', 'name', $request->name);

		Log::debug('tenant.admin.setup.freeze Setup freezed for setup_id = '.$setup->id);
		Log::debug('tenant.dashboards.index Submitting ImportAllRate::dispatch() for the first time');
		ImportAllRate::dispatch();

		return redirect()->route('setups.show', $setup->id)->with('success', 'Setup completed. You may start using this application.');
	}

}
