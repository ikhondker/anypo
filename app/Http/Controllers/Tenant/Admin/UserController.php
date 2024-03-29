<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        UserController.php
 * @brief       This file contains the implementation of the UserController class.
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

use App\Models\User;
use App\Http\Requests\Tenant\Admin\StoreUserRequest;
use App\Http\Requests\Tenant\Admin\UpdateUserRequest;


# 1. Models
use App\Models\Tenant\Lookup\Country;
use App\Models\Tenant\Lookup\Designation;
use App\Models\Tenant\Lookup\Dept;

# 2. Enums
use App\Enum\UserRoleEnum;
# 3. Helpers
use App\Helpers\FileUpload;
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
use Notification;
use App\Notifications\Tenant\UserCreated;  //P2
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
# 13. TODO 
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
		if(auth()->user()->role->value == UserRoleEnum::SYSTEM->value) {
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
		//     ->where('status', 'active')
		//     ->orderBy('id','asc')
		//     ->get();
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
		$request->merge(['seeded'	=> false]);

		// if($request->has('admin')){
		//     //Checkbox checked
		//     $request->merge(['role'     => UserRoleEnum::ADMIN->value ]);
		// }else{
		//     //Checkbox not checked
		//     $request->merge(['role'     => UserRoleEnum::USER->value ]);
		// }

		$random_password			= Str::random(12);
		$request->merge(['password'	=> Hash::make($random_password) ]);
		//Log::channel('bo')->info('password='.$random_password);
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

		
		if ($image = $request->file('file_to_upload')) {
			// $request->validate([
			// 	'file_to_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			// ]);

			// extract the uploaded file
			$image = $request->file('file_to_upload');
		
			$token			= tenant('id') ."-". $user->id . "-" . uniqid();
			$extension		='.'.$image->extension();
			
			$uploadedImage	= $token . "-uploaded" . $extension;
			$thumbImage		= $token. $extension;

			// upload uploaded image
			$path = Storage::disk('s3ta')->put($uploadedImage, file_get_contents($image));
			
			//resize to thumbnail and upload
			$image_resize = Image::make($image->getRealPath());
			$image_resize->fit(160, 160);
			$path =Storage::disk('s3ta')->put($thumbImage, $image_resize->stream()->__toString());

			$request->merge(['avatar' => $thumbImage ]);
		}

		// for non admin role field is not shown
		if ($request->has('role')) {
			Log::debug('tenant.user.update Role Found! Do nothing.');
		} else {
			$request->merge(['role'	=> $user->role->value ]);
			Log::debug('tenant.user.update Role hidden for system users!');
		}
		// P2 add Role update
		if (auth()->user()->role->value <> UserRoleEnum::ADMIN->value) {

		} else {

		}

		
		$user->update($request->all());
		EventLog::event('user', $user->id, 'update', 'name', $request->name);
		if ($request->input('role') <> $user->role) {
			EventLog::event('user', $user->id, 'update', 'role', $user->role);
		}

		return redirect()->route('users.index')->with('success', 'User profile updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(User $user)
	{
		$this->authorize('delete', $user);

		$user->fill(['enable' => !$user->enable]);
		$user->update();

		// Notify User of Enable
		if($user->enable) {
			$action = 'ACTIVATED';
			$actionURL = route('login');
			$account = User::where('id', $user->id)->first();
			$account->notify(new UserActions($account, $action, $actionURL));
		}
		// Write to Log
		EventLog::event('user', $user->id, 'status', 'enable', $user->enable);

		return redirect()->route('users.index')->with('success', 'User Status Updated successfully');

	}


	public function role()
	{
		//$users = User::whereIn('role',['emp','user','supervisor','owner'])->orderBy('id','desc')->paginate(20);
		$users = User::latest()->orderBy('id', 'desc')->paginate(10);
		return view('tenant.admin.users.role', compact('users'));
	}

	// TODO where it is used in tenant?
	public function updaterole(User $user, $role)
	{
		$this->authorize('updaterole', $user);
		$user->role = $role;
		$user->update();

		// update user roles
		//$data = User::find($id);
		//$data->role = $role;
		//dd($user->id);
		//$data->save();
		//use App\MyData as MyData;
		//$myData->where('id', $request->id)->update(['active' => $request->active]);

		// Write to Log
		EventLog::event('user', $user->id, 'updaterole', 'name', $role);
		return redirect()->back()->with(['success' => 'User '.$user->name.' role to ['.$role.'] updated successfully']);
		//return redirect()->route('users.index')->with('success', 'User '.$user->name.' role to ['.$role.'] updated successfully');
	}

	public function password(User $user)
	{
		$this->authorize('changepass', $user);
		
		return view('tenant.admin.users.password', compact('user'));
	}

	public function changepass(Request $request, User $user)
	{

		$this->authorize('changepass', $user);

		//$request->validate();
		// $request->validate([
		// ]);

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
		return redirect()->route('users.index')->with('success', 'User password updated successfully');
	}


	public function export()
	{
		$this->authorize('export', User::class);
		$data = DB::select("
		SELECT u.id, u.name, email, dp.name department,d.name designation, cell, role, IF(u.enable, 'Yes', 'No') as Enable  
			FROM users u, depts dp, designations d
			WHERE u.dept_id=dp.id
			AND u.designation_id=d.id
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);

	}

	public function image($filename)
	{
		//shown as: http://geda.localhost:8000/image/4.jpg
		//$path = storage_path('uploads/' . $filename);
		$path = storage_path('app/public/profile/'. $filename);

		if (!File::exists($path)) {
			abort(404);
			Log::warning('FILE does not exists! '. $filename);
		}

		$file = File::get($path);
		$type = File::mimeType($path);

		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);
		return $response;
	}

	public function impersonate(User $user)
	{
		$this->authorize('impersonate', User::class);

		// stop impersonate to system
		if ($user->role->value == UserRoleEnum::SYSTEM->value) {
			return redirect()->route('users.all')->with('error','You can not impersonate system!');
		}
		
		if ($user->id !== ($original = auth()->user()->id)) {
			session()->put('original_user', $original);
			auth()->login($user);
		}
		EventLog::event('user', $user->id, 'impersonate', 'id', $user->id);
		return redirect('/home');
	}

	public function leaveImpersonate()
	{
		EventLog::event('user', session()->get('original_user'), 'leave-impersonate', 'id', auth()->user()->id);
		auth()->loginUsingId(session()->get('original_user'));
		session()->forget('original_user');

		//return redirect('/home');
		return redirect()->route('users.index')->with('success', 'Logout from impersonate successfully');

	}

}
