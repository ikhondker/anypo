<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			CheckoutController.php
* @brief		This file contains the implementation of the CheckoutController
* @path			\app\Http\Controllers\Landlord\Manage
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
namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Manage\StoreCheckoutRequest;
use App\Http\Requests\Landlord\Manage\UpdateCheckoutRequest;

// Models
use App\Models\Landlord\Manage\Checkout;
// Enums
// Helpers
// Seeded

class CheckoutController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY   = 'CHECKOUT';

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		abort(403);
	}

	/**
	 * Display a listing of the resource.
	 */
	public function all()
	{
		$this->authorize('viewAll',Checkout::class);
		$checkouts = Checkout::orderBy('id', 'DESC')->paginate(10);
		return view('landlord.manage.checkouts.all', compact('checkouts'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCheckoutRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Checkout $checkout)
	{
		$this->authorize('view', $checkout);
		$entity = static::ENTITY;
		return view('landlord.manage.checkouts.show', compact('checkout', 'entity'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Checkout $checkout)
	{
		$this->authorize('update', $checkout);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCheckoutRequest $request, Checkout $checkout)
	{
		$this->authorize('update', $checkout);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Checkout $checkout)
	{
		//
	}
}
