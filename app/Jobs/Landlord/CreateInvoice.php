<?php

namespace App\Jobs\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Manage\Setup;
use App\Models\Landlord\Account;

use App\Enum\LandlordInvoiceTypeEnum;
use App\Enum\LandlordInvoiceStatusEnum;

use App\Helpers\Bo;
use App\Helpers\LandlordEventLog;

use App\Notifications\Landlord\InvoiceCreated;

use Illuminate\Support\Facades\Log;

class CreateInvoice implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $account_id;
	protected $period;
	
	/**
	 * Create a new job instance.
	 */
	public function __construct($account_id, $period)
	{
		$this->account_id = $account_id;
		$this->period = $period;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{

		$setup = Setup::first();
		Log::debug('jobs.landlord.CreateInvoice Generating Invoice for account_id = ' . $this->account_id .'for period ='. $this->period);
		$account = Account::where('id', $this->account_id)->first();

		// Don't create invoice if unpaid invoice exists
		if ($account->next_bill_generated) {
			Log::debug('jobs.landlord.CreateInvoice Unpaid invoice exists for account_id=' . $this->account_id . '. Invoice not created.');
			return;
		}

		// Create new Invoice
		// logic: create invoice from the account.end_date+1, after current billed date
		$invoice				= new Invoice();
		// get unique invoice_no
		$invoice->invoice_no	= Bo::getInvoiceNo();
		$invoice->invoice_date	= now();
		//Log::channel('bo')->info('Account id='. $account_id.' last_bill_from_date '.$account->last_bill_from_date);
		$invoice->invoice_type	= LandlordInvoiceTypeEnum::SUBSCRIPTION->value;
		$invoice->from_date		= $account->end_date->addDay(1);
		$invoice->to_date		= $account->end_date->addDay(1)->addMonth($this->period);
		//Log::channel('bo')->info('Account id='. $account_id.' SECOND inv start '.$invoice->from_date.' to date '.$invoice->to_date);
		Log::channel('bo')->info('jobs.landlord.CreateInvoice Account #' . $this->account_id . ' Second inv start ' . $invoice->from_date . ' to date ' . $invoice->to_date . ' period= ' . $this->period);

		$invoice->due_date		= $account->end_date;
		$invoice->summary		= 'Subscription Invoice for Account #' . $account->id . ' for' . $account->site .'.'. env('APP_DOMAIN');

		switch ($this->period) {
			case '1':
				$discount_pc =0 ;
				break;
			case '3':
				$discount_pc = $setup->discount_pc_3 ;
				break;
			case '6':
				$discount_pc = $setup->discount_pc_6 ;
				break;
			case '12':
				$discount_pc = $setup->discount_pc_12 ;
			 	break;
			case '24':
				$discount_pc = $setup->discount_pc_24 ;
				break;
			default:
				$discount_pc =0 ;
		}

		Log::debug('jobs.landlord.CreateInvoice discount_pc= ' . $discount_pc);

		$invoice->price		= round($this->period * $account->price * (100 - $discount_pc)/100,2) ;
		$invoice->subtotal	= $invoice->price;
		$invoice->amount	= $invoice->price;
		$invoice->account_id= $account->id;
		$invoice->owner_id	= $account->owner_id;

		// Save invoice
		$invoice->currency		= 'USD';
		$invoice->status_code	= LandlordInvoiceStatusEnum::DUE->value;
		$invoice->save();

		Log::debug('jobs.landlord.CreateInvoice Invoice Generated id=' . $invoice->id);
		LandlordEventLog::event('invoice', $invoice->id, 'create');

		// update account billing info
		// $account->last_bill_from_date	= $invoice->from_date;
		// $account->last_bill_to_date	= $invoice->to_date;
		$account->next_bill_generated	= true;
		$account->next_invoice_no		= $invoice->invoice_no;
		$account->last_bill_date		= now();
		$account->save();

		// identify user to notify
		$user = User::where('id', $account->owner_id)->first();

		// Invoice Created Notification
		$user->notify(new InvoiceCreated($user, $invoice));
	}
}
