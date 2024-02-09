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
use App\Models\Tenant\Dbu;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\Tenant\Receipt;
use App\Models\Tenant\Invoice;
use App\Models\Tenant\Payment;

use App\Enum\EntityEnum;
use App\Enum\EventEnum;

use Illuminate\Support\Facades\Log;

class RecordDeptBudgetUsage implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $entity;
	protected $article_id;
	protected $event;
	
	/**
	 * Create a new job instance.
	 */
	public function __construct($entity, $article_id, $event)
	{
		$this->entity 		= $entity;
		$this->article_id 	= $article_id;
		$this->event 		= $event;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		// DeptBudget is already updated form source submit to avoid delay of Jobs

		//Log::debug("entity=".$this->entity);
		//Log::debug("event=".$this->event);
		//Log::debug("article_id=".$this->article_id);

		// insert row in DeptBudgetUsages table
		$dbu					= new Dbu();
		$dbu->entity			= $this->entity;	
		$dbu->article_id		= $this->article_id;
		$dbu->event				= $this->event;
		switch ($this->entity) {
			case EntityEnum::PR->value:
		
				$pr 			= Pr::where('id', $this->article_id)->firstOrFail();
		
				Log::debug("dept_budget_id=". $pr->dept_budget_id);
				$dept_budget 	= DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
				$dbu->dept_budget_id	= $pr->dept_budget_id;
				$dbu->dept_id			= $pr->dept_id;
				$dbu->project_id		= $pr->project_id;

				switch ($this->event) {
					case EventEnum::BOOK->value:
						$dbu->amount_pr_booked	= $pr->fc_amount;
						break;
					case EventEnum::REJECT->value:
						$dbu->amount_pr_booked	= - $pr->fc_amount;
						break;
					case EventEnum::APPROVE->value:
						$dbu->amount_pr_booked	= - $pr->fc_amount;
						$dbu->amount_pr_issued	= $pr->fc_amount;
						break;
					case EventEnum::CANCEL->value:
						$dbu->amount_pr_issued	= - $pr->fc_amount;
						break;
					default:
						Log::debug("job.RecordDeptBudgetUsage Other Event!");
				}
				break;
			case EntityEnum::PO->value:
				$po 			= Po::where('id', $this->article_id)->firstOrFail();
		
				Log::debug("dept_budget_id=". $po->dept_budget_id);
				$dept_budget 			= DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
				$dbu->dept_budget_id	= $po->dept_budget_id;
				$dbu->dept_id			= $po->dept_id;
				$dbu->project_id		= $po->project_id;

				switch ($this->event) {
					case EventEnum::BOOK->value:
						$dbu->amount_po_booked	= $po->fc_amount;
						break;
					case EventEnum::REJECT->value:
						$dbu->amount_po_booked	= - $po->fc_amount;
						break;
					case EventEnum::APPROVE->value:
						$dbu->amount_po_booked	= - $po->fc_amount;
						$dbu->amount_po_issued	= $po->fc_amount;
						break;
					case EventEnum::CANCEL->value:
						$dbu->amount_po_issued	= - $po->fc_amount;
						break;
					default:
						Log::debug("job.RecordDeptBudgetUsage Other Event!");
				}
				break;
			default:
				Log::debug("job.RecordDeptBudgetUsage Other Entity!");
		}
		$dbu->save();

	}
}
