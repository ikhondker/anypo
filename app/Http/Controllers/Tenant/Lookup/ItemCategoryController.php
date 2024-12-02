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

use App\Models\Tenant\Lookup\ItemCategory;
use App\Http\Requests\Tenant\Lookup\StoreItemCategoryRequest;
use App\Http\Requests\Tenant\Lookup\UpdateItemCategoryRequest;

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
use DB;
# 12. FUTURE

class ItemCategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',ItemCategory::class);

		$itemCategories = ItemCategory::query();
		if (request('term')) {
			$itemCategories->where('name', 'Like', '%'.request('term').'%');
		}
		$itemCategories = $itemCategories->orderBy('id', 'DESC')->paginate(10);

		return view('tenant.lookup.item-categories.index', compact('itemCategories'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', ItemCategory::class);

		return view('tenant.lookup.item-categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreItemCategoryRequest $request)
	{
		$this->authorize('create', ItemCategory::class);

		$itemCategory = ItemCategory::create($request->all());
		// Write to Log
		EventLog::event('item_category', $itemCategory->id, 'create');

		return redirect()->route('item-categories.index')->with('success', 'ItemCategory created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(ItemCategory $itemCategory)
	{
        $this->authorize('view', $itemCategory);
		return view('tenant.lookup.item-categories.show', compact('itemCategory'));
	}


    /**
	 * Display the specified resource.
	 */
	public function timestamp(ItemCategory $itemCategory)
	{
		$this->authorize('view', $itemCategory);

		return view('tenant.lookup.item-categories.timestamp', compact('itemCategory'));
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(ItemCategory $itemCategory)
	{
		$this->authorize('update', $itemCategory);

		return view('tenant.lookup.item-categories.edit', compact('itemCategory'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateItemCategoryRequest $request, ItemCategory $itemCategory)
	{
		$this->authorize('update', $itemCategory);

		// Write to Log
		EventLog::event('category', $itemCategory->id, 'update', 'name', $itemCategory->name);
		$itemCategory->update($request->all());

		return redirect()->route('item-categories.index')->with('success', 'ItemCategory updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(ItemCategory $itemCategory)
	{
		$this->authorize('delete', $itemCategory);

		$itemCategory->fill(['enable' => ! $itemCategory->enable]);
		$itemCategory->update();

		// Write to Log
		EventLog::event('item-category', $itemCategory->id, 'status', 'enable', $itemCategory->enable);

		return redirect()->route('item-categories.index')->with('success', 'ItemCategory status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', ItemCategory::class);

		$data = DB::select("SELECT id, name, IF(enable, 'Yes', 'No') as Enable
			FROM categories");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper

		return Export::csv('categories', $dataArray);
	}
}
