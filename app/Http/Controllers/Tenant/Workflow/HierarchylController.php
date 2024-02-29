<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			HierarchylController.php
* @brief		This file contains the implementation of the HierarchylController
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


use App\Models\Tenant\Workflow\Hierarchyl;
use App\Http\Requests\Tenant\Workflow\StoreHierarchylRequest;
use App\Http\Requests\Tenant\Workflow\UpdateHierarchylRequest;

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
# 11. Controller
# 12. Seeded
# 13. TODO 


class HierarchylController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		abort(403);
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
	public function store(StoreHierarchylRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Hierarchyl $hierarchyl)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Hierarchyl $hierarchyl)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateHierarchylRequest $request, Hierarchyl $hierarchyl)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Hierarchyl $hierarchyl)
	{
		abort(403);
	}
}
