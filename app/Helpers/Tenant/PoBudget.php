<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			PoBudget.php
* @brief		This file contains the implementation of the PoBudget
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
use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\EventEnum;

use App\Models\Tenant\Po;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Supplier;

use Carbon\Carbon;

#Jobs
use App\Jobs\Tenant\ConsolidateBudget;
use App\Jobs\Tenant\RecordDeptBudgetUsage;

class PoBudget
{
	public static function poBudgetBook($po_id)
	{

		$po = Po::where('id', $po_id)->first();

		// check if dept_budget for this year exists
		$fy = Carbon::now()->format('Y');
		try {
			$budget = Budget::primary()->where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			Log::warning("tenant.helper.PoBudget.poBudgetBook Budget ModelNotFoundException");
			Log::warning("tenant.helper.PoBudget.poBudgetBook : E001");
			return 'E001';
		}

		// check if dept_budget for this year exists
		try {
			$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			Log::warning("tenant.helper.PoBudget.poBudgetBook DeptBudget ModelNotFoundException");
			//Log::debug("Inside ModelNotFoundException");
			Log::warning("tenant.helper.PoBudget.poBudgetBook : E002");
			return 'E002';
		}

		// only check if budget is available
		Log::debug('tenant.helper.PoBudget.poBudgetBook dept_budget->amount = '. $dept_budget->amount );
		Log::debug('tenant.helper.PoBudget.poBudgetBook dept_budget->amount_po_booked = '. $dept_budget->amount_po_booked );
		Log::debug('tenant.helper.PoBudget.poBudgetBook dept_budget->amount_po = '. $dept_budget->amount_po );
		Log::debug('tenant.helper.PoBudget.poBudgetBook po->fc_amount = '. $po->fc_amount );

		$dept_budget_available =false;
		if (($dept_budget->amount - $dept_budget->amount_po_booked - $dept_budget->amount_po) > $po->fc_amount) {
			$dept_budget_available =true;
			Log::debug('tenant.helper.PoBudget.poBudgetBook dept_budget_available true.');
		} else {
			Log::warning('tenant.helper.PoBudget.poBudgetBook : E003');
			return 'E003';
		}

		// check if project budget available
		$project_budget_available =false;
		$project = Project::primary()->where('id', $po->project_id)->firstOrFail();
			if (($project->amount - $project->amount_po_booked - $project->amount_po) > $po->fc_amount) {
			$project_budget_available =true;
			Log::debug('tenant.helper.PoBudget.poBudgetBook project_budget_available true.');
		} else {
			Log::warning('tenant.helper.PoBudget.poBudgetBook : E004');
			return 'E004';
		}

		// both budget is available
		if ($project_budget_available && $dept_budget_available ) {

			// book pr dept budget
			Log::debug('tenant.helper.PoBudget.poBudgetBook updating dept_budget->amount_po_booked.');
			Log::debug('tenant.helper.PoBudget.poBudgetBook before dept_budget->amount_po_booked = '.$dept_budget->amount_po_booked );
			Log::debug('tenant.helper.PoBudget.poBudgetBook updating po->fc_amount = '.$po->fc_amount);

			// did not book tax and gst for booking
			$dept_budget->amount_po_booked		= $dept_budget->amount_po_booked + $po->fc_amount;
			$dept_budget->count_po_booked		= $dept_budget->count_po_booked + 1;
			$dept_budget->save();
			Log::debug('tenant.helper.PoBudget.poBudgetBook dept_budget->amount_pr_booked = '.$dept_budget->amount_po_booked );

			// book project budget
			$project->amount_po_booked		   	= $project->amount_po_booked + $po->fc_amount;
			$project->count_po_booked			= $project->count_po_booked + 1;
			$project->save();

			// Pr supplier pr issues amount
			$supplier = Supplier::where('id', $po->supplier_id)->firstOrFail();
			$supplier->amount_po_booked		  =	 $supplier->amount_po_booked + $po->fc_amount;
			$supplier->count_po_booked 			= $supplier->count_po_booked + 1;
			$supplier->save();

			Log::debug('tenant.helper.PoBudget.poBudgetBook AFTER project->amount_po_booked = '.$project->amount_po_booked );

			// run job to Sync Budget
			RecordDeptBudgetUsage::dispatch(EntityEnum::PO->value, $po_id, EventEnum::BOOK->value, $po->fc_amount);
			ConsolidateBudget::dispatch($dept_budget->budget_id);
		}

		return '';
	}

	// Called from wfl->reject and po->cancel
	public static function poBudgetBookReverse($event, $po_id)
	{
		$po = Po::where('id', $po_id)->first();

		Log::debug('Helpers.PoBudget.poBudgetBookReject event = '.$event);
		Log::debug('Helpers.PoBudget.poBudgetBookReject po_id = '.$po->id);

		// reverse Po dept budget booking
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_po_booked = $dept_budget->amount_po_booked - $po->fc_amount;
		$dept_budget->count_po_booked = $dept_budget->count_po_booked - 1;
		$dept_budget->save();

		// reverse Po project booking
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_po_booked = $project->amount_po_booked - $po->fc_amount;
		$project->count_po_booked = $project->count_po_booked - 1;
		$project->save();

		// Pr supplier pr issues amount
		$supplier = Supplier::where('id', $po->supplier_id)->firstOrFail();
		$supplier->amount_po_booked = $supplier->amount_po_booked - $po->fc_amount;
		$supplier->count_po_booked 		= $supplier->count_po_booked + 1;
		$supplier->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PO->value, $po_id, $event, $po->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		return '';
	}

	public static function poBudgetApprove($po_id)
	{
		$po = Po::where('id', $po_id)->first();
		// Po dept budget approved
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_po_booked  = $dept_budget->amount_po_booked - $po->fc_amount;
		$dept_budget->count_po_booked   = $dept_budget->count_po_count - 1;

		$dept_budget->amount_po_tax		 = $dept_budget->amount_po_tax + $po->fc_tax;
		$dept_budget->amount_po_gst	 = $dept_budget->amount_po_gst + $po->fc_gst;

		$dept_budget->amount_po		  = $dept_budget->amount_po + $po->fc_amount;
		$dept_budget->count_po		   = $dept_budget->count_po + 1;
		$dept_budget->save();

		// Po project budget used
		$project = Project::where('	id', $po->project_id)->firstOrFail();
		$project->amount_po_booked	  = $project->amount_po_booked - $po->fc_amount;
		$project->count_po_booked 		= $project->count_po_booked - 1;

		$project->amount_po_tax		  = $project->amount_po_tax + $po->fc_tax;
		$project->amount_po_gst		  = $project->amount_po_gst + $po->fc_gst;

		$project->amount_po			  =	 $project->amount_po + $po->fc_amount;
		$project->count_po 				= $project->count_po + 1;
		$project->save();

		// Po supplier po issues amount
		$supplier = Supplier::where('id', $po->supplier_id)->firstOrFail();
		$supplier->amount_po_booked 	= $supplier->amount_po_booked - $po->fc_amount;
		$supplier->count_po_booked 		= $supplier->count_po_booked - 1;

		$supplier->amount_po_tax		 = $supplier->amount_po_tax + $po->fc_tax;
		$supplier->amount_po_gst		 = $supplier->amount_po_gst + $po->fc_gst;

		$supplier->amount_po				 = $supplier->amount_po + $po->fc_amount;
		$supplier->count_po 			= $supplier->count_po + 1;
		$supplier->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PO->value, $po_id, EventEnum::APPROVE->value,$po->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		return '';
	}


	public static function poBudgetApproveCancel($po_id)
	{

		$po = Po::where('id', $po_id)->first();

		// Cancel Po dept budget booking
		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();

		$dept_budget->amount_po_tax		 = $dept_budget->amount_po_tax - $po->fc_tax;
		$dept_budget->amount_po_gst	 = $dept_budget->amount_po_gst - $po->fc_gst;

		$dept_budget->amount_po		  = $dept_budget->amount_po - $po->fc_amount;
		$dept_budget->count_po		   = $dept_budget->count_po - 1;
		$dept_budget->save();

		// Cancel Po project booking
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_po_tax		  = $project->amount_po_tax - $po->fc_tax;
		$project->amount_po_gst		  = $project->amount_po_gst - $po->fc_gst;

		$project->amount_po			  =	 $project->amount_po - $po->fc_amount;
		$project->count_po 				= $project->count_po - 1;
		$project->save();

		// Po supplier po issues reduce
		$supplier = Supplier::where('id', $po->supplier_id)->firstOrFail();
		$supplier->amount_po_tax		 = $supplier->amount_po_tax - $po->fc_tax;
		$supplier->amount_po_gst			 = $supplier->amount_po_gst - $po->fc_gst;
		$supplier->amount_po				 = $supplier->amount_po - $po->fc_amount;
		$supplier->count_po 			= $supplier->count_po - 1;
		$supplier->save();

		// run job to Sync Budget
		RecordDeptBudgetUsage::dispatch(EntityEnum::PO->value, $po_id, EventEnum::CANCEL->value,$po->fc_amount);
		ConsolidateBudget::dispatch($dept_budget->budget_id);

		Log::debug("PoBudget.poBudgetApproveCancel Inside");

		return '';
	}

}
