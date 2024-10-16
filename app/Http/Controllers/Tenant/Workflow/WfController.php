<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			WfController.php
* @brief		This file contains the implementation of the WfController
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


use App\Http\Requests\Tenant\Workflow\StoreWfRequest;
use App\Http\Requests\Tenant\Workflow\UpdateWfRequest;

# 1. Models
use App\Models\Tenant\Workflow\Wf;
use App\Models\Tenant\Workflow\Wfl;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
# 2. Enums
use App\Enum\Tenant\AuthStatusEnum;
use App\Enum\Tenant\WfStatusEnum;
use App\Enum\Tenant\EventEnum;
# 3. Helpers
use App\Helpers\Tenant\PrBudget;
use App\Helpers\Tenant\PoBudget;
use App\Helpers\Export;
use App\Helpers\EventLog;
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
use DB;
use Illuminate\Support\Facades\Log;
# 13. TODO

class WfController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{

		$this->authorize('viewAny', Wf::class);

		$wfs = Wf::query();
		if (request('term')) {
			$wfs->where('article_id', 'Like', '%' . request('term') . '%');
		}
		$wfs = $wfs->with("relHierarchy")->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.workflow.wfs.index', compact('wfs'));
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
	public function store(StoreWfRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Wf $wf)
	{
		$this->authorize('view', $wf);

		$wfls = Wfl::with('performer')->where('wf_id', $wf->id)->orderBy('id', 'asc')->get();
		return view('tenant.workflow.wfs.show', compact('wf', 'wfls'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Wf $wf)
	{
		abort(403);

	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateWfRequest $request, Wf $wf)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Wf $wf)
	{
		abort(403);
	}

	public function export()
	{
		$this->authorize('export', Wf::class);

		$data = DB::select("SELECT wf.id, wf.entity, wf.article_id, wf.hierarchy_id, wf.wf_status, wf.auth_status, wf.auth_user_id, wf.auth_date,
		wfl.id line_id, p.name performer_name,wfl.assign_date, wfl.action_date, wfl.action, wfl.notes
		FROM wfs wf,wfls wfl, users p
		WHERE wf.id=wfl.wf_id
		AND wfl.performer_id=p.id
			");
		$dataArray = json_decode(json_encode($data), true);
		// used Export Helper
		return Export::csv('users', $dataArray);
	}


	/**
	 * Store a newly created resource in storage.
	 */
	public function wfResetPr(Pr $pr)
	{
		$this->authorize('reset',Wf::class);

		// check if pr status only in-process
		if ($pr->auth_status <> AuthStatusEnum::INPROCESS->value){
			return back()->withError("Workflow can be reset only for Requisitions with approval status IN-PROCESS!");
		}

		try {
			// mark wf as RESET
			Log::debug('tenant.wf.wfResetPr Reseting WF for PR#  = '. $pr->id);
			try {
				$wf = Wf::findOrFail($pr->wf_id);
				$wf->wf_status = WfStatusEnum::RESET->value;
				$wf->update();
			} catch (ModelNotFoundException $exception) {
				// Error handling code
				Log::debug("WF # ".$pr->wf_id." not Found! Check!");
			}

			// reverse Booking
			Log::debug('tenant.wf.wfResetPr Running PrBudget::prBudgetBookReverse for PR#  = '. $pr->id);
			$retcode = PrBudget::prBudgetBookReverse(EventEnum::RESET->value, $pr->id);
			Log::debug("tenant.wf.wfResetPr PrBudget::prBudgetBookReverse retcode = ".$retcode);

			//reset pr wf_id and status
			Log::debug('tenant.wf.wfResetPr Reseting Pr Wf status for PR#  = '. $pr->id);
			$pr->wf_id = 0;
			$pr->auth_status = AuthStatusEnum::DRAFT->value;
			$pr->submission_date = null;
			$pr->update();

			EventLog::event('pr', $pr->id, 'reset');	// Write to Log
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			Log::debug("PR#".$pr->id." not Found or PR is not in 'IN-PROCESS' status!");
			//return back()->withError($exception->getMessage())->withInput();
			return back()->withError("PR#".$pr->id." not Found or PR is not in IN-PROCESS status!");
		}
		return redirect()->route('prs.show', $pr->id)->with('success', 'Requisition status reset successfully');
	}



	/**
	 * Show the form for creating a new resource.
	 */
	public function wfResetPo(Po $po)
	{
		$this->authorize('reset',Wf::class);

		// update PR header
		//$pr	= Pr::where('id', $request->input('pr_id'))->firstOrFail();
		if ($po->auth_status <> AuthStatusEnum::INPROCESS->value){
			return back()->withError("Workflow can be reset only for Purchase Order with approval status IN-PROCESS!");
		}

		try {

			//$po = Po::where('id', $po->id)->where('auth_status', AuthStatusEnum::INPROCESS->value)->firstOrFail();

			// mark wf as RESET
			Log::debug('tenant.wf.wfResetPo Reseting WF for PO#  = '. $po->id);
			try {
				$wf = Wf::findOrFail($po->wf_id);
				$wf->wf_status = WfStatusEnum::RESET->value;
				$wf->update();
			} catch (ModelNotFoundException $exception) {
				// Error handling code
				Log::debug("WF # ".$po->wf_id." not Found! Check!");
			}

			// reverse Booking
			Log::debug('tenant.wf.wfResetPo Running PrBudget::prBudgetBookReverse for PR#  = '. $po->id);
			$retcode = PoBudget::poBudgetBookReverse(EventEnum::RESET->value,$po->id);
			Log::debug("tenant.wf.wfResetPo PoBudget::poBudgetBookReverse retcode = ".$retcode);

			//reset po wf_id and status
			Log::debug('tenant.wf.wfResetPo Reseting Pr Wf status for PO#  = '. $po->id);
			$po->wf_id = 0;
			$po->auth_status = AuthStatusEnum::DRAFT->value;
			$po->submission_date = null;
			$po->update();

			EventLog::event('po', $po->id, 'reset');	// Write to Log
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			Log::debug("PO #".$po->id." not Found or PO is not in 'IN-PROCESS' status!");
			//return back()->withError($exception->getMessage())->withInput();
			return back()->withError("PO#".$po->id." not Found or PO is not in IN-PROCESS status!")->withInput();
		}
		return redirect()->route('pos.show', $po->id)->with('success', 'Purchase Order status reset successfully');
	}
}
