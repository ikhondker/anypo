<?php

namespace App\Http\Controllers;

use App\Models\Po;
use App\Http\Requests\StorePoRequest;
use App\Http\Requests\UpdatePoRequest;

# Models
# Enums
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
# Notifications
# Mails
# Packages
# Seeded
use DB;

# Exceptions
# Events


class PoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depts = Dept::query();
        if (request('term')) {
            $depts->where('name', 'Like', '%' . request('term') . '%');
        }
        $depts = $depts->orderBy('id', 'DESC')->paginate(10);
        return view('tenant.pos.index', compact('depts'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Dept::class);
        return view('tenant.pos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePoRequest $request)
    {
        $this->authorize('create', Dept::class);
        $dept = Dept::create($request->all());
        // Write to Log
        EventLog::event('dept', $dept->id, 'create');

        return redirect()->route('depts.index')->with('success', 'Dept created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Po $po)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Po $po)
    {
        $this->authorize('update', $dept);
        return view('tenant.pos.edit', compact('dept'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePoRequest $request, Po $po)
    {
        $this->authorize('update', $dept);

        //$request->validate();
        $request->validate([

        ]);
        $dept->update($request->all());

        // Write to Log
        EventLog::event('dept', $dept->id, 'update', 'name', $dept->name);
        return redirect()->route('depts.index')->with('success', 'Dept updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Po $po)
    {
        $this->authorize('delete', $dept);

        $dept->fill(['enable' => !$dept->enable]);
        $dept->update();

        // Write to Log
        EventLog::event('dept', $dept->id, 'status', 'enable', $dept->enable);

        return redirect()->route('depts.index')->with('success', 'Dept status Updated successfully');
    }

    public function export()
    {
        $data = DB::select("SELECT id, name, email, cell, role, enable 
            FROM users");
        $dataArray = json_decode(json_encode($data), true);
        // used Export Helper
        return Export::csv('users', $dataArray);
    }
}
