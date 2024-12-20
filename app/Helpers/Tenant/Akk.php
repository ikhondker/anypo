<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Akk.php
* @brief		This file contains the implementation of the Bo
* @path			\app\Helpers\Tenant
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

namespace App\Helpers\Tenant;

use App\Models\Tenant\DeptBudget;
use App\Models\Domain;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

// called form hod.dashboard
class Akk
{

	public static function userAnyDeptBudgetExists()
	{
		// Check if dept budget exists for current logged user
		try {
			$deptBudget 	= DeptBudget::where('dept_id', auth()->user()->dept_id )
				->where('revision', false)
				->get()->firstOrFail();
			return true;
		} catch (ModelNotFoundException $ex) {
			//Log::warning('tenant.model.DeptBudget.userDeptBudgetExists dept_budget not found!');
			return false;
		} catch (\Exception $exception) {
			// General Exception class which is the parent of all Exceptions
			return false;
		}
	}

	public static function getDomainName()
	{
		return (tenant()->domains->first()->domain);
		// dd(tenant()->domains->first()->domain);
		//Log::log('tenant.akk.getDomainFromTenantId tenantId not found!'.$tenantId);
		// Check if dept budget exists for current logged user
		// try {
		// 	$domain 	= Domain::where('tenant_id', $tenantId )
		// 		->get()->firstOrFail();
		// 	return $domain->domain;
		// } catch (ModelNotFoundException $ex) {
		// 	Log::warning('tenant.akk.getDomainFromTenantId tenantId not found!');
		// 	return '';
		// } catch (\Exception $exception) {
		// 	// General Exception class which is the parent of all Exceptions
		// 	return '';
		// }
	}

	// TODOP2 Use this
	// use Exception;
	// try {
	// 	//Code that may throw an Exception
	// } catch (Exception $e) {
	// 	// Log the message locally OR use a tool like Bugsnag/Flare to log the error
	// 	Log::error('invoice.store '. $e->getMessage());
	// 	// Either form a friendlier message to display to the user OR redirect them to a failure page
	// }

	}
