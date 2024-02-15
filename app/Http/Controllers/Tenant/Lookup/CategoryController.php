<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\Category;
use App\Http\Requests\Tenant\Lookup\StoreCategoryRequest;
use App\Http\Requests\Tenant\Lookup\UpdateCategoryRequest;

# Models
# Enums
# Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# Notifications
# Mails
# Packages
# Seeded
use DB;

# Exceptions
# Events

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
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
		return view('tenant.lookup.categories.show', compact('category'));
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
		//$this->authorize('update', $category);

		//dd($category);
		$category->update($request->all());

		// Write to Log
		EventLog::event('category', $category->id, 'update', 'name', $category->name);

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
		$data = DB::select("SELECT id, name, IF(enable, 'Yes', 'No') as Enable
			FROM categories");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper

		return Export::csv('categories', $dataArray);
	}
}
