<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			UomController.php
* @brief		This file contains the implementation of the UomController
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


use App\Models\Tenant\Lookup\Uom;
use App\Http\Requests\Tenant\Lookup\StoreUomRequest;
use App\Http\Requests\Tenant\Lookup\UpdateUomRequest;

# 1. Models
use App\Models\Tenant\Manage\UomClass;
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
# 12. TODO 




class UomController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Uom::class);

		$uoms = Uom::query();
		if (request('term')) {
			$uoms->where('name', 'Like', '%' . request('term') . '%');
		}
		$uoms = $uoms->with('uom_class')->orderBy('id', 'DESC')->paginate(20);
		return view('tenant.lookup.uoms.index', compact('uoms'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Uom::class);

		$uomClasses = UomClass::All();
		return view('tenant.lookup.uoms.create', compact('uomClasses'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreUomRequest $request)
	{
		$this->authorize('create', Uom::class);
		$uom = Uom::create($request->all());
		// Write to Log
		EventLog::event('uom', $uom->id, 'create');

		return redirect()->route('uoms.index')->with('success', 'Uom created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Uom $uom)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Uom $uom)
	{
		$this->authorize('update', $uom);
		
		return view('tenant.lookup.uoms.edit', compact('uom'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateUomRequest $request, Uom $uom)
	{
		$this->authorize('update', $uom);

		$uom->update($request->all());

		// Write to Log
		EventLog::event('uom', $uom->id, 'update', 'name', $uom->name);
		return redirect()->route('uoms.index')->with('success', 'Uom updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Uom $uom)
	{
		$this->authorize('delete', $uom);

		$uom->fill(['enable' => !$uom->enable]);
		$uom->update();

		// Write to Log
		EventLog::event('uom', $uom->id, 'status', 'enable', $uom->enable);

		return redirect()->route('uoms.index')->with('success', 'Uom status Updated successfully');
	}

	public function export()
	{
		$this->authorize('export', Uom::class);

		$data = DB::select("
		SELECT u.id, u.name uom, uc.name uom_class, u.conversion, IF(u.enable, 'Yes', 'No') as Enable
		FROM uoms u, uom_classes uc
		WHERE u.uom_class_id = uc.id
		");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('uoms', $dataArray);
	}

	public function getUomsByClass($id = 0)
	{
		//http://demo1.localhost:8000/items/get-item/1005
		$data = [];
		//Log::info('id='.$id);
		//$data = Category::where('id', $id)->first();
		//{"id":3,"name":"Category -3","slug":"Neque non.","enable":1,"limit":30,"created_at":"2022-07-04T07:08:42.000000Z","updated_at":"2022-07-04T07:08:42.000000Z"}
		$data['uoms'] = Uom::select('id','name')->where('uom_class_id', $id)->get();
		// {"limit":30,"slug":"Neque non."}  
		//Log::info( $data);
		
		Log::debug('Value of data[uom]=' . $data['uoms']);
		return response()->json($data);

	}

}
