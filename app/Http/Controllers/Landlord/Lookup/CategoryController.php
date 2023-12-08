<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			CategoryController.php
* @brief		This file contains the implementation of the CategoryController
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

use App\Models\Landlord\Lookup\Category;
use App\Http\Requests\Landlord\Lookup\StoreCategoryRequest;
use App\Http\Requests\Landlord\Lookup\UpdateCategoryRequest;

use App\Helpers\LandlordEventLog;


class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		 //$this->authorize('viewAny', Category::class);

		 $categories = Category::query();
		 if (request('term')) {
			 $categories->where('name', 'Like', '%'.request('term').'%');
		 }
		 $categories = $categories->orderBy('name', 'ASC')->paginate(40);
 
		 return view('landlord.lookup.categories.index', compact('categories'))->with('i', (request()->input('page', 1) - 1) * 40);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//$this->authorize('create', Category::class);

		return view('landlord.lookup.categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCategoryRequest $request)
	{
	   // $this->authorize('create', Category::class);
		$category = Category::create($request->all());
		// Write to Log
		LandlordEventLog::event('category', $category->id, 'create');

		return redirect()->route('categories.index')->with('success', 'Category created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Category $category)
	{
		//$this->authorize('view', $category);
		return view('landlord.lookup.categories.show', compact('category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Category $category)
	{
		//$this->authorize('update', $category);

		return view('landlord.lookup.categories.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCategoryRequest $request, Category $category)
	{
		//$this->authorize('update', $category);

		//$request->validate();
		$request->validate([
		]);
		$category->update($request->all());

		// Write to Log
		LandlordEventLog::event('category', $category->id, 'update', 'name', $request->name);

		return redirect()->route('categories.index')->with('success', 'Category updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Category $category)
	{
		//$this->authorize('delete', $user);  

		$category->fill(['enable'=>!$category->enable]);
		$category->update();

		// Write to Log
		LandlordEventLog::event('category',$category->id,'status','enable',$category->enable);

		return redirect()->route('categories.index')->with('success','Category Status Updated successfully');
	}
}
