<?php
/**
 * ==================================================================================
 * @version v1.0
 * ==================================================================================
 * @file        SetupController.php
 * @brief       This file contains the implementation of the SetupController class.
 * @author      Iqbal H. Khondker
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
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
# 2. Enums
use App\Helpers\EventLog;
use App\Helpers\FileUpload;
//use App\Helpers\Export;
# 3. Helpers
# 4. Notifications
# 5. Jobs
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
			$extension		='.'.$image->extension();
			
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


		$setup->update($request->all());

		// Write to Log
		EventLog::event('setup', $setup->id, 'update', 'name', $request->name);

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

		// check box
		if($request->has('show_banner')) {
			//Checkbox checked
			$request->merge(['show_banner' => 1]);
		} else {
			//Checkbox not checked
			$request->merge([ 'show_banner' => 0]);
		}

		$setup->update($request->all());

		// Write to Log
		EventLog::event('setup', $setup->id, 'update', 'show_banner', $request->show_banner);

		return redirect()->route('setups.show', $setup->id)->with('success', 'Announcement setting saved.');
	}

	public function freeze(Request $request, Setup $setup)
	{
		$this->authorize('update', $setup);

		$base = $request->input('currency');

		Log::debug('tenant.setup.freeze setup->currency='.$setup->currency);
		Log::debug('tenant.setup.freeze request input='.$request->input('currency'));

		// enable that base currency
		$currency = Currency::where('currency', $base)->first();
		$currency->enable = true;
		$currency->save();
		
		// update setup. 
		$request->merge(['freezed'	=> true ]);
		$setup->update($request->all());
		
		// Write to Log
		EventLog::event('setup', $setup->id, 'update', 'name', $request->name);

		return redirect()->route('setups.show', $setup->id)->with('success', 'Setup completed. You may start using this application.');
	}

}
