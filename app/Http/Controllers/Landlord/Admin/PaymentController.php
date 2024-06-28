<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			PaymentController.php
* @brief		This file contains the implementation of the PaymentController
* @path			\app\Http\Controllers\Landlord\Admin
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

 namespace App\Http\Controllers\Landlord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Admin\StorePaymentRequest;
use App\Http\Requests\Landlord\Admin\UpdatePaymentRequest;

# 1. Models
use App\Models\Landlord\Account;
use App\Models\Landlord\Admin\Payment;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Manage\Config;

# 2. Enums
use App\Enum\UserRoleEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\FileUpload;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
# 13. FUTURE



class PaymentController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY	= 'PAYMENT';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$payments = Payment::with('invoice')->with('account')->with('status')->byAccount()->orderBy('id', 'desc')->paginate(10);
		return view('landlord.admin.payments.index', compact('payments'));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{
		$this->authorize('viewAll',Payment::class);
		$payments = Payment::with('invoice')->with('account')->with('status')->orderBy('id', 'desc')->paginate(10);
		return view('landlord.admin.payments.all', compact('payments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// Created from home.paymentStripe
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StorePaymentRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StorePaymentRequest $request)
	{
		$this->authorize('create',Payment::class);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Payment  $payment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Payment $payment)
	{
		$this->authorize('view', $payment);

		$config 	= Config::with('relCountry')->where('id', config('bo.CONFIG_ID'))->first();
		$invoice 	= Invoice::where('id', $payment->invoice_id)->first();
		$account 	= Account::with('relCountry')->where('id', $invoice->account_id)->first();

		$entity = static::ENTITY;
		return view('landlord.admin.payments.show', compact('payment', 'entity','config','invoice','account'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Payment  $payment
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Payment $payment)
	{
		$this->authorize('update', $payment);
        return view('landlord.admin.payments.edit', compact('payment'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdatePaymentRequest  $request
	 * @param  \App\Models\Payment  $payment
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdatePaymentRequest $request, Payment $payment)
	{
		$this->authorize('update', $payment);

		$request->validate([]);
		$payment->update($request->all());

		return redirect()->route('payments.index')->with('success', 'Payment updated successfully');


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Payment  $payment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Payment $payment)
	{
		//
	}
    public function export()
	{
		$this->authorize('export', Payment::class);

		if (auth()->user()->isSeeded()){
			$data = DB::select("
                SELECT p.id, p.summary, p.pay_date, i.invoice_no, a.name account_name, p.amount, p.currency
                FROM payments p, invoices i, accounts a
                WHERE p.invoice_id = i.id
                AND p.account_id = a.id
                ");
		} else if (auth()->user()->isAdmin()){
			$data = DB::select("
				SELECT p.id, p.summary, p.pay_date, i.invoice_no, a.name account_name, p.amount, p.currency
                FROM payments p, invoices i, accounts a
                WHERE p.invoice_id = i.id
                AND p.account_id = a.id
				AND p.account_id = ".auth()->user()->account_id
				);
		} else {
			$data = DB::select("
				SELECT p.id, p.summary, p.pay_date, i.invoice_no, a.name account_name, p.amount, p.currency
                FROM payments p, invoices i, accounts a
                WHERE p.invoice_id = i.id
                AND p.account_id = a.id
				AND p.owner_id = ".auth()->user()->id
				);
		}

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('payments', $dataArray);
    }

}
