<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			MenuController.php
* @brief		This file contains the implementation of the MenuController
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

use App\Models\Landlord\Manage\Menu;

use App\Http\Requests\Landlord\Manage\StoreMenuRequest;
use App\Http\Requests\Landlord\Manage\UpdateMenuRequest;

# 1. Models
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
use Illuminate\Support\Facades\Log;
use Str;
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
			$menus->where('route_name', 'Like', '%'.request('term').'%');
		}
		$menus = $menus->orderBy('route_name', 'ASC')->paginate(40);

		return view('landlord.manage.menus.index', compact('menus'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Menu::class);
		return view('landlord.manage.menus.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreMenuRequest $request)
	{

		$this->authorize('create', Menu::class);

		$request->merge(['access'	=> Str::upper($request->input('access')) ]);
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
		return view('landlord.manage.menus.show', compact('menu'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Menu $menu)
	{
		$this->authorize('update', $menu);
		return view('landlord.manage.menus.edit', compact('menu'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateMenuRequest $request, Menu $menu)
	{
		$this->authorize('update', $menu);
		$request->merge(['access'	=> Str::upper($request->input('access')) ]);

		$menu->update($request->all());

		// Write to Log
		EventLog::event('menu', $menu->id, 'update', 'name', $request->raw_route_name);

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
}
