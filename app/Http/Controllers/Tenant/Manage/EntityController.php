<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			EntityController.php
* @brief		This file contains the implementation of the EntityController
* @path			\App\Http\Controllers\Tenant\Manage
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
namespace App\Http\Controllers\Tenant\Manage;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Manage\Entity;
use App\Http\Requests\Tenant\Manage\StoreEntityRequest;
use App\Http\Requests\Tenant\Manage\UpdateEntityRequest;

# 1. Models
# 2. Enums
# 3. Helpers
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Seeded
# 12. TODO 


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
		return view('tenant.manage.entities.index', compact('entities'));
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
		$this->authorize('delete', $entity);

		$entity->fill(['enable' => !$entity->enable]);
		$entity->update();

		// Write to Log
		EventLog::event('entity', $entity->name, 'update', 'enable', $entity->enable);

		return redirect()->route('entities.index')->with('success', 'Entity Status Updated successfully.');
	}
}
