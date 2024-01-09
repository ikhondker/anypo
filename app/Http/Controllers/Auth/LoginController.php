<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        LoginController.php
 * @brief       This file contains the implementation of the LoginController class.
 * @author      Iqbal H. Khondker
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * 13-Sep-2023	v1.0.1	Iqbal H Khondker		Modified for Front theme.
 * ==================================================================================
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
		// Write to Log IQBAL
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


		// $user->update([
		//     'last_login_at' => Now(),
		//     'last_login_ip' => $request->getClientIp()
		// ]);
	}

	// IQBAL 16-FEB-23
	// logout if account error for user/admin/agent/manager
	public function xxredirectTo()
	{
		// redirect to error page if account_id is not set
		if (((auth()->user()->role->value === 'user') || (auth()->user()->role->value === 'admin')) && (is_null(auth()->user()->account_id))) {
			Session::flush();
			Auth::logout();
			return 'account-missing/';
		} elseif ((auth()->user()->role->value === 'agent') && (auth()->user()->account_id <> '')) {
			Session::flush();
			Auth::logout();
			return 'account-linked/';
		} else {
			return 'dashboards/';
		}
	}

	// IQBAL 9-sep-2022
	//added to overwrite the login credentials
	protected function credentials(Request $request)
	{
		return [
			'email'	 	=> request()->email,
			'password' => request()->password,
			'enable'	=> true,  // do not allow disabled user to login
			//is_null('email_verified_at')
		];
	}

	// IQBAL 20-APR-2023
	// D:\laravel\bo04\vendor\laravel\ui\auth-backend\AuthenticatesUsers.php
	//added to overwrite the login form
	public function showLoginForm()
	{

		if (tenant('id') == '') {
			return view('auth.landlord-login');
		} else {
			return view('auth.login');
		}
	}
}
