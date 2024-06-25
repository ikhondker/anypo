<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Http\Requests\StoreDomainRequest;
use App\Http\Requests\UpdateDomainRequest;

# 1. Models
use App\Models\Tenant;
use App\Models\User;
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
# 13. FUTURE

class DomainController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$domains = Domain::latest()->orderBy('id','asc')->paginate(20);
		return view('domains.index',compact('domains'))->with('i', (request()->input('page', 1) - 1) * 20);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreDomainRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Domain $domain)
	{


		$this->authorize('view', $domain);

		//Tenancy::setTenant($tenant);
		// tenancy()->initialize($tenant);
		// $users = User::all();
		// //dd($users);
		// tenancy()->end();

		$tenant = Tenant::find( $domain->tenant_id);
		$users = $tenant->run(function(){
			return User::all();
		    }
		);

		//return view('domains.show',compact('domain','users'));
        return view('domains.show',compact('domain'));

	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Domain $domain)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateDomainRequest $request, Domain $domain)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Domain $domain)
	{
		//
	}

	/**
	*
	* Export selected column to csv format
	*
	*/
	public function export()
	{

		//$data = Uom::all()->toArray();
		 $data = DB::select("SELECT a.id, a.object_name, a.object_id, a.event_name ,a.column_name, a.prior_value, a.url,a.role, a.user_id, a.created_at
				 FROM activities a
				 ");

		 $dataArray = json_decode(json_encode($data), true);

		// export to CSV
		return exportCSV('activities', $dataArray);
	}
}
