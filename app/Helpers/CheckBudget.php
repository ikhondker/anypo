<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			CheckBudget.php
* @brief		This file contains the implementation of the CheckBudget
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

use File;

use Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

// Enums
use App\Enum\UserRoleEnum;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Lookup\Project;

use Carbon\Carbon;

class CheckBudget
{
	public static function checkAndBookPr($pr_id)
	{
		//Log::debug("Inside bookBudget");
		$pr = Pr::where('id', $pr_id)->first();

		// check if dept_budget for this year exists

		// increase booking

		// check if budget for this year exists
		$fy = Carbon::now()->format('Y');
		//Log::debug("fy".$fy);
		try {
			$budget = Budget::primary()->where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			Log::debug("Inside ModelNotFoundException");
			return 'E001';
		}

		// check if dept_budget for this year exists
		Log::debug("pr->dept_id=".$pr->dept_id);
		Log::debug("pr->dept_budget_id=".$pr->dept_budget_id);

		try {
			$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			//Log::debug("Inside ModelNotFoundException");
			return 'E002';
		}

		// check if budget is available
		if (($dept_budget->amount - $dept_budget->amount_pr_booked - $dept_budget->amount_pr_issued) > $pr->fc_amount) {
			// book pr budget
			//Log::debug("Updating dept_budget");
			$dept_budget->amount_pr_booked = $dept_budget->amount_pr_booked + $pr->fc_amount;
			$dept_budget->save();

			//Log::debug("Updating budget");
			$budget->amount_pr_booked = $budget->amount_pr_booked + $pr->fc_amount;
			$budget->save();
		} else {
			return 'E003';
		}

		// update projects budget
		$project = Project::where('id', $pr->project_id)->firstOrFail();
		$project->amount_pr_booked = $project->amount_pr_booked + $pr->fc_amount;
		$project->save();

		return 'E000';
	}

	public static function reverseBookingPr($pr_id)
	{

		$pr = Pr::where('id', $pr_id)->first();

		$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		$dept_budget->amount_pr_booked = $dept_budget->amount_pr_booked - $pr->fc_amount;
		$dept_budget->save();



		$budget = Budget::primary()->where('id', $dept_budget->budget_id)->firstOrFail();
		$budget->amount_pr_booked = $budget->amount_pr_booked - $pr->fc_amount;
		$budget->save();

		$project = Project::where('id', $pr->project_id)->firstOrFail();
		$project->amount_pr_booked = $project->amount_pr_booked - $pr->fc_amount;
		$project->save();

		return 'E000';
	}

	public static function confirmBudgetPr($pr_id)
	{
		$pr = Pr::where('id', $pr_id)->first();

		$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		$dept_budget->amount_pr_issued = $dept_budget->amount_pr_issued + $pr->fc_amount;
		$dept_budget->amount_pr_booked = $dept_budget->amount_pr_booked - $pr->fc_amount;
		$dept_budget->save();

		$budget = Budget::primary()->where('id', $dept_budget->budget_id)->firstOrFail();
		$budget->amount_pr_issued = $budget->amount_pr_issued + $pr->fc_amount;
		$budget->amount_pr_booked = $budget->amount_pr_booked - $pr->fc_amount;
		$budget->save();

		$project = Project::where('id', $pr->project_id)->firstOrFail();
		$project->amount_pr_issued = $project->amount_pr_issued + $pr->fc_amount;
		$project->amount_pr_booked = $project->amount_pr_booked - $pr->fc_amount;
		$project->save();

		return 'E000';
	}


	public static function reversBudget($role)
	{
		return false;
	}

	public static function updateDeptBudget($role)
	{
		return false;
	}

	public static function updateCompanyBudget($role)
	{
		return false;
	}

}
