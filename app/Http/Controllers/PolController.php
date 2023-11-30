<?php

namespace App\Http\Controllers;

use App\Models\Pol;
use App\Http\Requests\StorePolRequest;
use App\Http\Requests\UpdatePolRequest;

# Models
# Enums
use App\Enum\EntityEnum;
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

class PolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePolRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pol $pol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pol $pol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePolRequest $request, Pol $pol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pol $pol)
    {
        //
    }
}
