<?php

/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ConfirmPasswordController.php
* @brief		This file contains the implementation of the ConfirmPasswordController
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
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Confirm Password Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password confirmations and
	| uses a simple trait to include the behavior. You're free to explore
	| this trait and override any functions that require customization.
	|
	*/

	use ConfirmsPasswords;

	/**
	 * Where to redirect users when the intended url fails.
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
		$this->middleware('auth');
	}

	// IQBAL 20-APR-2023
	// D:\laravel\bo04\vendor\laravel\ui\auth-backend\ConfirmsPasswords.php
	//added to overwrite the login form

	public function showConfirmForm()
	{
		if (tenant('id') == '') {
			return view('auth.passwords.landlord-confirm');
		} else {
			return view('auth.passwords.confirm');
		}
	}
}
