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
use App\Models\Landlord\Admin\Payment;
# 2. Enums
use App\Enum\UserRoleEnum;
# 3. Helpers
use App\Helpers\FileUpload;
use App\Helpers\LandlordEventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
# 13. TODO 



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
		$entity = static::ENTITY;
		return view('landlord.admin.payments.show', compact('payment', 'entity'));
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
		// TODO only for backend
		abort(403);
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
		abort(403);
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

	
}
