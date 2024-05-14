<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Workflow.php
* @brief		This file contains the implementation of the Workflow
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
use DB;
use File;
use Str;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Dbu;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Receipt;
use App\Models\Tenant\Invoice;
use App\Models\Tenant\Payment;

use App\Models\Tenant\Lookup\Supplier;


use Illuminate\Support\Facades\Log;

use function Ramsey\Uuid\v1;

class ChartData
{
	public static function getRandomData()
	{

		$amount 			= random_int(80000, 99999);

		$pr_total_amount 	= random_int(70000, $amount);
		$amount_pr_booked 	= $pr_total_amount *.1;
		$amount_pr 			= $pr_total_amount *.9;

		$po_total_amount 	= random_int(40000, $amount_pr);
		$amount_po_booked 	= $po_total_amount *.1;
		$amount_po 			= $po_total_amount *.9;

		$amount_grs 		= random_int(35000, $amount_po);
		$amount_invoice 	= random_int(30000, $amount_grs);
		$amount_payment 	= random_int(25000, $amount_invoice);

		$count_pr 			= random_int(5, 25);
		$count_po 			= random_int(5, 25);
		$count_grs 			= random_int(5, 25);
		$count_invoice 		= random_int(5, 25);
		$count_payment 		= random_int(5, 25);


		return [
			'amount' 			=> $amount,
			'amount_pr_booked' 	=> $amount_pr_booked,
			'amount_pr' 		=> $amount_pr,
			'amount_po_booked' 	=> $amount_po_booked,
			'amount_po' 		=> $amount_po,
			'amount_grs' 		=> $amount_grs,
			'amount_invoice' 	=> $amount_invoice,
			'amount_payment' 	=> $amount_payment,
			'count_pr' 			=> $count_pr,
			'count_po' 			=> $count_po,
			'count_grs' 		=> $count_grs,
			'count_invoice' 	=> $count_invoice,
			'count_payment' 	=> $count_payment,
		];
	}

	public static function budget()
	{

		$data = self::getRandomData();
		//Log::debug($data['amount']);

		$budget = Budget::where('id', 1001 )->orderBy('id', 'ASC')->first();

		$budget->amount 			= $data['amount'];
		$budget->amount_pr_booked 	= $data['amount_pr_booked'];
		$budget->amount_pr 			= $data['amount_pr'];

		$budget->amount_po_booked 	= $data['amount_po_booked'];
		$budget->amount_po 			= $data['amount_po'];

		$budget->amount_grs 		= $data['amount_grs'];
		$budget->amount_invoice 	= $data['amount_invoice'];
		$budget->amount_payment 	= $data['amount_payment'];

		$budget->count_pr 			= $data['count_pr'];
		$budget->count_po 			= $data['count_po'];
		$budget->count_grs 			= $data['count_grs'];
		$budget->count_invoice 		= $data['count_invoice'];
		$budget->count_payment 		= $data['count_payment'];
		$budget->save();

		// foreach ($accounts as $account) {
		// 	Log::debug('Checking for archival for Account id = ' . $account->id);
		// }

		//Log::info(print_r($aa, true));

	}
	public static function deptBudget()
	{

		$deptBudgets = DeptBudget::where('budget_id', 1001 )->orderBy('id', 'ASC')->get();
		foreach ($deptBudgets as $deptBudget) {
			$rowDeptBudget = DeptBudget::where('id', $deptBudget->id )->orderBy('id', 'ASC')->first();

			$data = self::getRandomData();
			//Log::debug('rowDeptBudget_id=' . $rowDeptBudget->id);
			//Log::debug('---------------------------------');
			// 	Log::debug('Checking for archival for Account id=' . $account->id);
			// Log::debug('amount 				='. $data['amount']);
			// Log::debug('amount_pr_booked 	='. $data['amount_pr_booked']);
			// Log::debug('amount_pr 			='. $data['amount_pr']);

			// Log::debug('amount_po_booked 	='. $data['amount_po_booked']);
			// Log::debug('amount_po 			='. $data['amount_po']);

			// Log::debug('amount_grs 			='. $data['amount_grs']);
			// Log::debug('amount_invoice 		='. $data['amount_invoice']);
			// Log::debug('amount_payment 		='. $data['amount_payment']);

			// Log::debug('count_pr 			='. $data['count_pr']);
			// Log::debug('count_po 			='. $data['count_po']);
			// Log::debug('count_grs 			='. $data['count_grs']);
			// Log::debug('count_invoice 		='. $data['count_invoice']);
			// Log::debug('count_payment 		='. $data['count_payment']);

			$rowDeptBudget->amount 				= $data['amount'];
			$rowDeptBudget->amount_pr_booked 	= $data['amount_pr_booked'];
			$rowDeptBudget->amount_pr 			= $data['amount_pr'];

			$rowDeptBudget->amount_po_booked 	= $data['amount_po_booked'];
			$rowDeptBudget->amount_po 			= $data['amount_po'];

			$rowDeptBudget->amount_grs 			= $data['amount_grs'];
			$rowDeptBudget->amount_invoice 		= $data['amount_invoice'];
			$rowDeptBudget->amount_payment 		= $data['amount_payment'];

			$rowDeptBudget->count_pr 			= $data['count_pr'];
			$rowDeptBudget->count_po 			= $data['count_po'];
			$rowDeptBudget->count_grs 			= $data['count_grs'];
			$rowDeptBudget->count_invoice 		= $data['count_invoice'];
			$rowDeptBudget->count_payment 		= $data['count_payment'];
			$rowDeptBudget->save();

		}
	}

	public static function project()
	{
		$projects = Project::orderBy('id', 'ASC')->get();
		foreach ($projects as $project) {
			$rowProject = Project::where('id', $project->id )->orderBy('id', 'ASC')->first();
			//Log::debug('rowProject_id=' . $rowProject->id);
			//Log::debug('---------------------------------');
			$data = self::getRandomData();

			$rowProject->amount 			= $data['amount'];
			$rowProject->amount_pr_booked 	= $data['amount_pr_booked'];
			$rowProject->amount_pr 			= $data['amount_pr'];

			$rowProject->amount_po_booked 	= $data['amount_po_booked'];
			$rowProject->amount_po 			= $data['amount_po'];

			$rowProject->amount_grs 		= $data['amount_grs'];
			$rowProject->amount_invoice 	= $data['amount_invoice'];
			$rowProject->amount_payment 	= $data['amount_payment'];

			$rowProject->count_pr 			= $data['count_pr'];
			$rowProject->count_po 			= $data['count_po'];
			$rowProject->count_grs 			= $data['count_grs'];
			$rowProject->count_invoice 		= $data['count_invoice'];
			$rowProject->count_payment 		= $data['count_payment'];
			$rowProject->save();


		}
	}

	public static function supplier()
	{
		$suppliers = Supplier::orderBy('id', 'ASC')->get();
		foreach ($suppliers as $supplier) {
			$rowSupplier = Supplier::where('id', $supplier->id )->orderBy('id', 'ASC')->first();

			//Log::debug('---------------------------------');
			$data = self::getRandomData();

			$rowSupplier->amount_pr_booked 	= $data['amount_pr_booked'];
			$rowSupplier->amount_pr 		= $data['amount_pr'];

			$rowSupplier->amount_po_booked 	= $data['amount_po_booked'];
			$rowSupplier->amount_po 		= $data['amount_po'];

			$rowSupplier->amount_grs 		= $data['amount_grs'];
			$rowSupplier->amount_invoice 	= $data['amount_invoice'];
			$rowSupplier->amount_payment 	= $data['amount_payment'];

			$rowSupplier->count_pr 			= $data['count_pr'];
			$rowSupplier->count_po 			= $data['count_po'];
			$rowSupplier->count_grs 		= $data['count_grs'];
			$rowSupplier->count_invoice 	= $data['count_invoice'];
			$rowSupplier->count_payment 	= $data['count_payment'];
			$rowSupplier->save();


		}
	}

}
