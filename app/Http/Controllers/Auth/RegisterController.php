<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        RegisterController.php
 * @brief       This file contains the implementation of the RegisterController class.
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
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Enum\UserRoleEnum;
use App\Helpers\LandlordEventLog;
use App\Helpers\EventLog;

use Notification;
use App\Notifications\Landlord\UserRegistered;
use Illuminate\Auth\Events\Registered;

//use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = RouteServiceProvider::HOME;
	// IQBAL 2-APR-23
	//protected $redirectTo = '/logout';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name'					=> ['required', 'string', 'max:255'],
			'email'					=> ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password'				=> ['required', 'string', 'min:8', 'confirmed'],
			'password_confirmation'	=> ['required', 'string', 'min:8'],
			'terms'					=> 'accepted'
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\Models\User
	 */
	protected function create(array $data)
	{
		// sign up mail https://codelapan.com/post/send-welcome-email-notification-after-user-register-in-laravel-8
		// uncomment check tenant or landlord
		$user = User::create([
			'name'		=> $data['name'],
			'email'		=> $data['email'],
			//'email_verified_at'  => NOW(),	// Keep comment. DO not auto verify email 
			'role'		=> UserRoleEnum::USER->value,
			'password'	=> Hash::make($data['password']),
		]);

		// Send notification on new user registration
		$user->notify(new UserRegistered($user));

		// Write to Log
		if (tenant('id') == '') {
			LandlordEventLog::event('user', $user->id, 'register');
		} else {
			EventLog::event('user', $user->id, 'register');
		}
		return $user;
	}

	// IQBAL 20-APR-2023
	// D:\laravel\bo04\vendor\laravel\ui\auth-backend\RegistersUsers.php
	// added to overwrite the register form
	public function showRegistrationForm()
	{
		if (tenant('id') == '') {
			return view('auth.landlord-register');
		} else {
			return view('auth.register');
		}
	}
}
