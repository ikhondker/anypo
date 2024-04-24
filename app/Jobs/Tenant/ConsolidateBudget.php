<?php

namespace App\Jobs\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;

use DB;

use Illuminate\Support\Facades\Log;

class ConsolidateBudget implements ShouldQueue, ShouldBeUnique
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $budget_id;

	/**
	 * Create a new job instance.
	 */
	public function __construct($budget_id)
	{
		$this->budget_id 	= $budget_id;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		//Log::debug('ConsolidateBudget.jobs Value of budget_id=' . $this->budget_id);
		// get sum of DeptBudget for a specific budget
		$result= DeptBudget::where('budget_id', $this->budget_id)->get( array(
			DB::raw('SUM(amount) as amount'),
			DB::raw('SUM(amount_pr_booked) 	as amount_pr_booked'),
			DB::raw('SUM(amount_pr) 		as amount_pr'),
			DB::raw('SUM(amount_po_booked) 	as amount_po_booked'),
			DB::raw('SUM(amount_po) 		as amount_po'),
			DB::raw('SUM(amount_grs) 		as amount_grs'),
			DB::raw('SUM(amount_invoice)	as amount_invoice'),
			DB::raw('SUM(amount_payment) 	as amount_payment'),
			DB::raw('SUM(count_pr) 			as count_pr'),
			DB::raw('SUM(count_po) 			as count_po'),
			DB::raw('SUM(count_grs) 		as count_grs'),
			DB::raw('SUM(count_invoice) 	as count_invoice'),
			DB::raw('SUM(count_payment) 	as count_payment'),
		));
		
		// get and budget tu update based on DeptBudgetUsages table
		// populate Company Budget 
		$budget = Budget::where('id', $this->budget_id)->firstOrFail();
		foreach($result as $row) { 
			$budget->amount				= $row['amount'] ;
			$budget->amount_pr_booked	= $row['amount_pr_booked'] ;
			$budget->amount_pr			= $row['amount_pr'] ;
			$budget->amount_po_booked	= $row['amount_po_booked'];
			$budget->amount_po			= $row['amount_po'];
			$budget->amount_grs			= $row['amount_grs'];
			$budget->amount_invoice		= $row['amount_invoice'];
			$budget->amount_payment		= $row['amount_payment'];
			$budget->amount_grs			= $row['count_pr'];
			$budget->amount_grs			= $row['count_po'];
			$budget->amount_grs			= $row['count_grs'];
			$budget->amount_grs			= $row['count_invoice'];
			$budget->amount_grs			= $row['count_payment'];

		}
			$budget->save();

		//$budget->amount_pr_booked = $budget->amount_pr_booked + $pr->fc_amount;
		//$budget->save();
	}
}
