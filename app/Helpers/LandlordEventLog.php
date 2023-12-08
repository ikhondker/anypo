<?php

/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			LandlordEventLog.php
* @brief		This file contains the implementation of the LandlordEventLog
* @path			\app\Helpers
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

use App\Models\Landlord\Admin\Activity;
use Illuminate\Support\Facades\Log;

use App\Enum\UserRoleEnum;

// $table->enum('role', ['emp','tl','hr','finance','hradmin','management','support','admin','system'])->default('emp');

//use App\Helpers\EventLog;
//EventLog::event('user',$user->id,'update','name', $request->name);
//EventLog::event('user',$user->id,'create');


class LandlordEventLog
{
	// Write Event Log
	// LogEvent('template',$template->id,'create','colname',$template->id);
	public static function event($object_name, $object_id = 0, $event_name = null, $column_name = null, $prior_value = null, $object_type = "C")
	{
		$log                = [];
		//$log['account_id']  = auth()->user()->account_id;
		$log['account_id']  = auth()->check() ? auth()->user()->account_id : '1000';
		$log['object_name'] = $object_name;
		$log['object_id']   = $object_id;
		$log['event_name']  = $event_name;
		$log['column_name'] = $column_name;
		$log['prior_value'] = $prior_value;
		$log['object_type'] = $object_type;            // C-Control ,M-Model
		$log['url']         = Request::fullUrl();
		$log['method']      = Request::method();
		$log['ip']          = Request::ip();
		$log['role']        = auth()->check() ? auth()->user()->role : UserRoleEnum::SYSTEM->value;
		$log['user_id']     = auth()->check() ? auth()->user()->id : config('bo.SYSTEM_USER_ID');

		Activity::create($log);
	}
}
