<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Http\Requests\StoreEntityRequest;
use App\Http\Requests\UpdateEntityRequest;


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
use Illuminate\Support\Facades\Log;

# Exceptions
# Events


class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Entity::class);

        $entities = Entity::latest()->orderBy('entity', 'asc')->paginate(20);
        return view('entities.index', compact('entities'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntityRequest $request)
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entity $entity)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entity $entity)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntityRequest $request, Entity $entity)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entity $entity)
    {
        //$this->authorize('delete', $color);
        $entity->fill(['enable' => !$entity->enable]);
        $entity->update();

        // Write to Log
        EventLog::event('entity', $entity->name, 'update', 'enable', $entity->enable);

        return redirect()->route('entities.index')->with('success', 'Entity Status Updated successfully.');
    }
}
