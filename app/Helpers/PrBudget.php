<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			PrBudget.php
* @brief		This file contains the implementation of the PrBudget
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
use App\Enum\EntityEnum;
use App\Enum\EventEnum;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Lookup\Project;

use Carbon\Carbon;

#Jobs
use App\Jobs\Tenant\ConsolidateBudget;
use App\Jobs\Tenant\RecordDeptBudgetUsage;

class PrBudget
{

	public static function prBudgetBook($pr_id)
	{

		$pr = Pr::where('id', $pr_id)->first();

		// check if dept_budget for this year exists
		$fy = Carbon::now()->format('Y');
		try {
			$budget = Budget::primary()->where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			Log::debug("Inside ModelNotFoundException");
			return 'E001';
		}

		// check if dept_budget for this year exists
		//Log::debug("pr->dept_id=".$pr->dept_id);
		//Log::debug("pr->dept_budget_id=".$pr->dept_budget_id);
		try {
			$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			//Log::debug("Inside ModelNotFoundException");
			return 'E002';
		}

		// only check if budget is available 
		$dept_budget_available =false;
		if (($dept_budget->amount - $dept_budget->amount_pr_booked - $dept_budget->amount_pr_issued) > $pr->fc_amount) {
			$dept_budget_available =true;
		} else {
			return 'E003';
		}

		// check if project budget available
		$project_budget_available =false;
		$project = Project::primary()->where('id', $pr->project_id)->firstOrFail();
			if (($project->amount - $project->amount_pr_booked - $project->amount_pr_issued) > $pr->fc_amount) {
			$project_budget_available =true;
		} else {
			return 'E004';
		}

		// both budget is available 
		if ($project_budget_available && $dept_budget_available ) {
			// book pr dept budget
			$dept_budget->amount_pr_booked = $dept_budget->amount_pr_booked + $pr->fc_amount;
			$dept_budget->save();

			// book project budget
			$project->amount_pr_booked = $project->amount_pr_booked + $pr->fc_amount;
			$project->save();


			// run job to Sync Budget
			RecordDeptBudgetUsage::dispatch(EntityEnum::PR->value, $pr_id, EventEnum::BOOK->value);
			ConsolidateBudget::dispatch($dept_budget->budget_id);
		}
		return 'E000';
	}

	// Called from wfl->reject and pr->cancel
	public static function prBudgetBookReverse($event,$pr_id)
	{

		$pr = Pr::where('id', $pr_id)->first();

		// reverse Pr dept budget booking 
		$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		$dept_budget->amount_pr_booked = $dept_budget->amount_pr_booked - $pr->fc_amount;
		$dept_budget->save();
		
		// reverse Pr project booking 
		$project = Project::where('id', $pr->project_id)->firstOrFail();
		$project->amount_pr_booked = $project->amount_pr_booked - $pr->fc_amount;
		$project->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PR->value, $pr_id, $event);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		Log::debug("PrBudget.prBudgetBookReject Inside");

		return 'E000';
	}

	public static function prBudgetApprove($pr_id)
	{
		$pr = Pr::where('id', $pr_id)->first();
		// Pr dept budget approved
		$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		$dept_budget->amount_pr_issued = $dept_budget->amount_pr_issued + $pr->fc_amount;
		$dept_budget->amount_pr_booked = $dept_budget->amount_pr_booked - $pr->fc_amount;
		$dept_budget->save();

		// Pr project budget used
		$project = Project::where('id', $pr->project_id)->firstOrFail();
		$project->amount_pr_issued = $project->amount_pr_issued + $pr->fc_amount;
		$project->amount_pr_booked = $project->amount_pr_booked - $pr->fc_amount;
		$project->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PR->value, $pr_id, EventEnum::APPROVE->value);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		return 'E000';
	}

	public static function prBudgetApproveCancel($pr_id)
	{
		$pr = Pr::where('id', $pr_id)->first();

		// reverse Pr dept budget booking 
		$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		$dept_budget->amount_pr_issued = $dept_budget->amount_pr_issued - $pr->fc_amount;
		$dept_budget->save();
		
		// reverse Pr project booking 
		$project = Project::where('id', $pr->project_id)->firstOrFail();
		$project->amount_pr_issued = $project->amount_pr_issued - $pr->fc_amount;
		$project->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PR->value, $pr_id, EventEnum::CANCEL->value);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		Log::debug("PrBudget.prBudgetApproveCancel Inside");

		return 'E000';
	}
}
