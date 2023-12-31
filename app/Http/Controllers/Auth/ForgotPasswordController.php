<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        ForgotPasswordController.php
 * @brief       This file contains the implementation of the ForgotPasswordController class.
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
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset emails and
	| includes a trait which assists in sending these notifications from
	| your application to your users. Feel free to explore this trait.
	|
	*/

	use SendsPasswordResetEmails;

	// IQBAL 20-APR-2023
	// D:\laravel\bo04\vendor\laravel\ui\auth-backend\SendsPasswordResetEmails.php
	//added to overwrite the login form
	public function showLinkRequestForm()
	{
		if (tenant('id') == '') {
			return view('auth.passwords.landlord-email');
		} else {
			return view('auth.passwords.email');
		}
	}
}
