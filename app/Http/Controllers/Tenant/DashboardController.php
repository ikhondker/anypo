<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			DashboardController.php
* @brief		This file contains the implementation of the DashboardController
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

use Illuminate\Http\Request;

# 1. Models
use App\Models\Tenant\Admin\Setup;
use App\Models\User;
use App\Models\Tenant\DeptBudget;
# 2. Enums
use App\Enum\UserRoleEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
# 5. Jobs
use App\Jobs\Tenant\ImportAllRate;
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
//use Illuminate\Support\Collection;
# 13. FUTURE


class DashboardController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{

		// if new month starts, import rates
		// =================================================
		$setup = Setup::first();
		// import rate only if setup is freezed
		if ($setup->freezed) {
			// check if current months import rates imported
			if ($setup->last_rate_date <> '') {
				$last_rate_month	= $setup->last_rate_date->startOfMonth();
				Log::debug('tenant.dashboards.index Checking Rates. setup.last_rate_month = '.$last_rate_month.' Will check if months has been changed since last import.');
			} else {
				Log::debug('tenant.dashboards.index Checking Rates. last_rate_month is empty. Will import rate for the first time.');
				$last_rate_month	= '';
			}

			$current_rate_month		= Carbon::now()->startOfMonth();

			Log::debug('tenant.dashboards.index last_rate_month = '.$last_rate_month);
			Log::debug('tenant.dashboards.index current_rate_month = '.$current_rate_month);

			if ($last_rate_month <> $current_rate_month) {
				// import current rates using queue
				Log::debug('tenant.dashboards.index Submitting ImportAllRate::dispatch() for '.$current_rate_month);
				ImportAllRate::dispatch();
			} else {
				Log::debug('tenant.dashboards.index Rate Already Imported for current month starting '.$current_rate_month);
			}
		} else {
			Log::debug('tenant.dashboards.index Rate Setup is not freezed. Skipping Rate Import');
		}

		// Total 4 Dashboard user,admin, backoffice and system
		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:
				return self::userDashboard();
				break;
			case UserRoleEnum::BUYER->value:
				return self::buyerDashboard();
				break;
			case UserRoleEnum::HOD->value:
				return self::hodDashboard();
				break;
			case UserRoleEnum::CXO->value:
				return self::cxoDashboard();
				break;
			case UserRoleEnum::ADMIN->value:
				return self::adminDashboard();
				break;
			case UserRoleEnum::SYS->value:
				return self::systemDashboard();
				break;
			default:
				return self::userDashboard();
				Log::warninig(" tenant.dashboards.indexOther roles!");
		}

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
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}

	private function userDashboard()
	{
		return view('tenant.dashboards.index');
	}

	private function buyerDashboard()
	{
		return view('tenant.dashboards.buyer');
	}

	private function hodDashboard()
	{
		return view('tenant.dashboards.hod');
	}

	private function cxoDashboard()
	{
		return view('tenant.dashboards.cxo');
	}

	private function adminDashboard()
	{
		return view('tenant.dashboards.admin');
	}

	public function systemDashboard()
	{

		// ====================== Budget====================================
		$records = DB::select("SELECT amount-amount_po_booked-amount_po as amount, amount_po_booked, amount_po
		FROM budgets b
		WHERE b.fy = date('Y')");
		//$result = $dept_budgets->toArray();
		//$data = [];
		$budget_labels = [];
		$budget_labels[] = "Available";
		$budget_labels[] = "PO Booked";
		$budget_labels[] = "PO Issued";

		$budget_data = [];
		foreach($records as $row) {
			$budget_data[] = (int) $row->amount;
			$budget_data[] = (int) $row->amount_po_booked;
			$budget_data[] = (int) $row->amount_po;
		}

		// Generate random colours for the groups
		for ($i = 0; $i <= count($records); $i++) {
			$budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		}

		// ====================== Dept Allocated Budget Pie====================================
		$records = DB::select("SELECT d.name, db.amount
			FROM dept_budgets db, budgets b, depts d
			WHERE db.budget_id=b.id
			and b.fy = date('Y')
			and db.dept_id=d.id");
		$depb_labels = [];
		$depb_data = [];
		foreach($records as $row) {
			$depb_labels[] = $row->name;
			$depb_data[] = (int) $row->amount;
		}
		// Generate random colours for the groups
		for ($i = 0; $i <= count($records); $i++) {
			$depb_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		}

		// ====================== Dept Allocated vs used Budget====================================
		$records = DB::select("SELECT d.name, db.amount, db.amount_po
		FROM dept_budgets db, budgets b, depts d
		WHERE db.budget_id=b.id
		and b.fy = date('Y')
		and db.dept_id=d.id");
		$depb_budget_labels = [];
		$depb_budget_amount = [];
		$depb_budget_po = [];
		$depb_budget_colors = [];

		foreach($records as $row) {
			$depb_budget_labels[] = $row->name;
			$depb_budget_amount[] = (int) $row->amount;
			$depb_budget_po[] = (int) $row->amount_po;

		}
		// Generate random colours for the groups
		for ($i = 0; $i <= count($records); $i++) {
			$depb_budget_colors[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
		}
		//dd($depb_budget_labels,$depb_budget_amount,$depb_budget_po);


		// ====================== View ====================================
		return view('tenant.dashboards.system', compact(
			'budget_labels',
			'budget_data',
			'budget_colors',
			'depb_labels',
			'depb_data',
			'depb_colors',
			'depb_budget_labels',
			'depb_budget_amount',
			'depb_budget_po',
			'depb_budget_colors'
		));

	}

}
