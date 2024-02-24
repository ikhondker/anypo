<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			PoBudget.php
* @brief		This file contains the implementation of the PoBudget
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

use App\Models\Tenant\Po;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Project;

use Carbon\Carbon;

#Jobs
use App\Jobs\Tenant\ConsolidateBudget;
use App\Jobs\Tenant\RecordDeptBudgetUsage;

class PoBudget
{
	public static function poBudgetBook($po_id)
	{

		Log::debug("Inside poBudgetBook");

		$po = Po::where('id', $po_id)->first();

		// check if dept_budget for this year exists
		$fy = Carbon::now()->format('Y');
		try {
			$budget = Budget::primary()->where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			Log::warning("tenant.helper.PoBudget.poBudgetBook Budget ModelNotFoundException");
			return 'E001';
		}

		// check if dept_budget for this year exists
		//Log::debug("po->dept_id=".$po->dept_id);
		//Log::debug("po->dept_budget_id=".$po->dept_budget_id);

		try {
			$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			Log::warning("tenant.helper.PoBudget.poBudgetBook DeptBudget ModelNotFoundException");
			//Log::debug("Inside ModelNotFoundException");
			return 'E002';
		}

		//Log::info(print_r($dept_budget, true));

		// only check if budget is available 
		$dept_budget_available =false;
		if (($dept_budget->amount - $dept_budget->amount_po_booked - $dept_budget->amount_po_issued) > $po->fc_amount) {
			$dept_budget_available =true;
			Log::debug("tenant.helper.PoBudget.poBudgetBook dept_budget_available true.");
		} else {
			return 'E003';
		}

		// check if project budget available
		$project_budget_available =false;
		$project = Project::primary()->where('id', $po->project_id)->firstOrFail();
			if (($project->amount - $project->amount_po_booked - $project->amount_po_issued) > $po->fc_amount) {
			$project_budget_available =true;
			Log::debug("tenant.helper.PoBudget.poBudgetBook project_budget_available true.");
		} else {
			return 'E004';
		}

		// both budget is available 
		if ($project_budget_available && $dept_budget_available ) {
			// book pr dept budget
			Log::debug("tenant.helper.PoBudget.poBudgetBook updating dept_budget->amount_po_booked.");
			Log::debug("tenant.helper.PoBudget.poBudgetBook before dept_budget->amount_po_booked=".$dept_budget->amount_po_booked );
			Log::debug("tenant.helper.PoBudget.poBudgetBook updating po->fc_amount=".$po->fc_amount);

			$dept_budget->amount_po_booked = $dept_budget->amount_po_booked + $po->fc_amount;
			$dept_budget->save();
			Log::debug("tenant.helper.PoBudget.poBudgetBook dept_budget->amount_pr_booked=".$dept_budget->amount_po_booked );

			// book project budget
			$project->amount_po_booked = $project->amount_po_booked + $po->fc_amount;
			$project->save();
			Log::debug("tenant.helper.PoBudget.poBudgetBook AFTER project->amount_po_booked=".$project->amount_po_booked );

			// run job to Sync Budget
			RecordDeptBudgetUsage::dispatch(EntityEnum::PO->value, $po_id, EventEnum::BOOK->value,$po->fc_amount);
			ConsolidateBudget::dispatch($dept_budget->budget_id);
		}

		return 'E000';
	}

	// Called from wfl->reject and po->cancel
	public static function poBudgetBookReverse($event,$po_id)
	{

		$po = Po::where('id', $po_id)->first();

		// reverse Po dept budget booking 
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_po_booked = $dept_budget->amount_po_booked - $po->fc_amount;
		$dept_budget->save();

		// reverse Po project booking 
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_po_booked = $project->amount_po_booked - $po->fc_amount;
		$project->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PO->value, $po_id, $event);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		Log::debug("PoBudget.poBudgetBookReject Inside");

		return 'E000';
	}

	public static function poBudgetApprove($po_id)
	{


		$po = Po::where('id', $po_id)->first();
		// Po dept budget approved
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->count_po = $dept_budget->count_po + 1;
		$dept_budget->amount_po_issued = $dept_budget->amount_po_issued + $po->fc_amount;
		$dept_budget->amount_po_booked = $dept_budget->amount_po_booked - $po->fc_amount;
		$dept_budget->save();

		// Po project budget used
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_po_issued = $project->amount_po_issued + $po->fc_amount;
		$project->amount_po_booked = $project->amount_po_booked - $po->fc_amount;
		$project->save();

		// run job to Sync Budget

		RecordDeptBudgetUsage::dispatch(EntityEnum::PO->value, $po_id, EventEnum::APPROVE->value,$po->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		return 'E000';
	}
	

	public static function poBudgetApproveCancel($po_id)
	{
		$po = Po::where('id', $po_id)->first();

		// Cancel Po dept budget booking 
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->count_po = $dept_budget->count_po - 1;
		$dept_budget->amount_po_issued = $dept_budget->amount_po_issued - $po->fc_amount;
		$dept_budget->save();
		
		// Cancel Po project booking 
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_po_issued = $project->amount_po_issued - $po->fc_amount;
		$project->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PO->value, $po_id, EventEnum::CANCEL->value,$po->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		Log::debug("PoBudget.poBudgetApproveCancel Inside");

		return 'E000';
	}

}
