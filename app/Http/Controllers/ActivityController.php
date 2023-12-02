<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;

# Models
# Enums
# Helpers
use App\Helpers\Export;
# Notifications
# Mails
# Packages
# Seeded
use DB;

# Exceptions
# Events


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny', Activity::class);

        $activities = Activity::query();
        if (request('term')) {
            $activities->where('object_name', 'Like', '%' . request('term') . '%');
        }
        $activities = $activities->orderBy('id', 'DESC')->paginate(50);
        return view('tenant.admin.activities.index', compact('activities'))->with('i', (request()->input('page', 1) - 1) * 50);
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
    public function store(StoreActivityRequest $request)
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        $this->authorize('view', $activity);

        return view('tenant.admin.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        abort(403);
    }

    /**
     * Export selected column to csv format
     */
    public function export()
    {
        $this->authorize('export', Activity::class);
        //$data = Uom::all()->toArray();
        $data = DB::select('SELECT a.id, a.object_name, a.object_id, a.event_name, a.column_name, a.prior_value, u.name,a.role, a.created_at
            FROM activities a, users u
            WHERE a.user_id = u.id
            ');

        $dataArray = json_decode(json_encode($data), true);

        // export to CSV
        return Export::csv('activities', $dataArray);
    }
}
