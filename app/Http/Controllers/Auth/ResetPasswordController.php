<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        ResetPasswordController.php
 * @brief       This file contains the implementation of the ResetPasswordController class.
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
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // IQBAL 20-APR-2023
    // D:\laravel\bo04\vendor\laravel\ui\auth-backend\ResetsPasswords.php
    //added to overwrite the login form
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        if (tenant('id') == '') {
            return view('auth.passwords.landlord-reset')->with(['token' => $token, 'email' => $request->email]);
        } else {
            return view('auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
        }
    }
}
