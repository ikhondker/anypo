<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;

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



class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $designations = Designation::query();
        if (request('term')) {
            $designations->where('name', 'Like', '%' . request('term') . '%');
        }
        $designations = $designations->orderBy('id', 'DESC')->paginate(10);
        return view('designations.index', compact('designations'))->with('i', (request()->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Designation::class);

        return view('designations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignationRequest $request)
    {
        $this->authorize('create', Designation::class);

        $designation = Designation::create($request->all());
        // Write to Log
        EventLog::event('designation', $designation->id, 'create');

        return redirect()->route('designations.index')->with('success', 'Designation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        return view('designations.show', compact('designation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        $this->authorize('update', $designation);

        return view('designations.edit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $this->authorize('update', $designation);

        //$request->validate();
        $request->validate([

        ]);
        $designation->update($request->all());

        // Write to Log
        EventLog::event('designation', $designation->id, 'update', 'name', $designation->name);
        return redirect()->route('designations.index')->with('success', 'Designation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        $this->authorize('delete', $designation);

        $designation->fill(['enable' => !$designation->enable]);
        $designation->update();

        // Write to Log
        EventLog::event('designation', $designation->id, 'status', 'enable', $designation->enable);

        return redirect()->route('designations.index')->with('success', 'Designation status Updated successfully');
    }

    public function export()
    {
        $data = DB::select("SELECT id, name, IF(enable, 'Yes', 'No') as enable
        FROM designations");
        $dataArray = json_decode(json_encode($data), true);
        // used Export Helper
        return Export::csv('designations', $dataArray);

    }
}
