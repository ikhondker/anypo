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

namespace App\Http\Controllers\Landlord\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Landlord\Admin\StoreUserRequest;
use App\Http\Requests\Landlord\Admin\UpdateUserRequest;

// Models
use App\Models\User;
use App\Models\Landlord\Country;

// Enums
use App\Enum\UserRoleEnum;

// Helpers
use App\Helpers\Export;
use App\Helpers\LandlordFileUpload;
use App\Helpers\LandlordEventLog;

// Notification
use Notification;
use App\Notifications\Landlord\UserCreated;
use Illuminate\Auth\Events\Registered;

// Mail
use Mail;

// Seeded
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

// for profile picture
use Image;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Str;
use DB;


//use App\Models\Tenant\Setting;
//use App\Mail\Tenant\ActivationMail;

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
		//Log::debug("role=".auth()->user()->role->value);

		//$users = User::latest()->orderBy('id','desc')->paginate(10);
		switch (auth()->user()->role->value) {
			case UserRoleEnum::ADMIN->value:
				$users= $users->byAccount()->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				$users= $users->byUser()->orderBy('id', 'DESC')->paginate(10);
				Log::debug("Other roles!");
		}
		return view('landlord.admin.users.index',compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
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
		//Log::debug("role=".auth()->user()->role->value);
		//$users = User::latest()->orderBy('id','desc')->paginate(10);
		$users= $users->orderBy('id', 'DESC')->paginate(20);
		return view('landlord.admin.users.all',compact('users'))->with('i', (request()->input('page', 1) - 1) * 20);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create',User::class);

		// $emps = Emp::select('id','name')
		//     ->where('status', 'active')
		//     ->orderBy('id','asc')
		//     ->get();
		//$emps = Emp::getAll();

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
		$request->merge(['account_id'   => auth()->user()->account_id]);
		$request->merge(['enable'       => true]);
		if($request->has('admin')){
			//Checkbox checked
			$request->merge(['role'     => UserRoleEnum::ADMIN->value ]);
		}else{
			//Checkbox not checked
			$request->merge(['role'     => UserRoleEnum::USER->value ]);
		}

		$random_password                = Str::random(12);
		$request->merge(['password'     => Hash::make($random_password) ]);
		//Log::channel('bo')->info('password='.$random_password);
		//$request->merge(['email_verified_at' => now()]);

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
		
		// upload to private folder and show using user.show route
		// Upload File, if any, insert row in attachment table  and get attachments id
		//if ($file = $request->file('file_to_upload')) {
		//    $request->merge(['user_id'    => $user->id ]);
		//    $user_id = FileUpload::uploadPhoto($request);
		//} 

		$request->merge(['state'    => Str::upper($request->input('state')) ]);
		//$request->validate();
		$request->validate([

		]);

		// https://image.intervention.io/v2
		// https://laracasts.com/discuss/channels/general-discussion/laravel-5-image-upload-and-resize?page=1
		// default location D:\laravel\bo04\public
		if ($image = $request->file('file_to_upload')) {
		
			// uploaded to D:\laravel\bo04\public\landlord\profile
			//Log::debug("A config('bo.DIR_AVATAR')=".config('bo.DIR_AVATAR'));

			$destinationPath = public_path(config('bo.DIR_AVATAR'));
		   // Log::debug("destinationPath=".$destinationPath);

			$token          = $user->id ."-" . Str::uuid();
			$extension      = "." . trim($request->file('file_to_upload')->getClientOriginalExtension());

			$profileImage   = $token . "-uploaded" . $extension;
			$thumbImage     = $token. $extension;

			//$profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
			//$profileImage   = $user->id . "-uploaded." . trim($request->file('file_to_upload')->getClientOriginalExtension());
			//$thumbImage 	= $user->id . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());

			//Log::debug("profileImage=".$profileImage);
			//Log::debug("thumbImage=".$thumbImage);

			$image->move($destinationPath, $profileImage);
			$request->merge(['avatar' => $thumbImage ]);

			//keep front slash here
			//$image_resize = Image::make(public_path().'/landlord/avatar/'.$profileImage);
			//$image_resize->fit(90, 90);
			//$image_resize->save(public_path('/landlord/avatar/' .$thumbImage));

			//resize to thumbnail
			$image_resize = Image::make(public_path().config('bo.DIR_AVATAR').$profileImage);
			$image_resize->fit(160, 160);
			$image_resize->save(public_path(config('bo.DIR_AVATAR') .$thumbImage));
		} 

		$user->update($request->all());

		LandlordEventLog::event('user',$user->id,'update','name', $request->name);

		return redirect()->route('dashboards.index')->with('success','User profile updated successfully.');
	}



	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		//$this->authorize('delete', $user);  

		$user->fill(['enable'=>!$user->enable]);
		$user->update();

		// Write to Log
		LandlordEventLog::event('user',$user->id,'status','enable',$user->enable);

		return redirect()->route('users.index')->with('success','User Status Updated successfully');
	}

	public function role()
	{
		//$users = User::whereIn('role',['emp','user','supervisor','owner'])->orderBy('id','desc')->paginate(20);
		$users = User::latest()->orderBy('id','desc')->paginate(10);
		return view('users.role',compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	public function updaterole(User $user, $role)
	{
		//$this->authorize('updaterole',$user);  
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
		LandlordEventLog::event('user',$user->id,'updaterole','name',$role);

		return redirect()->route('users.index')->with('success','User '.$user->name.' role to \''.$role.'\' updated successfully');
	}

	public function userPassword(User $user)
	{
		//$this->authorize('changepass',$user);  

		Log::debug('Inside userPassword!');
		Log::debug('Role='. auth()->user()->role->value);
		


		return view('landlord.admin.users.user-password',compact('user')); 
	}

	public function updatePassword(Request $request, User $user)
	{
		$this->authorize('update',$user);  
		//$this->authorize('changepass',$user);  
		
		$request->validate([
			'password1'  => 'required|min:8',
			'password2'  => 'same:password1|min:8',
		]);

		//dd($request->password1);
		//$user->password = bcrypt($request->password1);
		$user->password = Hash::make($request->password1);
		$user->update();

		// Write to Log
		LandlordEventLog::event('user',$user->id,'update','password',$request->id);
		return redirect()->route('dashboard.index')->with('success','User password updated successfully');
	}

	public function export()
	{
		//Log::debug('Role='. auth()->user()->role->value);
		//Log::debug('Enum='. UserRoleEnum::ADMIN->value);

		if (auth()->user()->isBackOffice()){
			$data = DB::select("SELECT id, name, email, cell, role,account_id, enable FROM users");
		} else if (auth()->user()->isAdmin()){
			$data = DB::select("SELECT id, name, email, cell, role,account_id, enable 
				FROM users
				WHERE account_id=".auth()->user()->account_id);
		} else {
			$data = DB::select("SELECT id, name, email, cell, role,account_id, enable 
				FROM users
				WHERE  id =".auth()->user()->id);
		}

		//Log::debug('Role= '. auth()->user()->role->value);
		//$data = DB::select("SELECT id, name, email, cell, role, enable FROM users");

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}

	public function image($filename)
	{
		//shown as: http://geda.localhost:8000/image/4.jpg
		//$path = storage_path('uploads/' . $filename);
		$path = storage_path('app/public/profile/'. $filename);
		Log::debug('path= '. $path);

		if (!File::exists($path)) {
			abort(404);
			Log::debug('FILE does not exists! '. $filename);
		}

		$file = File::get($path);
		$type = File::mimeType($path);
	 
		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);
		return $response;
	}


	public function didnotupdate(UpdateUserRequest $request, User $user)
	{
		
		$this->authorize('update', $user);  

		// upload to private folder and show using user.show route
		// Upload File, if any, insert row in attachment table  and get attachments id
		//if ($file = $request->file('file_to_upload')) {
		//    $request->merge(['user_id'    => $user->id ]);
		//    $user_id = FileUpload::uploadPhoto($request);
		//} 

		// https://image.intervention.io/v2
		// https://laracasts.com/discuss/channels/general-discussion/laravel-5-image-upload-and-resize?page=1
		// default location D:\laravel\bo04\public
		if ($image = $request->file('file_to_upload')) {
			// uploaded to D:\laravel\bo04\public\landlord\profile    
			Log::debug("A config('bo.DIR_AVATAR')=".config('bo.DIR_AVATAR'));

			//$destinationPath    = config('bo.DIR_AVATAR');
			$destinationPath = '/landlord/avatar/';
			Log::debug("destinationPath=".$destinationPath);

			//$profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
			$profileImage   = $user->id . "-uploaded." . trim($request->file('file_to_upload')->getClientOriginalExtension());
			$thumbImage 	= $user->id . "." . trim($request->file('file_to_upload')->getClientOriginalExtension());

			Log::debug("profileImage=".$profileImage);
			Log::debug("thumbImage=".$thumbImage);

			$image->move($destinationPath, $profileImage);
			$request->merge(['avatar' => $thumbImage ]);
			//$file-> move(public_path('public/Image'), $filename);
			//$request['my_image'] = $profileImage;
			//$input['my_image'] = "$profileImage";            

			//resize to thumbnail
			$image_resize = Image::make(public_path().'/landlord/avatar/'.$profileImage);
			$image_resize->fit(90, 90);
			$image_resize->save(public_path('/landlord/avatar/' .$thumbImage));

			//resize to thumbnail
			//$image_resize = Image::make(public_path().config('bo.DIR_AVATAR').$profileImage);
			//$image_resize->fit(90, 90);
			//$image_resize->save(public_path(config('bo.DIR_AVATAR') .$thumbImage));
		}

		//$request->validate();
		$request->validate([

		]);

		$user->update($request->all());


		LandlordEventLog::event('user',$user->id,'update','name', $request->name);

		return redirect()->route('users.index')->with('success','User profile updated successfully.');
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
