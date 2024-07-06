<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			OemController.php
* @brief		This file contains the implementation of the OemController
* @path			\App\Http\Controllers\Tenant\Lookup
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

namespace App\Http\Controllers\Tenant\Lookup;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Lookup\Oem;
use App\Http\Requests\Tenant\Lookup\StoreOemRequest;
use App\Http\Requests\Tenant\Lookup\UpdateOemRequest;

# 1. Models
# 2. Enums
# 3. Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Seeded
use DB;
# 12. FUTURE


class OemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Oem::class);

		$oems = Oem::query();
		if (request('term')) {
			$oems->where('name', 'Like', '%' . request('term') . '%');
		}
		$oems = $oems->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.oems.index', compact('oems'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Oem::class);
		return view('tenant.lookup.oems.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreOemRequest $request)
	{
		$this->authorize('create', Oem::class);

		$oem = Oem::create($request->all());
		// Write to Log
		EventLog::event('oem', $oem->id, 'create');

		return redirect()->route('oems.index')->with('success', 'Oem created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Oem $oem)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Oem $oem)
	{
		$this->authorize('update', $oem);
		return view('tenant.lookup.oems.edit', compact('oem'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateOemRequest $request, Oem $oem)
	{
		$this->authorize('update', $oem);

		//$request->validate();
		$request->validate([

		]);
		$oem->update($request->all());

		// Write to Log
		EventLog::event('oem', $oem->id, 'update', 'name', $oem->name);
		return redirect()->route('oems.index')->with('success', 'Oem updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Oem $oem)
	{
		$this->authorize('delete', $oem);

		$oem->fill(['enable' => !$oem->enable]);
		$oem->update();

		// Write to Log
		EventLog::event('oem', $oem->id, 'status', 'enable', $oem->enable);

		return redirect()->route('oems.index')->with('success', 'Oem status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Oem::class);
		$data = DB::select("SELECT id, name, IF(enable, 'Yes', 'No') as Enable
			FROM oems");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('oems', $dataArray);
	}
}
