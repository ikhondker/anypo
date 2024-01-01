<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			InvoiceController.php
* @brief		This file contains the implementation of the InvoiceController
* @path			\app\Http\Controllers\Landlord\Admin
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

 namespace App\Http\Controllers\Landlord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Admin\StoreInvoiceRequest;
use App\Http\Requests\Landlord\Admin\UpdateInvoiceRequest;

// Models

use App\Models\User;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Account;

use App\Models\Landlord\Manage\Setup;

// Enums
use App\Enum\UserRoleEnum;
use App\Enum\LandlordInvoiceTypeEnum;
use App\Enum\LandlordInvoiceStatusEnum;

// Helpers
use App\Helpers\Bo;
use App\Helpers\LandlordEventLog;

use Notification;
use App\Notifications\Landlord\InvoiceCreated;

// Seeded
use Illuminate\Support\Facades\Log;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class InvoiceController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY	= 'INVOICE';


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//$invoices= Invoice::orderBy('id', 'DESC')->paginate(10);
		// switch (auth()->user()->role->value) {
		// 	case UserRoleEnum::ADMIN->value:
		// 		$invoices = Invoice::byAccount()->orderBy('id', 'DESC')->paginate(10);
		// 		break;
		// 	default:
		// 		$invoices = Invoice::byAccount()->orderBy('id', 'DESC')->paginate(10);
		// 		Log::debug("Inside Invoice Index. Ignore. Other roles!");
		// }

		$invoices = Invoice::byAccount()->orderBy('id', 'DESC')->paginate(10);
		return view('landlord.admin.invoices.index', compact('invoices'))->with('i', (request()->input('page', 1) - 1) * 10);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{

		$this->authorize('viewAll',Invoice::class);

		//$invoices= Invoice::orderBy('id', 'DESC')->paginate(10);

		$invoices = Invoice::orderBy('id', 'DESC')->paginate(10);

		return view('landlord.admin.invoices.all', compact('invoices'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{

		$this->authorize('create', Invoice::class);

		if (auth()->user()->account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not generate Invoice as no valid Account Found!');
			//return view('landlord.pages.error')->with('title','Account not Found!')->with('msg','Sorry, you can not generate Invoice as not valid Account Found!');
			//abort(403);
		}

		$account = Account::where('id', auth()->user()->account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('Unpaid invoice exists for Account id=' . $account->id . ' Invoice not created.');
			return redirect()->route('invoices.index')->with('error', 'Unpaid invoice exists for Account id=' . $account->id . '! Can not create more Invoices.');
		}

		$setup = Setup::with('relCountry')->where('id', config('bo.SETUP_ID'))->first();

		return view('landlord.admin.invoices.create', compact('account', 'setup'));
		//return view('landlord.invoices.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreInvoiceRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreInvoiceRequest $request)
	{

		// Create future Invoice Manually by user+admin
		$this->authorize('create', Invoice::class);

		//Log::debug('Period =' . $request->period);
		$period 		= $request->period;
		$account_id 	= auth()->user()->account_id;

		if ( $account_id == '') {
			return redirect()->route('invoices.index')->with('error', 'Sorry, you can not generate Invoice as no valid Account Found!');
		}

		$account = Account::where('id', auth()->user()->account_id)->first();
		if ($account->next_bill_generated) {
			Log::debug('Unpaid invoice exists for Account id=' . $account->id . ' Invoice not created.');
			return redirect()->route('invoices.index')->with('error', 'Unpaid invoice exists for Account id=' . $account->id . '! Can not create more Invoices.');
		}

		Log::channel('bo')->info('Generating Invoice for Account id=' . $account_id);
		Log::debug('Generating Invoice for Account id=' . $account_id);
		// Create invoice
		$invoice_id = self::createSubscriptionInvoice($account_id, $period);
		
		// try {
		//     $account = Account::where('id', $account_id)->firstOrFail();
		// } catch (ModelNotFoundException $exception) {
		//     return redirect()->route('invoices.index')->with('error', 'Account#' . $account_id . ' not found!');
		// }

		if ($invoice_id <> 0) {
			return redirect()->route('invoices.index')->with('success', 'Invoice#' . $invoice_id . ' created successfully.');
		} else {
			return redirect()->route('invoices.index')->with('error', 'Invoice creation Failed!');
		}
	}


	public function createSubscriptionInvoice($account_id, $period)
	{
		
		$setup = Setup::first();
		Log::debug('Generating Invoice for account_id= ' . $account_id .'for period='. $period);
		$account = Account::where('id', $account_id)->first();

		// Don't create invoice if unpaid invoice exists
		if ($account->next_bill_generated) {
			Log::debug('Unpaid invoice exists for Account id=' . $account_id . ' Invoice not created.');
			return 0;
		}


		// create new Invoice
		// logic: create invoice from the next date, after current billed date
		$invoice				= new Invoice();
		// get unique invoice_no
		$invoice->invoice_no	= Bo::getInvoiceNo();
		$invoice->invoice_date	= now();
		//Log::channel('bo')->info('Account id='. $account_id.' last_bill_from_date '.$account->last_bill_from_date);
		$invoice->invoice_type	= LandlordInvoiceTypeEnum::SUBSCRIPTION->value;
		$invoice->from_date		= $account->end_date->addDay(1);
		$invoice->to_date		= $account->end_date->addDay(1)->addMonth($period);
		//Log::channel('bo')->info('Account id='. $account_id.' SECOND inv start '.$invoice->from_date.' to date '.$invoice->to_date);
		Log::channel('bo')->info('Account id=' . $account_id . ' SECOND inv start ' . $invoice->from_date . ' to date ' . $invoice->to_date . ' period= ' . $period);

		$invoice->due_date		= $account->end_date;
		$invoice->summary		= 'Invoice for ' . $account->name . ' for site' . $account->site;

		switch ($period) {
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

		Log::debug('discount_pc= ' . $discount_pc);
		$invoice->price		= round($period * $account->price * (100 - $discount_pc)/100,2) ;
		$invoice->subtotal	= $invoice->price;
		$invoice->amount	= $invoice->price;
		$invoice->account_id= $account->id;
		$invoice->owner_id	= $account->owner_id;

		// create invoice
		$invoice->currency		= 'USD';
		$invoice->status_code	= LandlordInvoiceStatusEnum::DUE->value;
		$invoice->save();

		Log::debug('Invoice Generated id=' . $invoice->id);
		LandlordEventLog::event('invoice', $invoice->id, 'create');

		// update account billing info
		//$account->last_bill_from_date	= $invoice->from_date;
		//$account->last_bill_to_date	= $invoice->to_date;
		$account->next_bill_generated	= true;
		$account->next_invoice_no		= $invoice->invoice_no;
		$account->last_bill_date		= now();

		$account->save();
		Log::debug('Account Updated id=' . $account->id);

		// identify user to notify
		$user = User::where('id', $account->owner_id)->first();

		// Invoice Created Notification
		$user->notify(new InvoiceCreated($user, $invoice));

		//Log::debug('Account Created id='. $account->id);
		//return redirect()->route('processes.index')->with('success','Invoice Generation Process completed successfully.');
		return $invoice->id;

		//return view('landlord.invoices.show', compact('invoice', 'entity'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function show(Invoice $invoice)
	{
		$this->authorize('view', $invoice);

		$entity = static::ENTITY;
		return view('landlord.admin.invoices.show', compact('invoice', 'entity'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Invoice $invoice)
	{
		$this->authorize('update', $invoice);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateInvoiceRequest $request, Invoice $invoice)
	{
		$this->authorize('update', $invoice);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Invoice $invoice)
	{
		//
	}


}
