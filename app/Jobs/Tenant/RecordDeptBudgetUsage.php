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

use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\EventEnum;

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
	public function __construct($entity, $article_id, $event, $fc_amount)
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
		$dbu				= new Dbu();
		$dbu->entity		= $this->entity;
		$dbu->article_id	= $this->article_id;
		$dbu->event			= $this->event;
		$dbu->amount		= $this->fc_amount;
		// job don't have this ID
		//$dbu->user_id		= auth()->user()->id;

		Log::debug('jobs.Tenant.RecordDeptBudgetUsage.handle entity = '.$this->entity);
		Log::debug('jobs.Tenant.RecordDeptBudgetUsage.handle article_id = '.$this->article_id);
		Log::debug('jobs.Tenant.RecordDeptBudgetUsage.handle event = '.$this->event);
		Log::debug('jobs.Tenant.RecordDeptBudgetUsage.handle fc_amount = '.$this->fc_amount);

		switch ($this->entity) {
			case EntityEnum::PR->value:
				$pr 			= Pr::where('id', $this->article_id)->firstOrFail();
				$dbu->user_id	= $pr->created_by;
				//Log::debug("dept_budget_id=". $pr->dept_budget_id);
				$dept_budget 			= DeptBudget::primary()->where('id', $pr->dept_budget_id)->firstOrFail();
				$dbu->dept_budget_id	= $pr->dept_budget_id;
				$dbu->dept_id			= $pr->dept_id;
				$dbu->project_id		= $pr->project_id;
				$dbu->supplier_id		= $pr->supplier_id;


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
						$dbu->amount_pr	= $this->fc_amount;
						break;
					case EventEnum::CANCEL->value:
						// comes zero as original value
						$dbu->amount_pr	= - $this->fc_amount;
						break;
					default:
						Log::warning("job.Tenant.RecordDeptBudgetUsage-PR Other Event!");
				}
				break;
			case EntityEnum::PO->value:
				$po 			= Po::where('id', $this->article_id)->firstOrFail();
				$dbu->user_id	= $po->created_by;

				//Log::debug("dept_budget_id=". $po->dept_budget_id);
				$dept_budget 			= DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
				$dbu->dept_budget_id	= $po->dept_budget_id;
				$dbu->dept_id			= $po->dept_id;
				$dbu->project_id		= $po->project_id;
				$dbu->supplier_id		= $po->supplier_id;

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
						$dbu->amount_po	= $this->fc_amount;
						break;
					case EventEnum::CANCEL->value:
						$dbu->amount_po	= - $this->fc_amount;
						break;
					default:
						Log::warning("job.Tenant.RecordDeptBudgetUsage-PO Other Event!");
				}
				break;
			case EntityEnum::RECEIPT->value:
				$receipt				= Receipt::with('pol.po')->where('id', $this->article_id)->firstOrFail();
				$dbu->user_id			= $receipt->created_by;
				$receipt_dept_budget_id = $receipt->pol->po->dept_budget_id;

				//Log::debug("dept_budget_id=". $pr->dept_budget_id);
				$dept_budget 			= DeptBudget::primary()->where('id', $receipt_dept_budget_id)->firstOrFail();
				$dbu->dept_budget_id	= $receipt_dept_budget_id;
				$dbu->dept_id			= $receipt->pol->po->dept_id;
				$dbu->project_id		= $receipt->pol->po->project_id;
				$dbu->supplier_id		= $receipt->pol->po->supplier_id;

				switch ($this->event) {
					case EventEnum::CREATE->value:
						$dbu->amount_grs	= $this->fc_amount;
						break;
					case EventEnum::CANCEL->value:
						$dbu->amount_grs	= - $this->fc_amount;
						break;
					default:
						Log::warning("job.Tenant.RecordDeptBudgetUsage-RECEIPT Other Event!");
				}
				break;
				case EntityEnum::INVOICE->value:
					//Log::debug('I AM HERE 3');
					$invoice				= Invoice::with('po')->where('id', $this->article_id)->firstOrFail();
					$dbu->user_id			= $invoice->created_by;
					$invoice_dept_budget_id = $invoice->po->dept_budget_id;
					//Log::debug("dept_budget_id=". $pr->dept_budget_id);
					$dept_budget 			= DeptBudget::primary()->where('id', $invoice_dept_budget_id)->firstOrFail();
					$dbu->dept_budget_id	= $invoice_dept_budget_id;
					$dbu->dept_id			= $invoice->po->dept_id;
					$dbu->project_id		= $invoice->po->project_id;
					$dbu->supplier_id		= $invoice->po->supplier_id;
					//Log::debug('I AM HERE 3b');
					switch ($this->event) {
						case EventEnum::POST->value:
							//Log::debug('I AM HERE 4');
							$dbu->amount_invoice	= $this->fc_amount;
							break;
						case EventEnum::CANCEL->value:
							//Log::debug('I AM HERE 4a');
							$dbu->amount_invoice	= - $this->fc_amount;
							break;
						default:
							Log::warning("job.Tenant.RecordDeptBudgetUsage-INVOICE Other Event!");
					}
					break;
				case EntityEnum::PAYMENT->value:
						$payment				= Payment::with('invoice.po')->where('id', $this->article_id)->firstOrFail();
						$dbu->user_id			= $payment->created_by;
						$payment_dept_budget_id = $payment->invoice->po->dept_budget_id;

						//Log::debug("dept_budget_id=". $pr->dept_budget_id);
						$dept_budget 			= DeptBudget::primary()->where('id', $payment_dept_budget_id)->firstOrFail();
						$dbu->dept_budget_id	= $payment_dept_budget_id;
						$dbu->dept_id			= $payment->invoice->po->dept_id;
						$dbu->project_id		= $payment->invoice->po->project_id;
						$dbu->supplier_id		= $payment->invoice->po->supplier_id;

						switch ($this->event) {
							case EventEnum::CREATE->value:
								$dbu->amount_payment	= $this->fc_amount;
								break;
							case EventEnum::CANCEL->value:
								$dbu->amount_payment	= - $this->fc_amount;
								break;
							default:
								Log::warning("job.Tenant.RecordDeptBudgetUsage-PAYMENT Other Event!");
						}
						break;

			default:
				Log::error("job.Tenant.RecordDeptBudgetUsage Other Entity!");
		}
		Log::debug("job.Tenant.RecordDeptBudgetUsage Complete.");
		$dbu->save();
	}
}
