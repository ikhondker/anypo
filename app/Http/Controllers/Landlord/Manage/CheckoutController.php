<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			CheckoutController.php
* @brief		This file contains the implementation of the CheckoutController
* @path			\app\Http\Controllers\Landlord\Manage
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

namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Manage\StoreCheckoutRequest;
use App\Http\Requests\Landlord\Manage\UpdateCheckoutRequest;

# 1. Models
use App\Models\Landlord\Manage\Checkout;
# 2. Enums
# 3. Helpers
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
# 13. FUTURE 

class CheckoutController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY	= 'CHECKOUT';

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
		$checkouts = Checkout::with('product')->with('status')->orderBy('id', 'DESC')->paginate(10);
		return view('landlord.manage.checkouts.all', compact('checkouts'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCheckoutRequest $request)
	{
		abort(403);
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
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCheckoutRequest $request, Checkout $checkout)
	{
		$this->authorize('update', $checkout);
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Checkout $checkout)
	{
		abort(403);
	}
}
