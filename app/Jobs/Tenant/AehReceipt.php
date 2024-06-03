<?php

namespace App\Jobs\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Enum\EntityEnum;
use App\Enum\AehEventEnum;
use App\Enum\AehStatusEnum;

use App\Models\Tenant\Ae\Aeh;
use App\Models\Tenant\Ae\Ael;

use App\Models\Tenant\Receipt;

use App\Models\Tenant\Admin\Setup;


use Illuminate\Support\Facades\Log;
use Str;
use DB;
class AehReceipt implements ShouldQueue
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
		$setup      = Setup::firstOrFail();
		$receipt 	= Receipt::with('pol.item')->where('id', $this->receipt_id)->firstOrFail();

		Log::debug('Jobs.Tenant.AehReceipt creating accounting for receipt_id = ' . $receipt->id);
		// check if invoice already accounted
		if ($receipt->accounted && !$this->cancel){
			Log::error('Jobs.Tenant.AehReceipt Invoice already accounted receipt_id =' . $receipt->id);
			return;
		}

        // create accounting header
        $aeh = new Aeh();
		$aeh->source_entity		= EntityEnum::RECEIPT->value;
        if ($this->cancel){
			$aeh->event			= AehEventEnum::CANCEL->value;
		} else {
			$aeh->event			= AehEventEnum::POST->value;
		}
		$aeh->accounting_date 	= date('Y-m-d');
        $aeh->description	    = $receipt->pol->item_description;
        $aeh->fc_currency	    = $setup->currency;
		$aeh->fc_dr_amount	    = $aeh->fc_cr_amount = $this->fc_amount;
		$aeh->po_id				= $receipt->pol->po_id;
		$aeh->article_id		= $receipt->id;
        //$aeh->reference_no      =  'GRS #'. $receipt->id;
        $aeh->reference_no      = Str::upper(EntityEnum::RECEIPT->value) .' #'. $receipt->id;
        $aeh->status            = AehStatusEnum::DRAFT->value;
        $aeh->save();
		$aeh_id                 = $aeh->id;
        Log::debug('Jobs.Tenant.AehReceipt created aeh record with aeh_id ='. $aeh_id);

		// create two accounting row
        $ael_dr						= new Ael;
		$ael_cr 					= new Ael;

        $ael_dr->aeh_id		        = $ael_cr->aeh_id 		= $aeh_id ;

        $ael_dr->line_num			= 1;
		$ael_cr->line_num			= 2;
        $ael_dr->accounting_date 	= $ael_cr->accounting_date	= date('Y-m-d');

        $ael_dr->ac_code			= $receipt->pol->item->ac_expense;
		$ael_cr->ac_code			= $setup->ac_accrual;

		$ael_dr->line_description	= $ael_cr->line_description = $receipt->pol->item_description;
		$ael_dr->fc_currency		= $ael_cr->fc_currency 		= $setup->currency;
		$ael_dr->reference_no		= $ael_cr->reference_no     = Str::upper(EntityEnum::RECEIPT->value) .' #'. $receipt->id;

		if ($this->cancel){
			$ael_dr->fc_dr_amount	= 0;
			$ael_dr->fc_cr_amount	= $this->fc_amount;

			$ael_cr->fc_dr_amount	= $this->fc_amount;
			$ael_cr->fc_cr_amount	= 0;
		} else {
			$ael_dr->fc_dr_amount	= $this->fc_amount;
			$ael_dr->fc_cr_amount	= 0;

			$ael_cr->fc_dr_amount	= 0;
			$ael_cr->fc_cr_amount	= $this->fc_amount;
		}

		$ael_dr->save();
		Log::debug('Jobs.Tenant.AehReceipt saving dr line ael_dr_id ='. $ael_dr->id);

		$ael_cr->save();
		Log::debug('Jobs.Tenant.AehReceipt saving cr line ael_cr_id ='. $ael_cr->id);

        // Update aeh header status
        $aeh->status            = AehStatusEnum::ACCOUNTED->value;
        $aeh->save();

		// Update accounted flag
		DB::statement("UPDATE receipts SET
		    accounted		= true
		    WHERE id = ".$receipt->id."");
	}
}
