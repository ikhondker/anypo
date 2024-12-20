<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			EntityController.php
* @brief		This file contains the implementation of the EntityController
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
use App\Http\Requests\Landlord\Manage\StoreEntityRequest;
use App\Http\Requests\Landlord\Manage\UpdateEntityRequest;

# 1. Models
use App\Models\Landlord\Manage\Entity;
# 2. Enums
# 3. Helpers
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
# 13. FUTURE


class EntityController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$entities = Entity::latest()->orderBy('entity', 'asc')->paginate(20);
		return view('landlord.manage.entities.index', compact('entities'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Entity::class);
		return view('landlord.manage.entities.create');
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
		EventLog::event('entity', $Entity->id, 'create');

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
		$this->authorize('view', $entity);
		return view('landlord.manage.entities.show', compact('entity'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Entity  $entity
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Entity $entity)
	{
		$this->authorize('update',$entity);
		// Write Event Log
		//EventLog::event('template',$template->id,'edit','template',$template->id);
		return view('landlord.manage.entities.edit', compact('entity'));
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
		$this->authorize('update',$entity);

		$request->validate([]);
		$entity->update($request->all());

		EventLog::event('entity', $entity->entity, 'update', 'name', $entity->name);
		EventLog::event('entity', $entity->entity, 'update', 'limit', $entity->limit);
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
		$this->authorize('delete',$entity);

		$entity->fill(['enable' => !$entity->enable]);
		$entity->update();

		// Write to Log
		EventLog::event('entity', $entity->entity, 'status', 'enable', $entity->enable);
		return redirect()->route('entities.index')->with('success', 'Entity Status Updated successfully');
	}

	public function export()
	{
		$this->authorize('download', Entity::class);
		$data = DB::select("SELECT
			entity, name, code, subdir, module, slug, enable, created_by, created_at, updated_by, updated_at
			FROM entities");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return exportCSV('entities', $dataArray);
	}
}
