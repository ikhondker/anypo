<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        CheckAccess.php
 * @brief       This file contains the implementation of the CheckAccess Helper.
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

namespace App\Helpers;

use File;

use Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

// $table->enum('role', ['emp','tl','hr','finance','hradmin','management','support','admin','system'])->default('emp');
// Enums
use App\Enum\UserRoleEnum;

class CheckAccess
{
	public static function xxisBackOffice($role)
	{
		switch($role) {
			case(UserRoleEnum::SUPPORT->value):
				return true;
				break;
			case(UserRoleEnum::SUPERVISOR->value):
				return true;
				break;
			case(UserRoleEnum::SYSTEM->value):
				return true;
				break;
			default:
				return false;
		}
	}

	public static function xxisSystem($role)
	{
		switch($role) {
			case(UserRoleEnum::SYSTEM->value):
				return true;
				break;
			default:
				return false;
		}
	}


	public static function aboveAdmin($role)
	{
		switch($role) {
			case(UserRoleEnum::ADMIN->value):
				return true;
				break;
			case(UserRoleEnum::SUPPORT->value):
				return true;
				break;
			case(UserRoleEnum::SUPERVISOR->value):
				return true;
				break;
			case(UserRoleEnum::SYSTEM->value):   // users\edit.index direct call
				return true;
				break;
			default:
				return false;
		}
	}

	public static function aboveManager($role)
	{
		switch($role) {
			case(UserRoleEnum::MANAGER->value):
				return true;
				break;
			case(UserRoleEnum::HOD->value):
				return true;
				break;
			case(UserRoleEnum::ADMIN->value):
				return true;
				break;
			case(UserRoleEnum::SUPPORT->value):
				return true;
				break;
			default:
				return false;
		}
	}

	// Not used yet
	public static function xxisPrivileged($role)
	{
		switch($role) {
			case(UserRoleEnum::BUYER->value):
				return true;
				break;
			case(UserRoleEnum::MANAGER->value):
				return true;
				break;
			case(UserRoleEnum::HOD->value):
				return true;
				break;
			case(UserRoleEnum::CXO->value):
				return true;
				break;
			case(UserRoleEnum::ADMIN->value):
				return true;
				break;
			case(UserRoleEnum::SYSTEM->value):
				return true;
				break;
			default:
				return false;
		}
	}

}
