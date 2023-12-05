<?php

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;




// 1. Enums
// 2. Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
// 3. Notifications
// 4. Mails
// 5. Packages
// 6. Requests
use App\Http\Requests\Tenant\Lookup\StoreDeptRequest;
use App\Http\Requests\Tenant\Lookup\UpdateDeptRequest;
// 7. Exceptions
// 8. Events
// 9. Models
use App\Models\Tenant\Lookup\Dept;
use App\Models\Hierarchy;
// 10. Seeded
use DB;

class DeptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$this->authorize('viewAny',Dept::class);

        //liveware
        //return view('depts.index');

        $depts = Dept::query();
        if (request('term')) {
            $depts->where('name', 'Like', '%' . request('term') . '%');
        }
        $depts = $depts->orderBy('id', 'DESC')->paginate(10);
        return view('tenant.lookup.depts.index', compact('depts'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Dept::class);

        return view('tenant.lookup.depts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeptRequest $request)
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
    public function show(Dept $dept)
    {
        $this->authorize('view', $dept);

        return view('tenant.lookup.depts.show', compact('dept'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dept $dept)
    {
        $this->authorize('update', $dept);

        $hierarchies = Hierarchy::getAll();


        return view('tenant.lookup.depts.edit', compact('dept', 'hierarchies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeptRequest $request, Dept $dept)
    {
        $this->authorize('update', $dept);

        //$request->validate();
        $request->validate([
        ]);
        $dept->update($request->all());

        // Write to Log
        EventLog::event('dept', $dept->id, 'update', 'name', $request->name);

        return redirect()->route('depts.index')->with('success', 'Dept information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dept $dept)
    {
        $this->authorize('delete', $dept);

        $dept->fill(['enable' => ! $dept->enable]);
        $dept->update();
        // Write to Log
        EventLog::event('dept', $dept->id, 'status', 'enable', $dept->enable);

        return redirect()->route('depts.index')->with('success', 'Dept status changed successfully');
    }

    public function export()
    {
        $data = DB::select("
            SELECT d.id, d.name,  IF(d.enable, 'Yes', 'No') enable, hpr.name pr_hierarchy_name, hpo.name po_hierarchy_name
            FROM depts d, hierarchies hpr, hierarchies hpo
            WHERE d.pr_hierarchy_id=hpr.id
            AND d.po_hierarchy_id=hpo.id
            ");
        $dataArray = json_decode(json_encode($data), true);
        // used Export Helper
        return Export::csv('depts', $dataArray);
    }
}
