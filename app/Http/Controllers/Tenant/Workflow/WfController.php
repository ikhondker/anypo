<?php

namespace App\Http\Controllers\Tenant\Workflow;
use App\Http\Controllers\Controller;


use App\Http\Requests\Tenant\Workflow\StoreWfRequest;
use App\Http\Requests\Tenant\Workflow\UpdateWfRequest;

# Models
use App\Models\Tenant\Workflow\Wf;
use App\Models\Tenant\Workflow\Wfl;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
# Enums
use App\Enum\AuthStatusEnum;
use App\Enum\WfStatusEnum;
use App\Enum\WflActionEnum;
# Helpers
use App\Helpers\EventLog;
use App\Helpers\Export;
use App\Helpers\CheckBudget;
# Notifications
# Mails
# Packages
# Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

# Exceptions
# Events

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
		$wfs = $wfs->orderBy('id', 'DESC')->paginate(10);
		return view('tenant.workflow.wfs.index', compact('wfs'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->authorize('create', Wf::class);

		return view('tenant.workflow.wfs.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreWfRequest $request)
	{
		$this->authorize('create', Wf::class);

		$wf = Wf::create($request->all());
		// Write to Log
		EventLog::event('wf', $wf->id, 'create');

		return redirect()->route('wfs.index')->with('success', 'Wf created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Wf $wf)
	{
		$this->authorize('view', $wf);

		$wfls = Wfl::where('wf_id', $wf->id)->orderBy('id', 'asc')->get();
		return view('tenant.workflow.wfs.show', compact('wf', 'wfls'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Wf $wf)
	{
		abort(403);
		//$this->authorize('update',$wf);
		//return view('wfs.edit',compact('wf'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateWfRequest $request, Wf $wf)
	{
		abort(403);
		$this->authorize('update', $wf);

		//$request->validate();
		$request->validate([

		]);
		$wf->update($request->all());

		// Write to Log
		EventLog::event('wf', $wf->id, 'update', 'name', $wf->name);
		return redirect()->route('wfs.index')->with('success', 'Wf updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Wf $wf)
	{
		$this->authorize('delete', $wf);

		$wf->fill(['enable' => !$wf->enable]);
		$wf->update();

		// Write to Log
		EventLog::event('wf', $wf->id, 'status', 'enable', $wf->enable);

		return redirect()->route('wfs.index')->with('success', 'Wf status Updated successfully');
	}

	public function export()
	{
		$data = DB::select("SELECT wf.id, wf.entity, wf.article_id, wf.hierarchy_id, wf.wf_status, wf.auth_status, wf.auth_userid, wf.auth_date,
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
	 * Show the form for creating a new resource.
	 */
	public function getResetPrNum()
	{
		$this->authorize('reset',Wf::class);
		return view('tenant.workflow.wfs.reset-pr');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function wfResetPr(StoreWfRequest $request)
	{
		$this->authorize('reset',Wf::class);
		// $this->authorize('resetpr',Wf::class);
		// check if pr status only in-process

		// update PR header
		// $pr	= Pr::where('id', $request->input('pr_id'))->firstOrFail();
		// if ($pr->auth_status->value <> AuthStatusEnum::INPROCESS->value){
		//		return back()->withError("PR#".$request->input('pr_id')." is not in IN-PROCESS status!")->withInput();
		// }

		try {
			$pr = Pr::where('id', $request->input('pr_id'))->where('auth_status', AuthStatusEnum::INPROCESS->value)->firstOrFail();

			// mark wf as RESET
			try {
				$wf = Wf::findOrFail($pr->wf_id);
				$wf->wf_status = WfStatusEnum::RESET->value;
				$wf->update();
			} catch (ModelNotFoundException $exception) {
				// Error handling code
				Log::debug("WF # ".$pr->wf_id." not Found! Check!");
			}

			// reverse Booking
			$retcode = CheckBudget::reverseBookingPr($pr->id);
			Log::debug("retcode = ".$retcode);

			//reset pr wf_id and status
			$pr->wf_id = 0;
			$pr->auth_status = AuthStatusEnum::DRAFT->value;
			$pr->submission_date = null;
			$pr->update();

			EventLog::event('pr', $pr->id, 'reset');	// Write to Log
		} catch (ModelNotFoundException $exception) {
			// Error handling code
			Log::debug("PR#".$request->input('pr_id')." not Found or PR is not in 'IN-PROCESS' status!");
			//return back()->withError($exception->getMessage())->withInput();
			return back()->withError("PR#".$request->input('pr_id')." not Found or PR is not in IN-PROCESS status!")->withInput();
		}
		return redirect()->route('prs.show', $request->input('pr_id'))->with('success', 'Requisition status reset successfully');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function resetpo()
	{
		//$this->authorize('resetpo',Wf::class);
		return view('tenant.workflow.wfs.resetpo');
	}
}
