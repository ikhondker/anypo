<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			MenuController.php
* @brief		This file contains the implementation of the MenuController
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
use App\Http\Requests\Tenant\Manage\StoreMenuRequest;
use App\Http\Requests\Tenant\Manage\UpdateMenuRequest;


# 1. Models
use App\Models\Tenant\Manage\Menu;
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

class MenuController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{

		$this->authorize('viewAny', Menu::class);

		$menus = Menu::query();
		if (request('term')) {
			$menus->where('raw_route_name', 'Like', '%'.request('term').'%');
		}
		$menus = $menus->orderBy('raw_route_name', 'ASC')->paginate(40);

		return view('tenant.manage.menus.index', compact('menus'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Menu::class);

		return view('tenant.manage.menus.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreMenuRequest $request)
	{
		$this->authorize('create', Menu::class);
		$menu = Menu::create($request->all());
		// Write to Log
		EventLog::event('menu', $menu->id, 'create');

		return redirect()->route('menus.index')->with('success', 'Menu created successfully.');

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Menu $menu)
	{
		$this->authorize('view', $menu);

		return view('tenant.manage.menus.show', compact('menu'));
	}

	/**
		 * Show the form for editing the specified resource.
		 */
	public function edit(Menu $menu)
	{
		$this->authorize('update', $menu);

		return view('tenant.manage.menus.edit', compact('menu'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateMenuRequest $request, Menu $menu)
	{
		$this->authorize('update', $menu);

		//$request->validate();
		$request->validate([
		]);
		$menu->update($request->all());

		// Write to Log
		EventLog::event('menu', $menu->id, 'update', 'name', $request->name);

		return redirect()->route('menus.index')->with('success', 'Menu updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Menu $menu)
	{
		$this->authorize('delete', $menu);

		$menu->fill(['enable' => ! $menu->enable]);
		$menu->update();
		// Write to Log
		EventLog::event('menu', $menu->id, 'status', 'enable', $menu->enable);

		return redirect()->route('menus.index')->with('success', 'Menu status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Menu::class);

		$data = DB::select("
			SELECT id, raw_route_name, route_name, node_name, IF(enable, 'Yes', 'No') as Enable, created_by, created_at, updated_by, updated_at FROM menus
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('menus', $dataArray);
	}

}
