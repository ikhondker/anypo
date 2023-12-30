<?php

namespace App\Http\Controllers\Tenant\Workflow;
use App\Http\Controllers\Controller;


use App\Models\Tenant\Workflow\Hierarchy;
use App\Http\Requests\Tenant\Workflow\StoreHierarchyRequest;
use App\Http\Requests\Tenant\Workflow\UpdateHierarchyRequest;

# Models
use App\Models\User;
use App\Models\Tenant\Workflow\Hierarchyl;
# Enums
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
# Notifications
# Mails
# Packages
# Seeded
use Illuminate\Support\Facades\Log;
use DB;

# Exceptions
# Events

class HierarchyController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$hierarchies = Hierarchy::query();
		if (request('term')) {
			$hierarchies->where('name', 'Like', '%' . request('term') . '%');
		}
		$hierarchies = $hierarchies->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.workflow.hierarchies.index', compact('hierarchies'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Hierarchy::class);

		$users = User::NonSeeded()->get();
		//$users = User::getAll();

		return view('tenant.workflow.hierarchies.create', compact('users'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreHierarchyRequest $request)
	{
		$this->authorize('create', Hierarchy::class);

		$hierarchy = Hierarchy::create($request->all());

		//dd($request);
		// create Hierarchyl row 1
		$hierarchyl                 = new Hierarchyl();

		$hierarchyl->hid    		= $hierarchy->id;
		$hierarchyl->approver_id    = $request->input('approver_id_1');
		$hierarchyl->save();

		//Log::debug('approver_id_2='.$request->input('approver_id_2'));
		//Log::debug('approver_id_3='.$request->input('approver_id_3'));
		//Log::debug('approver_id_4='.$request->input('approver_id_4'));
		//Log::debug('approver_id_5='.$request->input('approver_id_5'));

		if ($request->input('approver_id_2') <> "") {
			$hierarchyl                 = new Hierarchyl();
			$hierarchyl->hid    		= $hierarchy->id;
			$hierarchyl->approver_id = $request->input('approver_id_2');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_3') <> "") {
			$hierarchyl                 = new Hierarchyl();
			$hierarchyl->hid    		= $hierarchy->id;
			$hierarchyl->approver_id = $request->input('approver_id_3');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_4') <> "") {
			$hierarchyl                 = new Hierarchyl();
			$hierarchyl->hid    		= $hierarchy->id;
			$hierarchyl->approver_id = $request->input('approver_id_4');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_5') <> "") {
			$hierarchyl                 = new Hierarchyl();
			$hierarchyl->hid    		= $hierarchy->id;
			$hierarchyl->approver_id = $request->input('approver_id_5');
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
		//$this->authorize('view', $user);

		$hierarchyls        = Hierarchyl::where('hid', $hierarchy->id)->orderBy('id', 'asc')->get();
		return view('tenant.workflow.hierarchies.show', compact('hierarchy', 'hierarchyls'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Hierarchy $hierarchy)
	{
		$this->authorize('update', $hierarchy);
		$hierarchyls        = Hierarchyl::where('hid', $hierarchy->id)->orderBy('id', 'asc')->get();
		//$users = User::NonSeeded();
		//$users = User::getAll();
		$users = User::NonSeeded()->get();


		$approver_id_1 = 0;
		$approver_id_2 = 0;
		$approver_id_3 = 0;
		$approver_id_4 = 0;
		$approver_id_5 = 0;

		$i = 1;
		foreach($hierarchyls as $hierarchyl) {
			//Log::debug("id=  ".$hierarchyl->approver_id." counter=". $i);

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
		//     Log::debug("user id=  ".$user->id." counter=". $i);
		//     $i++;
		// }

		//Log::debug("approver_id_1=  ".$approver_id_1);
		//Log::debug("approver_id_2=  ".$approver_id_2);
		//Log::debug("approver_id_3=  ".$approver_id_3);
		//Log::debug("approver_id_4=  ".$approver_id_4);
		//Log::debug("approver_id_5=  ".$approver_id_5);

		//return view('hierarchies.edit',compact('hierarchy'));

		return view('tenant.workflow.hierarchies.edit')
			->with(compact('hierarchy', 'users'))
			->with(['approver_id_1' => $approver_id_1])
			->with(['approver_id_2' => $approver_id_2])
			->with(['approver_id_3' => $approver_id_3])
			->with(['approver_id_4' => $approver_id_4])
			->with(['approver_id_5' => $approver_id_5])
		;
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateHierarchyRequest $request, Hierarchy $hierarchy)
	{
		$this->authorize('update', $hierarchy);

		//$request->validate();
		$request->validate([

		]);

		$hierarchy->update($request->all());

		// delete old line from hierarchyl and create
		//$hierarchyl->where('hid', hierarchy)->delete();
		DB::table('hierarchyls')->where('hid', $hierarchy->id)->delete();

		// re- create lines
		$hierarchyl                 = new Hierarchyl();

		$hierarchyl->hid    		= $hierarchy->id;
		$hierarchyl->approver_id    = $request->input('approver_id_1');
		$hierarchyl->save();


		if ($request->input('approver_id_2') <> "") {
			$hierarchyl                 = new Hierarchyl();
			$hierarchyl->hid    		= $hierarchy->id;
			$hierarchyl->approver_id = $request->input('approver_id_2');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_3') <> "") {
			$hierarchyl                 = new Hierarchyl();
			$hierarchyl->hid    		= $hierarchy->id;
			$hierarchyl->approver_id = $request->input('approver_id_3');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_4') <> "") {
			$hierarchyl                 = new Hierarchyl();
			$hierarchyl->hid    		= $hierarchy->id;
			$hierarchyl->approver_id = $request->input('approver_id_4');
			$hierarchyl->save();
		}

		if ($request->input('approver_id_5') <> "") {
			$hierarchyl                 = new Hierarchyl();
			$hierarchyl->hid    		= $hierarchy->id;
			$hierarchyl->approver_id = $request->input('approver_id_5');
			$hierarchyl->save();
		}

		// Write to Log
		EventLog::event('hierarchy', $hierarchy->id, 'update', 'name', $hierarchy->name);
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
		$data = DB::select("SELECT h.id, h.name, IF(h.enable, 'Yes', 'No') AS enable, 
			hl.id sequence, u.name user_name
			FROM hierarchies h,hierarchyls hl, users u
			WHERE h.id=hl.hid
			AND hl.approver_id=u.id
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('hierarchies', $dataArray);
	}
}
