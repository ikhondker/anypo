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
	protected $fc_amount;

	/**
	 * Create a new job instance.
	 */
	public function __construct($entity, $article_id, $event,$fc_amount)
	{
		$this->entity 		= $entity;
		$this->article_id 	= $article_id;
		$this->event 		= $event;
		$this->fc_amount 	= $fc_amount;
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
		$dbu->entity		= $this->entity;
		$dbu->article_id		= $this->article_id;
		$dbu->event		= $this->event;

		Log::debug('fc_amount='.$this->fc_amount);
		
		switch ($this->entity) {
			case EntityEnum::PR->value:
				$pr 			= Pr::where('id', $this->article_id)->firstOrFail();
				//Log::debug("dept_budget_id=". $pr->dept_budget_id);
				$dept_budget 	= DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
				$dbu->dept_budget_id	= $pr->dept_budget_id;
				$dbu->dept_id			= $pr->dept_id;
				$dbu->project_id		= $pr->project_id;

				switch ($this->event) {
					case EventEnum::BOOK->value:
						$dbu->amount_pr_booked	= $this->fc_amount;
						break;
					case EventEnum::RESET->value:
					case EventEnum::REJECT->value:
						$dbu->amount_pr_booked	= - $this->fc_amount;
						break;
					case EventEnum::APPROVE->value:
						$dbu->amount_pr_booked	= - $this->fc_amount;
						$dbu->amount_pr_issued	= $this->fc_amount;
						break;
					case EventEnum::CANCEL->value:
						// comes zero as original value
						$dbu->amount_pr_issued	= - $this->fc_amount;
						break;
					default:
						Log::debug("job.RecordDeptBudgetUsage-PR Other Event!");
				}
				break;
			case EntityEnum::PO->value:
				$po 			= Po::where('id', $this->article_id)->firstOrFail();

				//Log::debug("dept_budget_id=". $po->dept_budget_id);
				$dept_budget 			= DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
				$dbu->dept_budget_id	= $po->dept_budget_id;
				$dbu->dept_id			= $po->dept_id;
				$dbu->project_id		= $po->project_id;
				switch ($this->event) {
					case EventEnum::BOOK->value:
						$dbu->amount_po_booked	= $this->fc_amount;
						break;
					case EventEnum::RESET->value:
					case EventEnum::REJECT->value:
						$dbu->amount_po_booked	= - $this->fc_amount;
						break;
					case EventEnum::APPROVE->value:

						$dbu->amount_po_booked	= - $this->fc_amount;
						$dbu->amount_po_issued	= $this->fc_amount;
						break;
					case EventEnum::CANCEL->value:
						$dbu->amount_po_issued	= - $this->fc_amount;
						break;
					default:
						Log::debug("job.RecordDeptBudgetUsage-PO Other Event!");
				}
				break;
			case EntityEnum::RECEIPT->value:
				$receipt				= Receipt::with('pol.po')->where('id', $this->article_id)->firstOrFail();
				$receipt_dept_budget_id = $receipt->pol->po->dept_budget_id;

				//Log::debug("dept_budget_id=". $pr->dept_budget_id);
				$dept_budget 			= DeptBudget::primary()->where('id', $receipt_dept_budget_id)->firstOrFail();
				$dbu->dept_budget_id	= $receipt_dept_budget_id;
				$dbu->dept_id			= $receipt->pol->po->dept_id;
				$dbu->project_id		= $receipt->pol->po->project_id;

				switch ($this->event) {
					case EventEnum::CREATE->value:
						$dbu->amount_grs	= $this->fc_amount;
						break;
					case EventEnum::CANCEL->value:
						$dbu->amount_grs	= - $this->fc_amount;
						break;
					default:
						Log::debug("job.RecordDeptBudgetUsage-RECEIPT Other Event!");
				}
				break;
				case EntityEnum::INVOICE->value:
					Log::debug('I AM HERE 3');
					$invoice				= Invoice::with('po')->where('id', $this->article_id)->firstOrFail();
					$invoice_dept_budget_id = $invoice->po->dept_budget_id;
					Log::debug('I AM HERE 3a');
					//Log::debug("dept_budget_id=". $pr->dept_budget_id);
					$dept_budget 			= DeptBudget::primary()->where('id', $invoice_dept_budget_id)->firstOrFail();
					$dbu->dept_budget_id	= $invoice_dept_budget_id;
					$dbu->dept_id			= $invoice->po->dept_id;
					$dbu->project_id		= $invoice->po->project_id;
					Log::debug('I AM HERE 3b');
					switch ($this->event) {
						case EventEnum::CREATE->value:
							Log::debug('I AM HERE 4');
							$dbu->amount_invoice	= $this->fc_amount;
							break;
						case EventEnum::CANCEL->value:
							Log::debug('I AM HERE 4a');
							$dbu->amount_invoice	= - $this->fc_amount;
							break;
						default:
							Log::debug("job.RecordDeptBudgetUsage-INVOICE Other Event!");
					}
					break;
				case EntityEnum::PAYMENT->value:
						$payment				= Payment::with('invoice.po')->where('id', $this->article_id)->firstOrFail();
						$payment_dept_budget_id = $payment->invoice->po->dept_budget_id;

						//Log::debug("dept_budget_id=". $pr->dept_budget_id);
						$dept_budget 			= DeptBudget::primary()->where('id', $payment_dept_budget_id)->firstOrFail();
						$dbu->dept_budget_id	= $payment_dept_budget_id;
						$dbu->dept_id			= $payment->invoice->po->dept_id;
						$dbu->project_id		= $payment->invoice->po->project_id;

						switch ($this->event) {
							case EventEnum::CREATE->value:
								$dbu->amount_payment	= $this->fc_amount;
								break;
							case EventEnum::CANCEL->value:
								$dbu->amount_payment	= - $this->fc_amount;
								break;
							default:
								Log::debug("job.RecordDeptBudgetUsage-PAYMENT Other Event!");
						}
						break;

			default:
				Log::debug("job.RecordDeptBudgetUsage Other Entity!");
		}
		
		$dbu->save();
		Log::debug('I AM HERE 6 DONE');
	}
}