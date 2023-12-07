<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        PaymentController.php
 * @brief       This file contains the implementation of the PaymentController class.
 * @author      Iqbal H. Khondker
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
 */

 namespace App\Http\Controllers\Landlord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Admin\StorePaymentRequest;
use App\Http\Requests\Landlord\Admin\UpdatePaymentRequest;

// Models
use App\Models\Landlord\Admin\Payment;

// Enums
use App\Enum\UserRoleEnum;

// Helpers
use App\Helpers\FileUpload;
use App\Helpers\LandlordEventLog;

// Seeded
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY        = 'PAYMENT';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//$payments = Payment::latest()->orderBy('id','desc')->paginate(10);
		$payments = Payment::byAccount()->orderBy('id', 'desc')->paginate(10);
		return view('landlord.admin.payments.index', compact('payments'))->with('i', (request()->input('page', 1) - 1) * 10);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{

		$this->authorize('viewAll',Payment::class);
		//$payments = Payment::latest()->orderBy('id','desc')->paginate(10);
		$payments = Payment::orderBy('id', 'desc')->paginate(10);
		return view('landlord.admin.payments.all', compact('payments'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// $this->authorize('create',Payment::class);
		// $bank_accounts = BankAccount::getAll();
		// $organizations = Organization::getAll();
		// return view('landlord.payments.create',compact('bank_accounts','organizations'));
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

		//$request->validate();
		//$request->validate([]);
		$payment->update($request->all());

		LandlordEventLog::event('payment', $payment->id, 'update', 'name', $payment->name);
		LandlordEventLog::event('payment', $payment->id, 'update', 'limit', $payment->limit);
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

	
}
