<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			CategoryController.php
* @brief		This file contains the implementation of the CategoryController
* @path			\App\Http\Controllers\Tenant\Lookup
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

namespace App\Http\Controllers\Tenant\Lookup;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Lookup\Category;
use App\Http\Requests\Tenant\Lookup\StoreCategoryRequest;
use App\Http\Requests\Tenant\Lookup\UpdateCategoryRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Seeded
use Illuminate\Support\Arr;
use DB;
# 12. FUTURE

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Category::class);

		$categories = Category::query();
		if (request('term')) {
			$categories->where('name', 'Like', '%'.request('term').'%');
		}
		$categories = $categories->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.lookup.categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Category::class);

		return view('tenant.lookup.categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCategoryRequest $request)
	{
		$this->authorize('create', Category::class);

		// set random color for budget
		$colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
		$request->merge(['bg_color' => Arr::random($colors) ]);


		$category = Category::create($request->all());
		// Write to Log
		EventLog::event('category', $category->id, 'create');

		return redirect()->route('categories.index')->with('success', 'Category created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Category $category)
	{
		$this->authorize('view', $category);
		return view('tenant.lookup.categories.show', compact('category'));
	}

	 /**
	 * Display the specified resource.
	 */
	public function timestamp(Category $category)
	{
		$this->authorize('view', $category);

		return view('tenant.lookup.categories.timestamp', compact('category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Category $category)
	{
		$this->authorize('update', $category);

		return view('tenant.lookup.categories.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCategoryRequest $request, Category $category)
	{
		$this->authorize('update', $category);

		// Write to Log
		EventLog::event('category', $category->id, 'update', 'name', $category->name);
		$category->update($request->all());

		return redirect()->route('categories.index')->with('success', 'Category updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Category $category)
	{
		$this->authorize('delete', $category);

		$category->fill(['enable' => ! $category->enable]);
		$category->update();

		// Write to Log
		EventLog::event('category', $category->id, 'status', 'enable', $category->enable);

		return redirect()->route('categories.index')->with('success', 'Category status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Category::class);

		$data = DB::select("SELECT id, name, IF(enable, 'Yes', 'No') as Enable
			FROM categories");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper

		return Export::csv('categories', $dataArray);
	}
}
