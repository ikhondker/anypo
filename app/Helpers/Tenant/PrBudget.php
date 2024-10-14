<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			PrBudget.php
* @brief		This file contains the implementation of the PrBudget
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

use File;

use Request;
//use Illuminate\Support\Facades\Response;
//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Illuminate\Support\Facades\Auth;

// Enums
//use App\Enum\UserRoleEnum;
use App\Enum\EntityEnum;
use App\Enum\EventEnum;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Supplier;


use Carbon\Carbon;

#Jobs
use App\Jobs\Tenant\ConsolidateBudget;
use App\Jobs\Tenant\RecordDeptBudgetUsage;

class PrBudget
{

	public static function prBudgetBook($pr_id)
	{

		Log::debug('tenant.helper.PrBudget.prBudgetBook booking budget for pr_id = '. $pr_id);
		$pr = Pr::where('id', $pr_id)->first();

		// check if dept_budget for this year exists
		$fy = Carbon::now()->format('Y');
		try {
			$budget = Budget::primary()->where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			Log::warning('tenant.helper.PrBudget.prBudgetBook Budget ModelNotFoundException E001');
			return 'E001';
		}

		// check if dept_budget for this year exists
		try {
			$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			Log::warning('tenant.helper.PrBudget.prBudgetBook DeptBudget ModelNotFoundException E002');
			return 'E002';
		}

		// only check if budget is available
		$dept_budget_available =false;
		if (($dept_budget->amount - $dept_budget->amount_pr_booked - $dept_budget->amount_pr) > $pr->fc_amount) {
			$dept_budget_available =true;
			Log::debug("tenant.helper.PrBudget.prBudgetBook dept_budget_available true.");
		} else {
			return 'E003';
		}

		// check if project budget available
		$project_budget_available =false;
		$project = Project::primary()->where('id', $pr->project_id)->firstOrFail();
		if (($project->amount - $project->amount_pr_booked - $project->amount_pr) > $pr->fc_amount) {
			$project_budget_available =true;
			Log::debug("tenant.helper.PrBudget.prBudgetBook project_budget_available true.");
		} else {
			Log::debug("tenant.helper.PrBudget.prBudgetBook project_budget_available FALSE E004.");
			return 'E004';
		}

		// both budget is available
		if ($project_budget_available && $dept_budget_available ) {
			// book pr dept budget
			Log::debug("tenant.helper.PrBudget.prBudgetBook updating dept_budget->amount_pr_booked.");
			Log::debug("tenant.helper.PrBudget.prBudgetBook before dept_budget->amount_pr_booked = ".$dept_budget->amount_pr_booked );
			Log::debug("tenant.helper.PrBudget.prBudgetBook updating pr->fc_amount = ".$pr->fc_amount);
			$dept_budget->amount_pr_booked = $dept_budget->amount_pr_booked + $pr->fc_amount;
			$dept_budget->count_pr_booked = $dept_budget->count_pr_booked + 1;
			$dept_budget->save();
			Log::debug("tenant.helper.PrBudget.prBudgetBook AFTER dept_budget->amount_pr_booked = ".$dept_budget->amount_pr_booked );

			// book project budget
			$project->amount_pr_booked 	= $project->amount_pr_booked + $pr->fc_amount;
			$project->count_pr_booked 	= $project->count_pr_booked + 1;
			$project->save();
			Log::debug("tenant.helper.PrBudget.prBudgetBook AFTER project->amount_pr_booked = ".$project->amount_pr_booked );

			// Pr supplier pr issues amount
			$supplier = Supplier::where('id', $pr->supplier_id)->firstOrFail();
			$supplier->amount_pr_booked 	= $supplier->amount_pr_booked + $pr->fc_amount;
			$supplier->count_pr_booked 		= $supplier->count_pr_booked + 1;
			$supplier->save();

			Log::debug("tenant.helper.PrBudget.prBudgetBook AFTER supplier->amount_pr_booked = ".$supplier->amount_pr_booked );

			// run job to Sync Budget
			Log::debug("tenant.helper.PrBudget.prBudgetBook Submitting Job RecordDeptBudgetUsage and ConsolidateBudget ...");
			RecordDeptBudgetUsage::dispatch(EntityEnum::PR->value, $pr_id, EventEnum::BOOK->value, $pr->fc_amount);
			ConsolidateBudget::dispatch($dept_budget->budget_id);
		}
		return '';
	}

	// Called from wfl->reject and pr->cancel
	public static function prBudgetBookReverse($event,$pr_id)
	{

		$pr = Pr::where('id', $pr_id)->first();

		// reverse Pr dept budget booking
		$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		$dept_budget->amount_pr_booked = $dept_budget->amount_pr_booked - $pr->fc_amount;
		$dept_budget->count_pr_booked = $dept_budget->count_pr_booked - 1;
		$dept_budget->save();

		// reverse Pr project booking
		$project = Project::where('id', $pr->project_id)->firstOrFail();
		$project->amount_pr_booked = $project->amount_pr_booked - $pr->fc_amount;
		$project->count_pr_booked = $project->count_pr_booked - 1;
		$project->save();

		// Pr supplier pr issues amount
		$supplier = Supplier::where('id', $pr->supplier_id)->firstOrFail();
		$supplier->amount_pr_booked = $supplier->amount_pr_booked - $pr->fc_amount;
		$supplier->count_pr_booked 		= $supplier->count_pr_booked + 1;
		$supplier->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PR->value, $pr_id, $event, $pr->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		//Log::debug("tenant.helper.PrBudget.prBudgetBookReject Inside");

		return '';
	}

	public static function prBudgetApprove($pr_id)
	{
		$pr = Pr::where('id', $pr_id)->first();
		// Pr dept budget approved
		$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		$dept_budget->amount_pr_booked = $dept_budget->amount_pr_booked - $pr->fc_amount;
		$dept_budget->count_pr_booked = $dept_budget->count_pr_count - 1;

		$dept_budget->amount_pr = $dept_budget->amount_pr + $pr->fc_amount;
		$dept_budget->count_pr = $dept_budget->count_pr + 1;

		$dept_budget->save();

		// Pr project budget used
		$project = Project::where('id', $pr->project_id)->firstOrFail();
		$project->amount_pr_booked 	= $project->amount_pr_booked - $pr->fc_amount;
		$project->count_pr_booked 			= $project->count_pr_booked - 1;

		$project->amount_pr 	= $project->amount_pr + $pr->fc_amount;
		$project->count_pr 		= $project->count_pr + 1;
		$project->save();

		// Pr supplier pr issues amount
		$supplier = Supplier::where('id', $pr->supplier_id)->firstOrFail();
		$project->amount_pr_booked 	= $project->amount_pr_booked - $pr->fc_amount;
		$project->count_pr_booked 			= $project->count_pr_booked - 1;

		$supplier->amount_pr = $supplier->amount_pr + $pr->fc_amount;
		$supplier->count_pr 		= $supplier->count_pr + 1;
		$supplier->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PR->value, $pr_id, EventEnum::APPROVE->value,$pr->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		return '';
	}

	public static function prBudgetApproveCancel($pr_id)
	{
		$pr = Pr::where('id', $pr_id)->first();

		// reverse Pr dept budget booking
		$dept_budget = DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
		$dept_budget->amount_pr = $dept_budget->amount_pr - $pr->fc_amount;
		$dept_budget->count_pr = $dept_budget->count_pr - 1;
		$dept_budget->save();

		// reverse Pr project booking
		$project = Project::where('id', $pr->project_id)->firstOrFail();
		$project->amount_pr = $project->amount_pr - $pr->fc_amount;
		$project->count_pr 	= $project->count_pr - 1;
		$project->save();

		// Pr supplier pr issues reduce
		$supplier = Supplier::where('id', $pr->supplier_id)->firstOrFail();
		$supplier->amount_pr = $supplier->amount_pr - $pr->fc_amount;
		$supplier->count_pr 		= $supplier->count_pr - 1;
		$supplier->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PR->value, $pr_id, EventEnum::CANCEL->value,$pr->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		//Log::debug("tenant.helper.PrBudget.prBudgetApproveCancel Inside");

		return '';
	}
}
