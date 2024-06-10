<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			LoginController.php
* @brief		This file contains the implementation of the LoginController
* @path			\app\Http\Controllers\Tenant
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


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// IQBAL 23-MAR-23
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\Log;

// Enums
use App\Enum\UserRoleEnum;


# Helpers
use App\Helpers\EventLog;
use App\Helpers\LandlordEventLog;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	// IQBAL 28-FEB-23
	// logout from a link and redirect to home
	public function logout(Request $request)
	{
		// Write logout event to Log
		if (tenant('id') == '') {
			// address timeout issue
			if(isset($user)){
				LandlordEventLog::event('user', auth()->user()->id, 'sign-out');
			}
		} else {
			EventLog::event('user', auth()->user()->id, 'sign-out');
		}
		Session::flush();
		Auth::logout();
		return redirect('/');
	}

	// IQBAL 16-FEB-23
	// save User's Last Login Time and IP Address
	function authenticated(Request $request, $user)
	{
		// save last_login_ip
		$user->last_login_at = now();
		$user->last_login_ip = $request->getClientIp();
		$user->save();

		// Write to Log
		if (tenant('id') == '') {
			LandlordEventLog::event('user', $user->id, 'sign-in');
		} else {
			EventLog::event('user', $user->id, 'sign-in');
		}

	}


	// IQBAL 9-sep-2022
	// Added to overwrite the login credentials
	protected function credentials(Request $request)
	{
		// middleware verified is used to check if email_verified_at
		return [
			'email'		=> request()->email,
			'password'	=> request()->password,
			'enable'	=> true,			// do not allow disabled user to login
		];
	}

	// IQBAL 20-APR-2023
	// D:\laravel\bo04\vendor\laravel\ui\auth-backend\AuthenticatesUsers.php
	//added to overwrite the login form
	public function showLoginForm()
	{
		if (tenant('id') == '') {
			return view('auth.landlord.login');
		} else {
			return view('auth.login');
		}
	}
}
