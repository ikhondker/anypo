<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			DbuController.php
* @brief		This file contains the implementation of the DbuController
* @path			\App\Http\Controllers\Tenant
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

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use App\Models\Tenant\Dbu;
use App\Http\Requests\StoreDbuRequest;
use App\Http\Requests\UpdateDbuRequest;

use App\Enum\UserRoleEnum;

# 1. Models
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
# 13. TODO 



class DbuController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->authorize('viewAny',Dbu::class);

		//liveware
		//return view('dbus.index');

		$dbus = Dbu::query();
		if (request('term')) {
			$dbus->where('name', 'Like', '%' . request('term') . '%');
		}

		switch (auth()->user()->role->value) {
			case UserRoleEnum::HOD->value:
				$dbus = $dbus->ByDeptAll()->with('dept')->with('deptBudget.budget')->with('project')->orderBy('id', 'DESC')->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$dbus = $dbus->with('dept')->with('deptBudget.budget')->with('project')->orderBy('id', 'DESC')->paginate(10);
				break;
			default:
				//$dbus = $dbus->ByUserAll()->with('dept')->with('deptBudget.budget')->with('project')->paginate(10);
				Log::warning("tenant.DeptBudget.index Other roles!");
				abort(403);
		}


		//$dbus = $dbus->with('dept')->with('deptBudget.budget')->with('project')->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.dbus.index', compact('dbus'));
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
	public function store(StoreDbuRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Dbu $dbu)
	{
		$this->authorize('view', $dbu);

		return view('tenant.dbus.show', compact('dbu'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Dbu $dbu)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateDbuRequest $request, Dbu $dbu)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Dbu $dbu)
	{
		//
	}

	public function export()
	{
		
		$this->authorize('export', Dbu::class);

		$data = DB::select("
		SELECT u.id, u.entity, u.article_id, u.event, o.name user_name, d.name dept_name, p.name project_name, 
		u.amount_pr_booked, u.amount_pr, u.amount_po_booked, u.amount_po, u.amount_grs, u.amount_invoice, u.amount_payment, 
		u.created_at
		FROM dbus u,dept_budgets db,budgets b,depts d, projects p, users o
		WHERE u.dept_budget_id = db.id
		AND db.budget_id = b.id
		AND db.dept_id=d.id
		AND u.project_id=p.id
		AND u.user_id=o.id

		");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('dbus', $dataArray);
	}

}
