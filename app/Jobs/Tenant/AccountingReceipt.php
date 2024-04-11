<?php

namespace App\Jobs\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Enum\EntityEnum;
use App\Enum\AccountingEvent;

use App\Models\Tenant\Receipt;
use App\Models\Tenant\Accounting;
use App\Models\Tenant\Admin\Setup;

use Illuminate\Support\Facades\Log;
use Str;

class AccountingReceipt implements ShouldQueue
{
	protected $receipt_id;
	protected $fc_amount;		// This is needed for canceled invoices
	protected $cancel;

	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 */
	public function __construct($receipt_id, $fc_amount, $cancel = false)
	{
		$this->receipt_id 	= $receipt_id;
		$this->fc_amount 	= $fc_amount;
		$this->cancel 		= $cancel;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		$setup = Setup::firstOrFail();
		$receipt 	= Receipt::with('pol.item')->where('id', $this->receipt_id)->firstOrFail();

		Log::debug('Jobs.Tenant.AccountingReceipt creating accounting for invoice_id =' . $receipt->id);
		
		// create two accounting  row
		$ael_dr						= new Accounting;
		$ael_cr 					= new Accounting;

		$ael_dr->entity				= $ael_cr->entity 			= EntityEnum::RECEIPT->value;
		$ael_dr->accounting_date 	= $ael_cr->accounting_date	= date('Y-m-d H:i:s');
		$ael_dr->line_description	= $ael_cr->line_description = $receipt->pol->item_description;
		$ael_dr->fc_currency		= $ael_cr->fc_currency 		= $setup->currency;
		$ael_dr->reference			= $ael_cr->reference 		= Str::upper(EntityEnum::RECEIPT->value) .' #'. $receipt->id;
		$ael_dr->po_id				= $ael_cr->po_id 			= $receipt->pol->po_id;
		$ael_dr->article_id			= $ael_cr->article_id 		= $receipt->id;

		$ael_dr->ac_code			= $receipt->pol->item->ac_expense;
		$ael_cr->ac_code			= $setup->ac_accrual;
		
		if ($this->cancel){
			$ael_dr->event			= $ael_cr->event 			= AccountingEvent::CANCEL->value;

			$ael_dr->fc_dr_amount	= 0;
			$ael_dr->fc_cr_amount	= $this->fc_amount;;

			$ael_cr->fc_dr_amount	= $this->fc_amount;;
			$ael_cr->fc_cr_amount	= 0; 
		} else {
			$ael_dr->event			= $ael_cr->event 			= AccountingEvent::POST->value;

			$ael_dr->fc_dr_amount	= $this->fc_amount;
			$ael_dr->fc_cr_amount	= 0;

			$ael_cr->fc_dr_amount	= 0;
			$ael_cr->fc_cr_amount	= $this->fc_amount; 
		}
		
		$ael_dr->save();
		Log::debug('Jobs.Tenant.AccountingReceipt saving dr line ael_dr_id ='. $ael_dr->id);
		
		$ael_cr->save();
		Log::debug('Jobs.Tenant.AccountingReceipt saving cr line ael_cr_id ='. $ael_cr->id);
	}
}
