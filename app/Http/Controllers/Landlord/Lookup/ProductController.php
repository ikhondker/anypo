<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			ProductController.php
* @brief		This file contains the implementation of the ProductController
* @path			\app\Http\Controllers\Landlord\Lookup
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

namespace App\Http\Controllers\Landlord\Lookup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Lookup\StoreProductRequest;
use App\Http\Requests\Landlord\Lookup\UpdateProductRequest;

// Models
use App\Models\User;
use App\Models\Landlord\Lookup\Product;

// Enums
// Helpers
use App\Helpers\LandlordEventLog;

// Seeded
use Illuminate\Support\Facades\Log;

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
		return view('landlord.lookup.products.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 10);
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
	public function store(StoreProductRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Product $product)
	{
		//$this->authorize('view', $product);

		$entity = static::ENTITY;
		//$purAddons = Addon::getAddons($service->id);
		//$avlAddons = Product::getAddons($service->product_id);
		//return view('landlord.manage.products.show',compact('service','entity','avlAddons','purAddons','avlAddons'));
		return view('landlord.lookup.products.show', compact('product', 'entity'));
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

		//$request->validate();
		$request->validate([]);
		$product->update($request->all());

		// if ( $request->input('owner_id') <> $service->owner_id ) {
		//		LandlordEventLog::event('service',$service->id,'update','owner_id',$service->owner_id);
		// }

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
