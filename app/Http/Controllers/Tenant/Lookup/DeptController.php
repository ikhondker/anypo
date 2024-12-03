<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			DeptController.php
* @brief		This file contains the implementation of the DeptController
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

use App\Models\Tenant\Lookup\Dept;
use App\Http\Requests\Tenant\Lookup\StoreDeptRequest;
use App\Http\Requests\Tenant\Lookup\UpdateDeptRequest;


# 1. Models
use App\Models\Tenant\Workflow\Hierarchy;
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
use Illuminate\Support\Facades\Log;
# 12. FUTURE



class DeptController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Dept::class);

		//liveware
		//return view('depts.index');

		$depts = Dept::query();
		if (request('term')) {
			$depts->where('name', 'Like', '%' . request('term') . '%');
		}
		$depts = $depts->with("prHierarchy")->with("poHierarchy")->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.lookup.depts.index', compact('depts'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Dept::class);

		$hierarchies = Hierarchy::primary()->get();

		return view('tenant.lookup.depts.create', compact('hierarchies'));
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
	 * Display the specified resource.
	 */
	public function timestamp(Dept $dept)
	{
		$this->authorize('view', $dept);

		return view('tenant.lookup.depts.timestamp', compact('dept'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Dept $dept)
	{
		$this->authorize('update', $dept);

		$hierarchies = Hierarchy::primary()->get();

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

		// Write to Log
		EventLog::event('dept', $dept->id, 'update', 'name', $request->name);
		$dept->update($request->all());

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
		$this->authorize('export', Dept::class);

		$data = DB::select("
			SELECT d.id, d.name, IF(d.enable, 'Yes', 'No') enable, hpr.name pr_hierarchy_name, hpo.name po_hierarchy_name
			FROM depts d, hierarchies hpr, hierarchies hpo
			WHERE d.pr_hierarchy_id=hpr.id
			AND d.po_hierarchy_id=hpo.id
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('depts', $dataArray);
	}
}
