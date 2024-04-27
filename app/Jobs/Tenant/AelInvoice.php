<?php

namespace App\Jobs\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Enum\EntityEnum;
use App\Enum\AelEvent;

use App\Models\Tenant\Invoice;
use App\Models\Tenant\Ael;
use App\Models\Tenant\Admin\Setup;

use Illuminate\Support\Facades\Log;

use Str;
use DB;

class AelInvoice implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $invoice_id;
	protected $fc_amount;		// This is needed for canceled invoices
	protected $cancel;

	/**
	 * Create a new job instance.
	 */
	public function __construct($invoice_id, $fc_amount, $cancel = false)
	{
		$this->invoice_id 	= $invoice_id;
		$this->fc_amount 	= $fc_amount;
		$this->cancel 		= $cancel;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		$setup = Setup::firstOrFail();
		$invoice = Invoice::where('id', $this->invoice_id)->firstOrFail();

		Log::debug('Jobs.Tenant.AelInvoice creating accounting for invoice_id =' . $invoice->id);
		
		// check if invoice already accounted
		if ($invoice->accounted && !$this->cancel){
			Log::error('Jobs.Tenant.AelInvoice Invoice already accounted invoice_id =' . $invoice->id);
			return;
		}

		// create two accounting row
		$ael_dr						= new Ael;
		$ael_cr 					= new Ael;

		$ael_dr->entity				= $ael_cr->entity 			= EntityEnum::INVOICE->value;
		$ael_dr->accounting_date 	= $ael_cr->accounting_date	= date('Y-m-d');
		$ael_dr->line_description	= $ael_cr->line_description = $invoice->summary;
		$ael_dr->fc_currency		= $ael_cr->fc_currency 		= $setup->currency;
		$ael_dr->reference			= $ael_cr->reference 		= Str::upper(EntityEnum::INVOICE->value) .' #'. $invoice->id;
		$ael_dr->po_id				= $ael_cr->po_id 			= $invoice->po_id;
		$ael_dr->article_id			= $ael_cr->article_id 		= $invoice->id;

		$ael_dr->ac_code			= $setup->ac_accrual;
		$ael_cr->ac_code			= $setup->ac_liability;
		
		if ($this->cancel){
			$ael_dr->event			= $ael_cr->event 			= AelEvent::CANCEL->value;

			$ael_dr->fc_dr_amount	= 0;
			$ael_dr->fc_cr_amount	= $this->fc_amount;

			$ael_cr->fc_dr_amount	= $this->fc_amount;
			$ael_cr->fc_cr_amount	= 0; 
		} else {
			$ael_dr->event			= $ael_cr->event 			= AelEvent::POST->value;

			$ael_dr->fc_dr_amount	= $this->fc_amount;
			$ael_dr->fc_cr_amount	= 0;

			$ael_cr->fc_dr_amount	= 0;
			$ael_cr->fc_cr_amount	= $this->fc_amount; 
		}
		
		$ael_dr->save();
		Log::debug('Jobs.Tenant.AelInvoice saving dr line ael_dr_id ='. $ael_dr->id);
		
		$ael_cr->save();
		Log::debug('Jobs.Tenant.AelInvoice saving cr line ael_cr_id ='. $ael_cr->id);

		// Update accounted flag
		DB::statement("UPDATE invoices SET 
		accounted		= true
		WHERE id = ".$invoice->id."");
	}
}
