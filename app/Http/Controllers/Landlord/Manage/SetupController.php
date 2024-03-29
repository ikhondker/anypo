<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			SetupController.php
* @brief		This file contains the implementation of the SetupController
* @path			\app\Http\Controllers\Landlord\Manage
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\Manage\StoreSetupRequest;
use App\Http\Requests\Landlord\Manage\UpdateSetupRequest;

# 1. Models
use App\Models\Landlord\Manage\Setup;
# 2. Enums
# 3. Helpers
use App\Helpers\LandlordEventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
# 13. TODO 


class SetupController extends Controller
{
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$setups = Setup::latest()->orderBy('id', 'desc')->paginate(10);
		return view('landlord.manage.setups.index', compact('setups'));
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
		$this->authorize('update', $setup);
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
		$this->authorize('update', $setup);

		// check box
		if ($request->has('maintenance')) {
			//Checkbox checked
			$request->merge(['maintenance' =>  1]);
		} else {
			//Checkbox not checked
			$request->merge(['maintenance' =>  0]);
		}

		if ($request->has('banner')) {
			//Checkbox checked
			$request->merge(['banner' =>  1]);
		} else {
			//Checkbox not checked
			$request->merge(['banner' =>  0]);
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
		abort(403);
	}
}
