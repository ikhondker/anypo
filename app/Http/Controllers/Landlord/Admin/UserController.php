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
use App\Models\Landlord\Country;
# 2. Enums
use App\Enum\UserRoleEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\LandlordFileUpload;
use App\Helpers\LandlordEventLog;
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
# 13. TODO 

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
		$users = User::query();
		if (request('term')) {
			$users->where('name', 'Like', '%' . request('term') . '%');
		}
		Log::debug("landlord.users.index role=".auth()->user()->role->value);

		switch (auth()->user()->role->value) {
			case UserRoleEnum::ADMIN->value:
				$users= $users->byAccount()->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$users= $users->byUser()->orderBy('id', 'DESC')->paginate(10);
				Log::warning("landlord.users.index Other roles!");
		}
		return view('landlord.admin.users.index',compact('users'));
	}


/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{

		$this->authorize('viewAll', User::class);

		$users = User::query();
		if (request('term')) {
			$users->where('name', 'Like', '%' . request('term') . '%');
		}
		$users= $users->orderBy('id', 'DESC')->paginate(20);
		return view('landlord.admin.users.all',compact('users'));
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
		$request->merge(['account_id'	=> auth()->user()->account_id]);
		$request->merge(['enable'		=> true]);
		if($request->has('admin')){
			//Checkbox checked
			$request->merge(['role'		=> UserRoleEnum::ADMIN->value ]);
		}else{
			//Checkbox not checked
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

		LandlordEventLog::event('user',$user->id,'create');
		return redirect()->route('users.index')->with('success','User created successfully.');
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
			$extension		='.'.$image->extension();

			$uploadedImage	= $token . "-uploaded" . $extension;
			$thumbImage		= $token. $extension;

			// upload uploaded image
			$path = Storage::disk('s3la')->put($uploadedImage, file_get_contents($image));

			//resize to thumbnail and upload
			$image_resize = Image::make($image->getRealPath());
			$image_resize->fit(160, 160);
			$path =Storage::disk('s3la')->put($thumbImage, $image_resize->stream()->__toString());

			$request->merge(['avatar' => $thumbImage ]);
		}

		$user->update($request->all());
		LandlordEventLog::event('user',$user->id,'update','name', $request->name);
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
		LandlordEventLog::event('user',$user->id,'status','enable',$user->enable);

		return redirect()->route('users.index')->with('success','User Status Updated successfully');
	}

	public function role()
	{
		$users = User::latest()->orderBy('id','desc')->paginate(10);
		return view('users.role',compact('users'));
	}

	public function updaterole(User $user, $role)
	{
		//TODO Check $this->authorize('updaterole',$user);
		$user->role = $role;
		$user->update();

		// Write to Log
		LandlordEventLog::event('user',$user->id,'updaterole','name',$role);
		return redirect()->route('users.index')->with('success','User '.$user->name.' role to \''.$role.'\' updated successfully');
	}

	public function changePassword(User $user)
	{
		$this->authorize('changepass',$user);

		Log::debug('landlord.users.changePassword Role='. auth()->user()->role->value);

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
		LandlordEventLog::event('user',$user->id,'update','password',$request->id);
		return redirect()->route('dashboards.index')->with('success','User password updated successfully');
	}

	public function export()
	{

		if (auth()->user()->isBackOffice()){
			$data = DB::select("SELECT id, name, email, cell, role,account_id, enable FROM users");
		} else if (auth()->user()->isAdmin()){
			$data = DB::select("SELECT id, name, email, cell, role,account_id, enable
				FROM users
				WHERE account_id=".auth()->user()->account_id);
		} else {
			$data = DB::select("SELECT id, name, email, cell, role,account_id, enable
				FROM users
				WHERE id =".auth()->user()->id);
		}

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}

	public function impersonate(User $user)
	{
		$this->authorize('impersonate', User::class);

		if ($user->id !== ($original = auth()->user()->id)) {
			session()->put('original_user', $original);
			auth()->login($user);
		}
		LandlordEventLog::event('user', $user->id, 'impersonate', 'id', $user->id);
		return redirect('/dashboards');

	}

	public function leaveImpersonate()
	{
		LandlordEventLog::event('user', session()->get('original_user'), 'leave-impersonate', 'id', auth()->user()->id);
		auth()->loginUsingId(session()->get('original_user'));
		session()->forget('original_user');

		return redirect('/dashboards');
	}
}
