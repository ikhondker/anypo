<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

# Models
use App\Models\Item;
use App\Models\Category;
use App\Models\Uom;
use App\Models\Oem;
use App\Models\GlType;

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
        $items = $items->orderBy('id', 'DESC')->paginate(25);
        return view('items.index', compact('items'))->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Item::class);

        $categories = Category::primary()->get();
        $uoms = Uom::primary()->get();
        $oems = Oem::primary()->get();
        $gl_types = GlType::primary()->get();

        return view('items.create', compact('categories', 'uoms', 'oems', 'gl_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $this->authorize('create', Item::class);

        $request->merge([
            'code' =>  Str::upper($request['code']),
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

        return view('items.show', compact('item'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $this->authorize('update', $item);

        $categories = Category::primary()->get();
        $uoms = Uom::primary()->get();
        $oems = Oem::primary()->get();
        $gl_types = GlType::primary()->get();

        return view('items.edit', compact('item', 'categories', 'uoms', 'oems', 'gl_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $this->authorize('update', $item);

        $request->merge([
            'code' =>  Str::upper($request['code']),
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
        $data = DB::select("SELECT i.id, i.name, i.notes, c.name category_name, o.name oem_name, u.name uom_name, i.price, i.stock, i.account_type,
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
