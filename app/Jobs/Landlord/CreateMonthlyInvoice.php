<?php

namespace App\Jobs\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Manage\Config;
use App\Models\Landlord\Account;

use App\Enum\Landlord\InvoiceTypeEnum;
use App\Enum\Landlord\InvoiceStatusEnum;

use App\Helpers\Landlord\Bo;
use App\Helpers\EventLog;

use App\Notifications\Landlord\InvoiceCreated;

use Illuminate\Support\Facades\Log;

class CreateMonthlyInvoice implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $account_id;
	protected $period;
	protected $process_id;

	/**
	 * Create a new job instance.
	 */
	public function __construct($account_id, $process_id = 0)
	{
		$this->account_id 	= $account_id;
		$this->process_id 	= $process_id;
		$this->period 		= 1;			// should be 1 always
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{

		$config = Config::first();
		Log::debug('jobs.landlord.CreateMonthlyInvoice Generating Invoice for account_id = ' . $this->account_id .' for period = '. $this->period);
		$account = Account::where('id', $this->account_id)->first();

		// Don't create invoice if unpaid invoice exists
		if ($account->next_bill_generated) {
			Log::debug('jobs.landlord.CreateMonthlyInvoice Unpaid invoice exists for account_id = ' . $this->account_id . '. Invoice not created.');
			return;
		}

		// Create new Invoice
		// logic: create invoice from the account.end_date+1, after current billed date
		$invoice				= new Invoice();
		// get unique invoice_no
		$invoice->invoice_no	= Bo::getInvoiceNo();
		$invoice->invoice_date	= now();

		$invoice->invoice_type	= InvoiceTypeEnum::SUBSCRIPTION->value;
		$invoice->from_date		= $account->end_date->addDay(1);
		$invoice->to_date		= $account->end_date->addDay(1)->addMonth($this->period);
		//Log::channel('bo')->info('Account id='. $account_id.' SECOND inv start '.$invoice->from_date.' to date '.$invoice->to_date);
		Log::channel('bo')->info('jobs.landlord.CreateMonthlyInvoice Account #' . $this->account_id . ' Second inv start ' . $invoice->from_date . ' to date ' . $invoice->to_date . ' period= ' . $this->period);

		$invoice->due_date		= $account->end_date;
		$invoice->summary		= config('app.domain'). ' - Your Invoice #'. $invoice->invoice_no;
		$invoice->notes			= 'Subscription Invoice for Account #' . $account->id . ' For ' . $account->site .'.'. config('app.domain');

		// consider account level discount
		Log::channel('bo')->info('jobs.landlord.CreateMonthlyInvoice account->discount = ' . $account->discount);
		$invoice->price			= round($this->period * $account->price * (100 - $account->discount)/100, 2) ;
		$invoice->subtotal		= $invoice->price;
		$invoice->amount		= $invoice->price;
		$invoice->account_id	= $account->id;
		$invoice->owner_id		= $account->owner_id;
		$invoice->process_id	= $this->process_id;

		// Save invoice
		$invoice->currency		= 'USD';
		$invoice->status_code	= InvoiceStatusEnum::DUE->value;
		$invoice->save();

		Log::channel('bo')->info('jobs.landlord.CreateMonthlyInvoice Invoice Generated invoice_id = ' . $invoice->id);
		EventLog::event('invoice', $invoice->id, 'create');

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
