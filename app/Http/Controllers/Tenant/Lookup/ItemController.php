<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Http\Requests\Tenant\Lookup\StoreItemRequest;
use App\Http\Requests\Tenant\Lookup\UpdateItemRequest;

# Models
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Category;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Lookup\Oem;
use App\Models\Tenant\Lookup\GlType;

use App\Models\Tenant\Manage\UomClass;

# Enums
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
# Notifications
# Mails
# Packages
# Seeded
use DB;
use Str;

# Exceptions
# Events
# TODO
# 1. dependent dropdown for uom

class ItemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$items = Item::query();
		if (request('term')) {
			$items->where('name', 'Like', '%' . request('term') . '%');
		}
		$items = $items->with('category')->with('uom')->with('oem')->with('glType')->orderBy('id', 'DESC')->paginate(25);
		return view('tenant.lookup.items.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Item::class);

		$categories = Category::primary()->get();

		$uomClasses = UomClass::All();

		$uoms = Uom::primary()->get();

		$oems = Oem::primary()->get();

		$gl_types = GlType::primary()->get();

		return view('tenant.lookup.items.create', compact('categories','uomClasses','uoms', 'oems', 'gl_types'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreItemRequest $request)
	{
		$this->authorize('create', Item::class);

		// get uom to find uom_class_id
		$uom = Uom::where('id', $request->input('uom_id') )->first();

		$request->merge([
			'code' => Str::upper($request['code']),
			'uom_class_id' => $uom->uom_class_id,
		]);



		$item = Item::create($request->all());
		// Write to Log
		EventLog::event('item', $item->id, 'create');

		return redirect()->route('items.index')->with('success', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Item $item)
	{
		$this->authorize('view', $item);

		return view('tenant.lookup.items.show', compact('item'));

	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Item $item)
	{
		$this->authorize('update', $item);

		$categories = Category::primary()->get();
		$uoms = Uom::byUomClass($item->uom_class_id)->get();
		$oems = Oem::primary()->get();
		$gl_types = GlType::primary()->get();

		return view('tenant.lookup.items.edit', compact('item', 'categories', 'uoms', 'oems', 'gl_types'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateItemRequest $request, Item $item)
	{
		$this->authorize('update', $item);

		$request->merge([
			'code' => Str::upper($request['code']),
		]);

		//$request->validate();
		$request->validate([

		]);
		$item->update($request->all());

		// Write to Log
		EventLog::event('item', $item->id, 'update', 'name', $item->name);
		return redirect()->route('items.index')->with('success', 'Item updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Item $item)
	{
		$this->authorize('delete', $item);

		$item->fill(['enable' => !$item->enable]);
		$item->update();

		// Write to Log
		EventLog::event('item', $item->id, 'status', 'enable', $item->enable);

		return redirect()->route('items.index')->with('success', 'Item status Updated successfully');
	}

	public function export()
	{
		$data = DB::select("
			SELECT i.id, i.name, i.notes, c.name category_name, o.name oem_name, u.name uom_name, i.price, i.stock, i.gl_type,
			IF(i.enable, 'Yes', 'No') as Enable 
			FROM items i, categories c, oems o, uoms u
			WHERE i.category_id = c.id
			AND i.oem_id=o.id
			AND i.uom_id=u.id ");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}
}
