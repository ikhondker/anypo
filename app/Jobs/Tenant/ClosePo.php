<?php

namespace App\Jobs\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

//use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\ClosureStatusEnum;
use App\Enum\Tenant\ReceiptStatusEnum;

use App\Models\Tenant\Receipt;
use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;

use Illuminate\Support\Facades\Log;

use Str;
use DB;

class ClosePo implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $receipt_id;
	//protected $fc_amount;		// This is needed for canceled invoices
	protected $cancel;

	/**
	 * Create a new job instance.
	 */
	public function __construct($receipt_id, $cancel = false)
	{
		$this->receipt_id 	= $receipt_id;
		$this->cancel 		= $cancel;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{

		Log::debug('Jobs.Tenant.ClosePo check po close  receipt_id = ' . $this->receipt_id);
		$receipt	= Receipt::with('pol')->where('id', $this->receipt_id)->firstOrFail();
		if ($receipt->status == ReceiptStatusEnum::CANCELED->value){
			$cancel = true;
			// open pol and po if not already
			Pol::where('id', $receipt->pol_id)->where('closure_status','<>', ClosureStatusEnum::OPEN->value)->update(['closure_status'=> ClosureStatusEnum::OPEN->value]);
			Po::where('id', $receipt->pol->po_id)->where('status','<>', ClosureStatusEnum::OPEN->value)->update(['status'=> ClosureStatusEnum::OPEN->value]);
			return;
		} else {
			$cancel = false;
		}

		$pol	            = Pol::where('id', $receipt->pol_id)->firstOrFail();
		$sum_received_qty	= Receipt::where('pol_id',$receipt->pol_id)->sum();
		if ( $receipt->pol->qty == $sum_received_qty) {
			// all qty received close pol
			$pol->closure_status = ClosureStatusEnum::CLOSED->value;
		} else {
			return;       // no need to continue further
		}

		// check if all pol is closed for this po then close the po also
		$count_open_pols	= Pol::where('po_id',$pol->po_id)->where('closure_status', ClosureStatusEnum::OPEN->value)->count();
		if ( $count_open_pols == 0) {
			// all pol closed close pol
			Po::where('id', $pol->po_id)->update(['status'=> ClosureStatusEnum::CLOSED->value]);
		} else {
			return;       // no need to continue further
		}

	}
}
