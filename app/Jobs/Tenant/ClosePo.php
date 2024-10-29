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
use App\Enum\Tenant\AuthStatusEnum;

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
	//protected $cancel;

	/**
	 * Create a new job instance.
	 */
	public function __construct($receipt_id)
	{
		$this->receipt_id 	= $receipt_id;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{

		Log::debug('Jobs.Tenant.ClosePo check po close  receipt_id = ' . $this->receipt_id);
		$receipt	= Receipt::with('pol')->where('id', $this->receipt_id)->firstOrFail();

        Log::debug('Jobs.Tenant.ClosePo receipt->status = ' . $receipt->status);
        if ($receipt->status == ReceiptStatusEnum::CANCELED->value){
			// open pol and po if not already
            Log::debug('Jobs.Tenant.ClosePo opening pol_id = ' . $receipt->pol_id);

            Pol::where('id', $receipt->pol_id)
                ->where('auth_status', AuthStatusEnum::APPROVED->value)
                ->where('closure_status',ClosureStatusEnum::CLOSED->value)
                ->update(['closure_status'=> ClosureStatusEnum::OPEN->value]);

            Log::debug('Jobs.Tenant.ClosePo opening po_id = ' . $receipt->pol->po_id);
			Po::where('id', $receipt->pol->po_id)->where('status','<>', ClosureStatusEnum::OPEN->value)->update(['status'=> ClosureStatusEnum::OPEN->value]);
			return;
		}

        // check if pol is full received
		$pol				= Pol::where('id', $receipt->pol_id)->firstOrFail();
		$sum_received_qty	= Receipt::where('pol_id',$receipt->pol_id)->sum('qty');
		if ( $receipt->pol->qty == $sum_received_qty) {
            Log::debug('Jobs.Tenant.ClosePo full received. closing pol_id = ' . $receipt->pol_id);
            // all qty received close pol
			$pol->closure_status = ClosureStatusEnum::CLOSED->value;
            $pol->save();
		} else {
			return;		// no need to continue further
		}

		// check if all pol is closed for this po then close the po also
		$count_open_pols	= Pol::where('po_id',$pol->po_id)->where('closure_status', ClosureStatusEnum::OPEN->value)->count();
		if ( $count_open_pols == 0) {
			// all pol closed close pol
            Log::debug('Jobs.Tenant.ClosePo full received. closing po_id = ' . $receipt->pol->po_id);
			Po::where('id', $pol->po_id)
                ->where('status',ClosureStatusEnum::OPEN->value)
                ->update(['status'=> ClosureStatusEnum::CLOSED->value]);
		} else {
			return;		// no need to continue further
		}
	}
}
