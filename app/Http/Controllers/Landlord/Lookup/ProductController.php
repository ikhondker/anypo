<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ProductController.php
* @brief		This file contains the implementation of the ProductController
* @path			\app\Http\Controllers\Landlord\Lookup
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

namespace App\Http\Controllers\Landlord\Lookup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Lookup\StoreProductRequest;
use App\Http\Requests\Landlord\Lookup\UpdateProductRequest;

# 1. Models
use App\Models\User;
use App\Models\Landlord\Lookup\Product;
# 2. Enums
# 3. Helpers
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
use Illuminate\Support\Facades\Log;
# 13. FUTURE



class ProductController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY	= 'PRODUCT';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}


	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$products = Product::orderBy('id', 'ASC')->paginate(10);
		return view('landlord.lookup.products.index', compact('products'));
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
	public function store(StoreProductRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Product $product)
	{
		$this->authorize('view', $product);
        return view('landlord.lookup.products.show', compact('product'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Product $product)
	{
		$this->authorize('update', $product);
		$owners = User::getOwners($product->account_id);
		return view('landlord.lookup.products.edit', compact('product', 'owners'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateProductRequest $request, Product $product)
	{
		$this->authorize('update', $product);

		$request->validate([]);
		$product->update($request->all());

		return redirect()->route('products.index')->with('success', 'Product updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Product $product)
	{
		//
	}
}
