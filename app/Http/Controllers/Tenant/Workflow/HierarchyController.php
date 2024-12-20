<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			HierarchyController.php
* @brief		This file contains the implementation of the HierarchyController
* @path			\App\Http\Controllers\Tenant\Workflow
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
namespace App\Http\Controllers\Tenant\Workflow;

use App\Http\Controllers\Controller;


use App\Models\Tenant\Workflow\Hierarchy;
use App\Http\Requests\Tenant\Workflow\StoreHierarchyRequest;
use App\Http\Requests\Tenant\Workflow\UpdateHierarchyRequest;

# 1. Models
use App\Models\User;
use App\Models\Tenant\Workflow\Hierarchyl;
# 2. Enums
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
# 13. FUTURE
# 1. Change design of show blade to user show blade with avatar

class HierarchyController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny', Hierarchy::class);

		$hierarchies = Hierarchy::query();
		if (request('term')) {
			$hierarchies->where('name', 'Like', '%' . request('term') . '%');
		}
		$hierarchies = $hierarchies->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.workflow.hierarchies.index', compact('hierarchies'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Hierarchy::class);

		$users = User::Tenant()->get();
		//$users = User::getAll();

		return view('tenant.workflow.hierarchies.create', compact('users'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreHierarchyRequest $request)
	{
		$this->authorize('create', Hierarchy::class);

		// check for duplicate entry
		$empList =array();
		// check if any person is more than once
		if ($request->input('approver_id_1') <> 0) {
			$empList[]	= $request->input('approver_id_1');
		}
		if ($request->input('approver_id_2') <> 0) {
			$empList[]	= $request->input('approver_id_2');
		}
		if ($request->input('approver_id_3') <> 0) {
			$empList[]	= $request->input('approver_id_3');
		}
		if ($request->input('approver_id_4') <> 0) {
			$empList[]	= $request->input('approver_id_4');
		}
		if ($request->input('approver_id_5') <> 0) {
			$empList[]	= $request->input('approver_id_5');
		}

		Log::debug('empList = '.print_r($empList));
		//Will be true if duplicates, or false if no duplicates.
		$hasDuplicates = count($empList) > count(array_unique($empList));
		Log::debug('hasDuplicates = '.$hasDuplicates);
		if ($hasDuplicates){
			return back()->withErrors('Duplicate Employee is not allowed in a Hierarchy.')->withInput();
		}

		$hierarchy = Hierarchy::create($request->all());

		//dd($request);
		// create Hierarchyl row 1
		$hierarchyl					= new Hierarchyl();

		$hierarchyl->hid			= $hierarchy->id;
		$hierarchyl->sequence		= 10;


		$hierarchyl->approver_id	= $request->input('approver_id_1');
		$hierarchyl->save();

		//Log::debug('approver_id_2 = '.$request->input('approver_id_2'));
		//Log::debug('approver_id_3 = '.$request->input('approver_id_3'));
		//Log::debug('approver_id_4 = '.$request->input('approver_id_4'));
		//Log::debug('approver_id_5 = '.$request->input('approver_id_5'));

		if ($request->input('approver_id_2') <> 0) {
			$hierarchyl					= new Hierarchyl();
			$hierarchyl->hid			= $hierarchy->id;
			$hierarchyl->sequence		= 20;
			$hierarchyl->approver_id	= $request->input('approver_id_2');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_3') <> 0) {
			$hierarchyl					= new Hierarchyl();
			$hierarchyl->hid			= $hierarchy->id;
			$hierarchyl->sequence		= 30;
			$hierarchyl->approver_id 	= $request->input('approver_id_3');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_4') <> 0) {
			$hierarchyl					= new Hierarchyl();
			$hierarchyl->hid			= $hierarchy->id;
			$hierarchyl->sequence		= 40;
			$hierarchyl->approver_id 	= $request->input('approver_id_4');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_5') <> 0) {
			$hierarchyl					= new Hierarchyl();
			$hierarchyl->hid			= $hierarchy->id;
			$hierarchyl->sequence		= 50;
			$hierarchyl->approver_id 	= $request->input('approver_id_5');
			$hierarchyl->save();
		}

		// Write to Log
		EventLog::event('hierarchy', $hierarchy->id, 'create');

		return redirect()->route('hierarchies.index')->with('success', 'Hierarchy created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Hierarchy $hierarchy)
	{
		$this->authorize('view', $hierarchy);

		$hierarchyls = Hierarchyl::with('approver.dept')->with('approver.designation')->where('hid', $hierarchy->id)->orderBy('id', 'asc')->get();
		return view('tenant.workflow.hierarchies.show', compact('hierarchy', 'hierarchyls'));
	}


	/**
	 * Display the specified resource.
	 */
	public function timestamp(Hierarchy $hierarchy)
	{
		$this->authorize('view', $hierarchy);

		return view('tenant.workflow.hierarchies.timestamp', compact('hierarchy'));
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Hierarchy $hierarchy)
	{
		$this->authorize('update', $hierarchy);

		$hierarchyls = Hierarchyl::where('hid', $hierarchy->id)->orderBy('id', 'asc')->get();
		//$users = User::NonSeeded();
		//$users = User::getAll();
		$users = User::TenantAll()->get();

		$approver_id_1 = '';
		$approver_id_2 = '';
		$approver_id_3 = '';
		$approver_id_4 = '';
		$approver_id_5 = '';

		$i = 1;
		foreach ($hierarchyls as $hierarchyl) {
			//Log::debug("id= ".$hierarchyl->approver_id." counter=". $i);

			switch ($i) {
				case 1:
					$approver_id_1 = $hierarchyl->approver_id;
					break;
				case 2:
					$approver_id_2 = $hierarchyl->approver_id;
					break;
				case 3:
					$approver_id_3 = $hierarchyl->approver_id;
					break;
				case 4:
					$approver_id_4 = $hierarchyl->approver_id;
					break;
				case 5:
					$approver_id_5 = $hierarchyl->approver_id;
					break;
				default:
					// Success
			}

			$i++;
		}
		// foreach($users as $user) {
		//		Log::debug("user id= ".$user->id." counter=". $i);
		//		$i++;
		// }

		//Log::debug("approver_id_1= ".$approver_id_1);
		//Log::debug("approver_id_2= ".$approver_id_2);
		//Log::debug("approver_id_3= ".$approver_id_3);
		//Log::debug("approver_id_4= ".$approver_id_4);
		//Log::debug("approver_id_5= ".$approver_id_5);

		//return view('hierarchies.edit',compact('hierarchy'));

		return view('tenant.workflow.hierarchies.edit')
			->with(compact('hierarchy', 'users'))
			->with(['approver_id_1' => $approver_id_1])
			->with(['approver_id_2' => $approver_id_2])
			->with(['approver_id_3' => $approver_id_3])
			->with(['approver_id_4' => $approver_id_4])
			->with(['approver_id_5' => $approver_id_5]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateHierarchyRequest $request, Hierarchy $hierarchy)
	{
		$this->authorize('update', $hierarchy);

		// check for duplicate entry
		$empList = array();

		Log::debug('tenant.Hierarchy.update approver_id_1 = '. $request->input('approver_id_1'));
		// check if any person is more than once
		if ($request->input('approver_id_1') <> 0) {
			$empList[]	= $request->input('approver_id_1');
		}
		if ($request->input('approver_id_2') <> 0) {
			$empList[]	= $request->input('approver_id_2');
		}
		if ($request->input('approver_id_3') <> 0) {
			$empList[]	= $request->input('approver_id_3');
		}
		if ($request->input('approver_id_4') <> 0) {
			$empList[]	= $request->input('approver_id_4');
		}
		if ($request->input('approver_id_5') <> 0) {
			$empList[]	= $request->input('approver_id_5');
		}

		//print_r($empList);

		//Will be true if duplicates, or false if no duplicates.
		$hasDuplicates = count($empList) > count(array_unique($empList));
		//Log::debug('hasDuplicates = '.$hasDuplicates);

		if ($hasDuplicates){
			return back()->withErrors('Duplicate Employee is not allowed in a Hierarchy.')->withInput();
		}

		//dd($request);
		//$request->validate();
		$request->validate([]);

		$hierarchy->update($request->all());

		// delete old line from hierarchyl and create
		//$hierarchyl->where('hid', hierarchy)->delete();
		DB::table('hierarchyls')->where('hid', $hierarchy->id)->delete();

		// re- create lines
		$hierarchyl					= new Hierarchyl();

		$hierarchyl->hid			= $hierarchy->id;
		$hierarchyl->sequence		= 10;
		$hierarchyl->approver_id	= $request->input('approver_id_1');
		$hierarchyl->save();

		// Write to Log
		EventLog::event('hierarchy', $hierarchy->id, 'update', 'name', $hierarchy->name);

		if ($request->input('approver_id_2') <> 0) {
			$hierarchyl					= new Hierarchyl();
			$hierarchyl->hid			= $hierarchy->id;
			$hierarchyl->sequence		= 20;
			$hierarchyl->approver_id 	= $request->input('approver_id_2');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_3') <> 0) {
			$hierarchyl					= new Hierarchyl();
			$hierarchyl->hid			= $hierarchy->id;
			$hierarchyl->sequence		= 30;
			$hierarchyl->approver_id 	= $request->input('approver_id_3');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_4') <> 0) {
			$hierarchyl					= new Hierarchyl();
			$hierarchyl->hid			= $hierarchy->id;
			$hierarchyl->sequence		= 40;
			$hierarchyl->approver_id 	= $request->input('approver_id_4');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_5') <> 0) {
			$hierarchyl					= new Hierarchyl();
			$hierarchyl->hid			= $hierarchy->id;
			$hierarchyl->sequence		= 50;
			$hierarchyl->approver_id 	= $request->input('approver_id_5');
			$hierarchyl->save();
		}


		return redirect()->route('hierarchies.index')->with('success', 'Hierarchy updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Hierarchy $hierarchy)
	{
		$this->authorize('delete', $hierarchy);

		$hierarchy->fill(['enable' => !$hierarchy->enable]);
		$hierarchy->update();

		// Write to Log
		EventLog::event('hierarchy', $hierarchy->id, 'status', 'enable', $hierarchy->enable);

		return redirect()->route('hierarchies.index')->with('success', 'Hierarchy status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Hierarchy::class);

		$data = DB::select("SELECT h.id, h.name, IF(h.enable, 'Yes', 'No') AS enable,
			hl.sequence, u.name user_name
			FROM hierarchies h,hierarchyls hl, users u
			WHERE h.id=hl.hid
			AND hl.approver_id=u.id
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('hierarchies', $dataArray);
	}
}
