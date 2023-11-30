<?php

/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        EntityController.php
 * @brief       This file contains the implementation of the EntityController class.
 * @author      Iqbal H. Khondker
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
 */

namespace App\Http\Controllers\Landlord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Admin\StoreEntityRequest;
use App\Http\Requests\Landlord\Admin\UpdateEntityRequest;

// Models
use App\Models\Landlord\Admin\Entity;
// Enums
// Helpers
// Seeded
use App\Helpers\LandlordEventLog;
use DB;

class EntityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Entity::latest()->orderBy('entity', 'asc')->paginate(20);
        return view('landlord.admin.entities.index', compact('entities'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Entity::class);

        return view('landlord.admin.entities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEntityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntityRequest $request)
    {
        $this->authorize('create', Entity::class);
        $Entity = Entity::create($request->all());
        // Write to Log
        LandlordEventLog::event('entity', $Entity->id, 'create');

        return redirect()->route('entities.index')->with('success', 'Entity created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function show(Entity $entity)
    {
        return view('landlord.admin.entities.show', compact('entity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function edit(Entity $entity)
    {
        //$this->authorize('update',$entity);

        // Write Event Log
        //LandlordEventLog::event('template',$template->id,'edit','template',$template->id);
        return view('landlord.admin.entities.edit', compact('entity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEntityRequest  $request
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntityRequest $request, Entity $entity)
    {
        //$this->authorize('update',$entity);

        //$request->validate();
        $request->validate([]);
        $entity->update($request->all());

        LandlordEventLog::event('entity', $entity->entity, 'update', 'name', $entity->name);
        LandlordEventLog::event('entity', $entity->entity, 'update', 'limit', $entity->limit);
        return redirect()->route('entities.index')->with('success', 'Entity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity)
    {
        //$this->authorize('delete',$entity);

        $entity->fill(['enable' => !$entity->enable]);
        $entity->update();

        // Write to Log
        LandlordEventLog::event('entity', $entity->entity, 'status', 'enable', $entity->enable);
        return redirect()->route('entities.index')->with('success', 'Entity Status Updated successfully');
    }

    public function export()
    {
        $data = DB::select("SELECT
            entity, name, code, subdir, module, slug, enable, created_by, created_at, updated_by, updated_at
            FROM entities");
        $dataArray = json_decode(json_encode($data), true);
        // used Export Helper
        return exportCSV('entities', $dataArray);
    }
}
