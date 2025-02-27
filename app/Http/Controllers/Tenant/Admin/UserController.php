<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			UserController.php
* @brief		This file contains the implementation of the UserController
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

use App\Models\User;
use App\Http\Requests\Tenant\Admin\StoreUserRequest;
use App\Http\Requests\Tenant\Admin\UpdateUserRequest;


# 1. Models
use App\Models\Tenant\Lookup\Country;
use App\Models\Tenant\Lookup\Designation;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Admin\Setup;
# 2. Enums
use App\Enum\UserRoleEnum;
# 3. Helpers
use App\Helpers\Tenant\FileUpload;
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
use Notification;
use App\Notifications\Tenant\UserCreated; //TODOP2
use Illuminate\Auth\Events\Registered;
use App\Notifications\Tenant\UserActions;
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
use Image;
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Str;
use DB;
# 13. FUTURE
# 1. create a new role PM for projects
# 2. layout chang for edit user page role change

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', User::class);

		$users = User::query();
		if (request('term')) {
			$users->where('name', 'Like', '%' . request('term') . '%');
		}
		//Log::debug("tenant.user.index role=".auth()->user()->role->value);

		//$users = User::latest()->orderBy('id','desc')->paginate(10);
		if(auth()->user()->role->value == UserRoleEnum::SYS->value) {
			$users = $users->with('dept')->with('designation')->orderBy('id', 'DESC')->paginate(10);
		} else {
			$users = $users->with('dept')->with('designation')->TenantAll()->orderBy('id', 'DESC')->paginate(10);
		}

		return view('tenant.admin.users.index', compact('users'));
	}



	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', User::class);

		// $emps = Emp::select('id','name')
		//		->where('status', 'active')
		//		->orderBy('id','asc')
		//		->get();
		//$emps = Emp::getAll();

		return view('tenant.admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreUserRequest $request)
	{
		$this->authorize('create', User::class);

		//user settings
		//$request->merge(['account_id' => auth()->user()->account_id]);
		$request->merge(['enable'	=> true]);
		$request->merge(['backend'	=> false]);

		// if($request->has('admin')){
		// // Checkbox checked
		//		$request->merge(['role'	=> UserRoleEnum::ADMIN->value ]);
		// }else{
		//		//Checkbox not checked
		//		$request->merge(['role'	=> UserRoleEnum::USER->value ]);
		// }

		$random_password			= Str::random(12);
		$request->merge(['password'	=> Hash::make($random_password) ]);
		//Log::channel('bo')->info('password = '.$random_password);
		//$request->merge(['email_verified_at' => now()]);

		// create User
		$user = User::create($request->all());
		if ($user) {

			// Send Verification Email
			event(new Registered($user));

			// Send notification on new user creation
			$user->notify(new UserCreated($user, $random_password));

			EventLog::event('user', $user->id, 'create');

			return redirect()->route('users.index')->with('success', 'User created successfully.');
		} else {
			return redirect()->route('users.index')->with('error', 'User creation failed!');
		}


	}

	/**
	 * Display the specified resource.
	 */
	public function show(User $user)
	{
		$this->authorize('view', $user);

		return view('tenant.admin.users.show', compact('user'));
	}




	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(User $user)
	{
		$this->authorize('update', $user);

		$countries = Country::All();
		$designations = Designation::primary()->get();
		$depts = Dept::primary()->get();

		return view('tenant.admin.users.edit', compact('user', 'countries', 'designations','depts'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateUserRequest $request, User $user)
	{
		$this->authorize('update', $user);
		$request->merge(['state'	=> Str::upper($request->input('state')) ]);

		if ($image = $request->file('file_to_upload')) {
			// $request->validate([
			// 	'file_to_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			// ]);

			// extract the uploaded file
			$image = $request->file('file_to_upload');

			$token			= tenant('id') ."-". $user->id . "-" . uniqid();
			$extension		= '.'.$image->extension();

			$uploadedImage	= $token . "-uploaded" . $extension;
			$thumbImage		= $token. $extension;

			// upload uploaded image
			$path = Storage::disk('s3t')->put('avatar/'.$uploadedImage, file_get_contents($image));

			//resize to thumbnail and upload
			$image_resize = Image::make($image->getRealPath());
			$image_resize->fit(160, 160);
			$path =Storage::disk('s3t')->put('avatar/'.$thumbImage, $image_resize->stream()->__toString());

			$request->merge(['avatar' => $thumbImage ]);
		}

		// for non admin role field is not shown. add Role update
		if ($request->has('role') && (auth()->user()->isAdmin()) ) {
			Log::debug('tenant.user.update Role dropdown shown! Update role.');
			$request->merge(['role'	=> $request->input('role') ]);
		} else {
			Log::debug('tenant.user.update Role hidden from non admin user!. Do nothing');
			//$request->merge(['role'	=> $user->role->value ]);
		}


		EventLog::event('user', $user->id, 'update', 'name', $request->name);
		$user->update($request->all());

		if ($request->input('role') <> $user->role) {
			EventLog::event('user', $user->id, 'update', 'role', $user->role);
		}

		return redirect()->route('users.show',$user->id)->with('success', 'User profile updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(User $user)
	{
		$this->authorize('delete', $user);


		$setup = Setup::first();
		if ($setup->demo){
			return redirect()->route('users.index')->with('error', config('akk.MSG_DEMO'));
		}

		$user->fill(['enable' => !$user->enable]);
		$user->update();

		// Notify User of Enable
		if($user->enable) {
			$action = 'ACTIVATED';
			$actionURL = route('login');
			$activatedUser = User::where('id', $user->id)->first();
			$activatedUser->notify(new UserActions($activatedUser, $action, $actionURL));
		}
		// Write to Log
		EventLog::event('user', $user->id, 'status', 'enable', $user->enable);

		return redirect()->route('users.index')->with('success', 'User Status Updated successfully');

	}

	/**
	 * Display the specified resource.
	 */
	public function timestamp(User $user)
	{
		$this->authorize('view', $user);

		return view('tenant.admin.users.timestamp', compact('user'));
	}

	/**
	 * Display a listing of the resource.
	 */
	public function switch()
	{
		$this->authorize('viewAny', User::class);

		if(auth()->user()->role->value == UserRoleEnum::SYS->value) {
			$users = User::with('dept')->with('designation')->orderBy('name', 'ASC')->paginate(25);
		} else {
			$users = User::with('dept')->with('designation')->TenantAll()->orderBy('id', 'DESC')->paginate(10);
		}
		return view('tenant.admin.users.switch', compact('users'));
	}


	public function export()
	{
		$this->authorize('export', User::class);

		if ( auth()->user()->isBackend()) {
			$data = DB::select("
			SELECT u.id, u.name, email, dp.name department,d.name designation, cell, role, IF(u.enable, 'Yes', 'No') as Enable
				FROM users u, depts dp, designations d
				WHERE u.dept_id=dp.id
				AND u.designation_id=d.id
				");
		} else {
			$data = DB::select("
			SELECT u.id, u.name, email, dp.name department,d.name designation, cell, role, IF(u.enable, 'Yes', 'No') as Enable
				FROM users u, depts dp, designations d
				WHERE u.dept_id=dp.id
				AND u.designation_id=d.id
				AND u.backend = 0
				");
		}
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);

	}

	public function changePassword(User $user)
	{
		$this->authorize('changepass', $user);

		return view('tenant.admin.users.password', compact('user'));
	}

	public function updatePassword(Request $request, User $user)
	{

		$this->authorize('changepass', $user);

		$request->validate([
			'password1' => ['required'],
			'password2' => ['same:password1'],
		]);

		$setup = Setup::first();
		if ($setup->demo){
			return redirect()->route('users.show',$user->id)->with('error', config('akk.MSG_DEMO'));
		}

		//dd($request->password1);
		//$user->password = bcrypt($request->password1);
		$user->password = Hash::make($request->password1);
		$user->update();

		// Write to Log
		EventLog::event('user', $user->id, 'update', 'password', $request->id);
		return redirect()->route('users.show',$user->id)->with('success', 'User password updated successfully.');
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function profile()
	{
		///$this->authorize('create', User::class);
		$user = User::where('id', auth()->user()->id)->first();
		return view('tenant.profile.profile',compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function editProfile()
	{
		$user = User::where('id', auth()->user()->id)->first();
		//$this->authorize('update', $user);

		$countries = Country::All();
		$designations = Designation::primary()->get();
		$depts = Dept::primary()->get();

		return view('tenant.profile.edit-profile', compact('user', 'countries', 'designations','depts'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function updateProfile(Request $request)
	{

		$user = User::where('id', auth()->user()->id)->first();
		//$this->authorize('update', $user);

		$request->validate([
			'name'			=> 'required|min:5|max:100',
			'cell'			=> 'required|max:20|unique:users,cell,'. $user->id,
			'facebook'		=> 'nullable|url' ,
			'linkedin'		=> 'nullable|url',
			'file_to_upload'=> 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024'
		],[
			'name.required' 		=> 'Name is Required!',
			'cell.unique'			=> 'This cell number is already in use!',
		]);

		$request->merge(['state'	=> Str::upper($request->input('state')) ]);

		if ($image = $request->file('file_to_upload')) {
			// $request->validate([
			// 	'file_to_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			// ]);

			// extract the uploaded file
			$image 			= $request->file('file_to_upload');

			$token			= tenant('id') ."-". $user->id . "-" . uniqid();
			$extension		= '.'.$image->extension();

			$uploadedImage	= $token . "-uploaded" . $extension;
			$thumbImage		= $token. $extension;

			// upload uploaded image
			$path = Storage::disk('s3t')->put('avatar/'.$uploadedImage, file_get_contents($image));

			//resize to thumbnail and upload
			$image_resize = Image::make($image->getRealPath());
			$image_resize->fit(160, 160);
			$path =Storage::disk('s3t')->put('avatar/'.$thumbImage, $image_resize->stream()->__toString());

			$request->merge(['avatar' => $thumbImage ]);
		}

		$user->update($request->all());
		EventLog::event('user', $user->id, 'update', 'name', $request->name);
		return redirect()->route('users.profile')->with('success', 'User profile updated successfully.');
	}

	public function profilePassword()
	{
		$user = User::where('id', auth()->user()->id)->first();
		//$this->authorize('changepass', $user);
		return view('tenant.profile.profile-password', compact('user'));
	}

	public function updateProfilePassword(Request $request)
	{

		$user = User::where('id', auth()->user()->id)->first();

		//$this->authorize('changepass', $user);

		$request->validate([
			'password1' => ['required'],
			'password2' => ['same:password1'],
		]);

		$setup = Setup::first();
		if ($setup->demo){
			return redirect()->route('users.profile',$user->id)->with('error', config('akk.MSG_DEMO'));
		}

		//dd($request->password1);
		//$user->password = bcrypt($request->password1);
		$user->password = Hash::make($request->password1);
		$user->update();

		// Write to Log
		EventLog::event('user', $user->id, 'update', 'password', $request->id);
		return redirect()->route('users.profile')->with('success', 'User password updated successfully.');
	}

	public function impersonate(User $user)
	{
		$this->authorize('impersonate', User::class);

		// stop impersonate to system
		if ($user->role->value == UserRoleEnum::SYS->value) {
			return redirect()->route('users.all')->with('error','You can not impersonate system!');
		}

		Log::debug('tenant.admin.user.impersonate loggedin_user_id = ' . auth()->user()->id);
		Log::debug('tenant.admin.user.impersonate to_impersonated_user_id = ' . $user->id);

		// log before impersonate
		EventLog::event('user', $user->id, 'impersonate', 'id', $user->id);

		//Log::debug('Landlord.user.impersonate userr = ' . $user->id);
		if ($user->id !== ($original = auth()->user()->id)) {
			session()->put('original_user', $original);
			auth()->login($user);
		}

		return redirect('/home');
	}

	public function leaveImpersonate()
	{

		$impersonated_user_id = auth()->user()->id;

		// log with original user
		EventLog::event('user', session()->get('original_user'), 'leave-impersonate', 'id', auth()->user()->id);

		auth()->loginUsingId(session()->get('original_user'));
		session()->forget('original_user');

		Log::debug('tenant.admin.user.leaveImpersonate loggedin_user_id = ' . auth()->user()->id);
		Log::debug('tenant.admin.leaveImpersonate impersonated_user_id = ' . $impersonated_user_id);

		// log after leave Impersonate
		EventLog::event('user', $impersonated_user_id, 'leave-impersonate', 'id', auth()->user()->id);

		//return redirect('/home');
		return redirect()->route('users.index')->with('success', 'Logout from impersonate successfully');

	}
}
