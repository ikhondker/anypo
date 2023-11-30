<?php

namespace App\Http\Controllers;

// 1. Enums
// 2. Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
// 3. Notifications
// 4. Mails
// 5. Packages
// 6. Requests
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
// 7. Exceptions
// 8. Events
// 9. Models
use App\Models\Menu;
// 10. Seeded
use DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny', Menu::class);

        $menus = Menu::query();
        if (request('term')) {
            $menus->where('name', 'Like', '%'.request('term').'%');
        }
        $menus = $menus->orderBy('node_name', 'ASC')->paginate(40);

        return view('menus.index', compact('menus'))->with('i', (request()->input('page', 1) - 1) * 40);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Menu::class);

        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $this->authorize('create', Menu::class);
        $menu = Menu::create($request->all());
        // Write to Log
        EventLog::event('menu', $menu->id, 'create');

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
         * Show the form for editing the specified resource.
         */
    public function edit(Menu $menu)
    {
        $this->authorize('update', $menu);

        return view('menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $this->authorize('update', $menu);

        //$request->validate();
        $request->validate([
        ]);
        $menu->update($request->all());

        // Write to Log
        EventLog::event('menu', $menu->id, 'update', 'name', $request->name);

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $this->authorize('delete', $menu);

        $menu->fill(['enable' => ! $menu->enable]);
        $menu->update();
        // Write to Log
        EventLog::event('menu', $menu->id, 'status', 'enable', $menu->enable);

        return redirect()->route('menus.index')->with('success', 'Menu status Updated successfully');
    }
}
