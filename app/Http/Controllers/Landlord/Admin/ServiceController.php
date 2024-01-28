<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			ServiceController.php
* @brief		This file contains the implementation of the ServiceController
* @path			\app\Http\Controllers\Landlord\Admin
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

namespace App\Http\Controllers\Landlord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\StoreServiceRequest;
use App\Http\Requests\Landlord\UpdateServiceRequest;

// Models
use App\Models\User;
use App\Models\Landlord\Admin\Service;
use App\Models\Landlord\Account;

use App\Models\Landlord\Lookup\Product;

// Enums
use App\Enum\UserRoleEnum;

// Helpers
use App\Helpers\LandlordEventLog;

// Seeded
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServiceController extends Controller
{
	// define entity constant for file upload and workflow
	const ENTITY	= 'SERVICE';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//$this->authorize('view',Service::class);

		$services = Service::byAccount()->orderBy('id', 'ASC')->paginate(10);

		$addons = Product::where('addon', true)->where('enable', true)->orderBy('id', 'ASC')->get();
		
		try {
			$account = Account::where('id', auth()->user()->account_id)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			 return redirect()->route('dashboards.index')->with('error', 'No Service found!');
		}

		return view('landlord.admin.services.index', compact('services', 'addons','account'))
			->with('i', (request()->input('page', 1) - 1) * 10);
		//->with('cur_account_id',$services->account_id)
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all()
	{
		
		$this->authorize('viewAll',Service::class);

		$services = Service::orderBy('id', 'ASC')->paginate(10);
		$addons = Product::where('addon', true)->where('enable', true)->orderBy('id', 'ASC')->get();
		$account = Account::where('id', auth()->user()->account_id)->first();

		return view('landlord.admin.services.all', compact('services', 'addons','account'))
			->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreServiceRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreServiceRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Service  $service
	 * @return \Illuminate\Http\Response
	 */
	public function show(Service $service)
	{
		$this->authorize('view', $service);

		$entity = static::ENTITY;
		return view('landlord.admin.services.show', compact('service', 'entity'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Service  $service
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Service $service)
	{
		$this->authorize('update', $service);
		$owners = User::getOwners($service->account_id);
		return view('landlord.admin.services.edit', compact('service', 'owners'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateServiceRequest  $request
	 * @param  \App\Models\Service  $service
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateServiceRequest $request, Service $service)
	{
		$this->authorize('update', $service);

		$request->validate([]);
		$service->update($request->all());

		if ($request->input('owner_id') <> $service->owner_id) {
			LandlordEventLog::event('service', $service->id, 'update', 'owner_id', $service->owner_id);
		}

		return redirect()->route('services.index')->with('success', 'Service updated successfully');
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Service  $service
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Service $service)
	{
		//
	}
}
