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
use App\Http\Requests\Landlord\Admin\StoreServiceRequest;
use App\Http\Requests\Landlord\Admin\UpdateServiceRequest;

# 1. Models
use App\Models\User;
use App\Models\Landlord\Admin\Service;
use App\Models\Landlord\Account;
use App\Models\Landlord\Lookup\Product;
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
use Illuminate\Database\Eloquent\ModelNotFoundException;
# 10. Events
# 11. Controller
# 12. Seeded
use Illuminate\Support\Facades\Log;
use DB;
# 13. FUTURE



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
		$this->authorize('viewAny',Service::class);

		$services = Service::with('account')->byAccount()->orderBy('id', 'ASC')->paginate(10);

		$addons = Product::where('addon', true)->where('enable', true)->orderBy('id', 'ASC')->get();

		try {
			$account = Account::where('id', auth()->user()->account_id)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			 return redirect()->route('dashboards.index')->with('error', 'No Service found!');
		}

		return view('landlord.admin.services.index', compact('services', 'addons','account'));
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

		$services = Service::with('account')->orderBy('id', 'ASC')->paginate(10);
		$addons = Product::where('addon', true)->where('enable', true)->orderBy('id', 'ASC')->get();
		$account = Account::where('id', auth()->user()->account_id)->first();
		return view('landlord.admin.services.all', compact('services', 'addons','account'));

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
		$account = Account::where('id', $service->account_id)->first();
		return view('landlord.admin.services.show', compact('service', 'entity','account'));
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
			EventLog::event('service', $service->id, 'update', 'owner_id', $service->owner_id);
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

	public function export()
	{
		$this->authorize('export', Service::class);

		$data = DB::select("
			SELECT *
			FROM services as c
			");

		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('services', $dataArray);

	}

}
