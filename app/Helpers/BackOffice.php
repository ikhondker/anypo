<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        ErrorReport.php
 * @brief       This file contains the implementation of the ErrorReport Helper.
 * @author      Iqbal H. Khondker 
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 25-Aug-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
*/
namespace App\Helpers;

use File;

use Request;
//use Illuminate\Support\Facades\Response;
//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use Illuminate\Support\Facades\Auth;

use App\Models\User;


# Notifications
use Notification;
use App\Notifications\ReportError;
use App\Notifications\ReportInfo;

// Enums
//use App\Enum\UserRoleEnum;


class BackOffice
{

    // BackOffice::ReportError('PR','Test111 22 33 44');
    // BackOffice::ReportInfo('PR','Test111 22 33 44');

    public static function ReportError($entity, $subject) {
        $user = User::where('id', config('akk.SYSTEM_USER_ID'))->first();
        $user->notify(new ReportError($entity, $subject));
        return 'ok';
    }

    public static function ReportInfo($entity, $subject) {
        $user = User::where('id', config('akk.SYSTEM_USER_ID'))->first();
        $user->notify(new ReportInfo($entity, $subject));
        return 'ok';
    }

}
