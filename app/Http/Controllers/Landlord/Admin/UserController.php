<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			UserController.php
* @brief		This file contains the implementation of the UserController
* @path			\app\Http\Controllers\Landlord\Admin
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

namespace App\Http\Controllers\Landlord\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Landlord\Admin\StoreUserRequest;
use App\Http\Requests\Landlord\Admin\UpdateUserRequest;

# 1. Models
use App\Models\User;
use App\Models\Landlord\Lookup\Country;
use App\Models\Landlord\Account;
# 2. Enums
use App\Enum\UserRoleEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\Landlord\FileUpload;
use App\Helpers\EventLog;
# 4. Notifications
use Notification;
use App\Notifications\Landlord\UserCreated;
use Illuminate\Auth\Events\Registered;
# 5. Jobs
# 6. Mails
use Mail;
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Str;
use DB;
# 13. FUTURE
use App\Exceptions\CustomException;

class UserController extends Controller
{
	// used to export data into csv
	//use ExportTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//throw new CustomException('An unexpected error has occurred.');
		//abort(500);
		$users = User::query();
		if (request('term')) {
			$users->where('name', 'Like', '%' . request('term') . '%');
		}

		//Log::debug("landlord.users.index role = ".auth()->user()->role->value);

		switch (auth()->user()->role->value) {
			case UserRoleEnum::ADMIN->value:
				$users= $users->with('account')->byAccount()->orderBy('created_at', 'DESC')->paginate(10);
				break;
			default:
				$users= $users->with('account')->byUser()->orderBy('created_at', 'DESC')->paginate(10);
				Log::warning("landlord.users.index Other roles!");
		}
		return view('landlord.admin.users.index',compact('users'));
	}




	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create',User::class);
		return view('landlord.admin.users.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreUserRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreUserRequest $request)
	{

		$this->authorize('create', User::class);

		//user settings
		if (auth()->user()->isAdmin()){
			$request->merge(['account_id'	=> auth()->user()->account_id]);
		}
		$request->merge(['enable'		=> true]);

		if($request->has('admin')){
			// Checkbox checked
			$request->merge(['role'		=> UserRoleEnum::ADMIN->value ]);
		}else{
			// Checkbox not checked
			$request->merge(['role'		=> UserRoleEnum::USER->value ]);
		}

		$random_password 				= Str::random(12);
		$request->merge(['password'		=> Hash::make($random_password) ]);

		// create User
		$user = User::create($request->all());

		// Send Verification Email
		event(new Registered($user));

		// Send notification on new user creation
		$user->notify(new UserCreated($user,$random_password));

		EventLog::event('user',$user->id,'create');
		if (auth()->user()->isAdmin()){
			return redirect()->route('users.index')->with('success','User created successfully.');
		} else {
			return redirect()->route('users.all')->with('success','User created successfully.');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		$this->authorize('view', $user);
		return view('landlord.admin.users.show',compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		$this->authorize('update', $user);
		return view('landlord.admin.users.edit',compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateUserRequest  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateUserRequest $request, User $user)
	{

		$this->authorize('update', $user);
		$request->merge(['state'	=> Str::upper($request->input('state')) ]);
		$request->validate([

		]);

		if ($image = $request->file('file_to_upload')) {
			// extract the uploaded file
			$image = $request->file('file_to_upload');

			$token			= $user->id ."-" . uniqid();
			$extension		= '.'.$image->extension();

			$uploadedImage	= $token . "-uploaded" . $extension;
			$thumbImage		= $token. $extension;

			// upload uploaded image
			$path = Storage::disk('s3l')->put('avatar/'.$uploadedImage, file_get_contents($image));

			//resize to thumbnail and upload
			$image_resize = Image::make($image->getRealPath());
			$image_resize->fit(160, 160);
			$path =Storage::disk('s3l')->put('avatar/'.$thumbImage, $image_resize->stream()->__toString());

			$request->merge(['avatar' => $thumbImage ]);
		}


		// for non admin role field is not shown
		if ($request->has('role') && (auth()->user()->isAdmin()) ) {
			Log::debug('landlord.user.update Role dropdown shown! Update role.');
			$request->merge(['role'	=> $request->input('role') ]);
		} else {
			Log::debug('landlord.user.update Role hidden from non admin user!. Do nothing');
			//$request->merge(['role'	=> $user->role->value ]);
		}

		$user->update($request->all());
		EventLog::event('user',$user->id,'update','name', $request->name);
		return redirect()->route('users.show',$user->id)->with('success','User profile updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{

		$this->authorize('delete', $user);

		$user->fill(['enable'=>!$user->enable]);

		$user->update();

		// Write to Log
		EventLog::event('user',$user->id,'status','enable',$user->enable);

		return redirect()->route('dashboards.index')->with('success','User Status Updated successfully');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all(Account $account = null)
	{

		$this->authorize('viewAll', User::class);

		$users = User::query();
		if (request('term')) {
			$users->where('name', 'Like', '%' . request('term') . '%');
		}

		if ($account == '') {
			// here the parameter doesn't exist
			$users= $users->with('account')->orderBy('created_at', 'DESC')->paginate(10);

		} else {
			$users= $users->with('account')
				->where('account_id',$account->id)
				->orderBy('created_at', 'DESC')->paginate(10);
		}


		return view('landlord.admin.users.all',compact('users'));
	}


	public function changePassword(User $user)
	{
		$this->authorize('changepass',$user);

		Log::debug('landlord.users.changePassword Role = '. auth()->user()->role->value);

		return view('landlord.admin.users.password-change',compact('user'));
	}

	public function updatePassword(Request $request, User $user)
	{
		$this->authorize('update',$user);
		//$this->authorize('changepass',$user);

		$request->validate([
			'password1' => 'required|min:8',
			'password2' => 'same:password1|min:8',
		]);

		//dd($request->password1);
		//$user->password = bcrypt($request->password1);
		$user->password = Hash::make($request->password1);
		$user->update();

		// Write to Log
		EventLog::event('user',$user->id,'update','password',$request->id);
		return redirect()->route('dashboards.index')->with('success','User password updated successfully');
	}

	public function export()
	{
		$this->authorize('export', User::class);

		if (auth()->user()->isBackend()){
			$data = DB::select("SELECT id, name, email, cell, role,account_id,IF(enable, 'Yes', 'No') as Enable
				FROM users");
		} else if (auth()->user()->isAdmin()){
			$data = DB::select("SELECT id, name, email, cell, role,account_id, IF(enable, 'Yes', 'No') as Enable
				FROM users
				WHERE account_id = ".auth()->user()->account_id);
		} else {
			$data = DB::select("SELECT id, name, email, cell, role,account_id, IF(enable, 'Yes', 'No') as Enable
				FROM users
				WHERE id = ".auth()->user()->id);
		}

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function profile()
	{
		///$this->authorize('create', User::class);
		$user = User::where('id', auth()->user()->id)->first();
		return view('landlord.profile.profile',compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function editProfile()
	{
		$user = User::where('id', auth()->user()->id)->first();
		//$this->authorize('update', $user);

		$countries = Country::All();
		//$designations = Designation::primary()->get();
		//$depts = Dept::primary()->get();

		return view('landlord.profile.edit-profile', compact('user', 'countries'));
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

			$token			= landlord('id') ."-". $user->id . "-" . uniqid();
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
		return view('landlord.profile.profile-password', compact('user'));
	}

	public function updateProfilePassword(Request $request)
	{

		$user = User::where('id', auth()->user()->id)->first();

		//$this->authorize('changepass', $user);

		$request->validate([
			'password1' => ['required'],
			'password2' => ['same:password1'],
		]);

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

		Log::debug('Landlord.user.impersonate loggedin_user_id = ' . auth()->user()->id);
		Log::debug('Landlord.user.impersonate to_impersonated_user_id = ' . $user->id);

		// log before impersonate
		EventLog::event('user', $user->id, 'impersonate', 'id', $user->id);

		if ($user->id <= 1008 ) {
			if( auth()->user()->role->value <> UserRoleEnum::SYS->value){
				return redirect()->route('users.all')->with('error','You can not impersonate any seeded users!');
			}
		}

		if ($user->role->value == UserRoleEnum::SYS->value) {
			return redirect()->route('users.all')->with('error','You can not impersonate system!');
		}

		if ($user->id !== ($original = auth()->user()->id)) {
			session()->put('original_user', $original);
			auth()->login($user);
		}

		return redirect('/dashboards');

	}

	public function leaveImpersonate()
	{
		$impersonated_user_id = auth()->user()->id;

		auth()->loginUsingId(session()->get('original_user'));
		session()->forget('original_user');

		Log::debug('Landlord.user.leaveImpersonate loggedin_user_id = ' . auth()->user()->id);
		Log::debug('Landlord.user.leaveImpersonate impersonated_user_id = ' . $impersonated_user_id);

		// log after leave Impersonate
		EventLog::event('user', $impersonated_user_id, 'leave-impersonate', 'id', auth()->user()->id);


		return redirect('/dashboards');
	}
}
