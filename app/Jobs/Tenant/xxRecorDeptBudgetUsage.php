<?php

namespace App\Jobs\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecorDeptBudgetUsage implements ShouldQueue
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

		// insert row in DeptBudgetUsages table
		$dbu					= new DeptBudgetUsages();
		$dbu->entity			= $this->entity;	
		$dbu->article_id		= $this->article_id;
		$dbu->event				= $this->event;
		switch ($this->entity) {
			case EntityEnum::PR->value:
				$pr 			= Pr::where('id', $this->pr_id)->firstOrFail();
				$dept_budget 	= DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();			
				switch ($this->event) {
					case EventEnum::BOOK->value:
						$dbu->dept_budget_id	= $pr->dept_budget_id;
						$dbu->amount_pr_booked	= $pr->fc_amount;
						break;
					case EventEnum::CONFIRM->value:
						$dbu->amount_pr_issued	= $pr->fc_amount;
						break;
					default:
						Log::debug("job.SynBudget Other Event!");
				}
			case EntityEnum::PO->value:
				break;
			default:
				Log::debug("job.SynBudget Other Entity!");
		}
		$dbu->save();
	}
}
