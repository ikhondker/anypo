<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			SetupController.php
* @brief		This file contains the implementation of the SetupController
* @path			\app\Http\Controllers\Landlord\Manage
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/
namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Manage\StoreSetupRequest;
use App\Http\Requests\Landlord\Manage\UpdateSetupRequest;

// Models
use App\Models\Landlord\Manage\Setup;

// Enums
// Helpers
use App\Helpers\LandlordEventLog;

// Notification
// Mail
// Seeded


// --- template
// Models
// Enums
// Helpers
// Notification
// Mail
// Exception
// Event
// Seeded


class SetupController extends Controller
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

        $setups = Setup::latest()->orderBy('id', 'desc')->paginate(10);
        return view('landlord.manage.setups.index', compact('setups'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSetupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSetupRequest $request)
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function show(Setup $setup)
    {
        $this->authorize('view', $setup);
        return view('landlord.manage.setups.show', compact('setup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function edit(Setup $setup)
    {
        //$this->authorize('update', $setup);
        return view('landlord.manage.setups.edit', compact('setup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSetupRequest  $request
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSetupRequest $request, Setup $setup)
    {
        //$this->authorize('update', $setup);

        //$request->validate();


        // check box
        if ($request->has('maintenance')) {
            //Checkbox checked
            $request->merge(['maintenance' =>  1]);
        } else {
            //Checkbox not checked
            $request->merge(['maintenance' =>  0]);
        }

        if ($request->has('show_banner')) {
            //Checkbox checked
            $request->merge(['show_banner' =>  1]);
        } else {
            //Checkbox not checked
            $request->merge(['show_banner' =>  0]);
        }

        $request->validate([]);
        $setup->update($request->all());

        // Write to Log
        LandlordEventLog::event('setup', $setup->id, 'update', 'name', $request->name);

        return redirect()->route('setups.index')->with('success', 'Setup updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setup $setup)
    {
        $setup->fill(['show_message' => !$setup->show_message]);
        $setup->update();

        // Write to Log
        LandlordEventLog::event('setup', $setup->id, 'status', 'show_message', $setup->show_message);
        return redirect()->route('setups.index')->with('success', 'Message Status Updated successfully');
    }
}
