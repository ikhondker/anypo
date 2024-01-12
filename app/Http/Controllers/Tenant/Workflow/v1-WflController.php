<?php

namespace App\Http\Controllers\Tenant\Workflow;
use App\Http\Controllers\Controller;


use App\Http\Requests\Tenant\Workflow\StoreWflRequest;
use App\Http\Requests\Tenant\Workflow\UpdateWflRequest;

# Models
use App\Models\Tenant\Workflow\Wf;
use App\Models\Tenant\Workflow\Wfl;

use App\Models\Tenant\Pr;

use App\Models\User;
# Enums
use App\Enum\AuthStatusEnum;
use App\Enum\WfStatusEnum;
use App\Enum\WflActionEnum;
# Helpers
use App\Helpers\CheckBudget;
use App\Helpers\EventLog;
use App\Helpers\Workflow;
# Notifications
use Notification;
use App\Notifications\Tenant\PrActions;
# Mails
# Packages
# Seeded
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

# Exceptions
# Events

class WflController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
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
	public function store(StoreWflRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Wfl $wfl)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Wfl $wfl)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateWflRequest $request, Wfl $wfl)
	{
		//$this->authorize('update',$wfl);
		$request->merge(['action_date' => date('Y-m-d H:i:s')]);
		//$request->validate();
		$request->validate([

		]);
		

		$wfl->update($request->all());
		
		// get the wf and article details
		$wf = Wf::where('id', $wfl->wf_id)->first();
		switch($wf->entity) {
			case('PR'):
				$pr = Pr::where('id', $wf->article_id)->first();
			case('PO'):
				$po = Po::where('id', $wf->article_id)->first();
				break;
			default:
				Log::debug("Error!. Invalid Entity in wfl.update rejected");
		}

		$booEndWf = false;
		$auth_status = '';
		

		// First check if approved or rejected
		// and map wfl.action to wf.auth_status, pr.auth_status, po.auth_status
		$next_approver_id = 0;

		switch($request->input('action')) {
			case(WflActionEnum::APPROVED->value):
				$auth_status = AuthStatusEnum::APPROVED->value;
				$next_approver_id = Workflow::getNextApproverId($wfl->wf_id);
				
				if ($next_approver_id <> 0) {
					$booEndWf = false;

					Log::debug("next approve found! = ");
					// do nothing just find and notify next approver
					// send approval mail  to next approver TODO
					// TODO Workflow::notifyApprover($wfl->wf_id);
				} else {
					// document is approved
					Log::debug("This was the top approver ");
					$booEndWf = true;
					// send approved mail  TODO
				}
				break;
			case(WflActionEnum::REJECTED->value):
				$auth_status = AuthStatusEnum::REJECTED->value;
				$booEndWf = true;

				// update related entity status
				switch($wf->entity) {
					case('PR'):
						//  reverse Booking
						$retcode = CheckBudget::reverseBookingPr($pr->id);
						Log::debug("retcode = ".$retcode);
						// send rejection mail to requestor
						$action = WflActionEnum::REJECTED->value;
						$actionURL = route('prs.show', $pr->id);
						$requestor = User::where('id', $pr->requestor_id)->first();
						$requestor->notify(new PrActions($requestor, $pr, $action, $actionURL));
						break;
					case('PO'):
						break;
					default:
						Log::debug("Error!. Invalid Entity in wfl.update rejected");
				}

				
				break;
			default:
				// TODO
				// Exit from here?
				Log::debug("Error! Invalid action in wfl.update");
		}

		// this is the last step, update wf and pr/po else notify next approver
		if ($booEndWf) {

			// update wf record
			///$wf = Wf::where('id', $wfl->wf_id)->first();
			$wf->auth_status	= $auth_status;
			$wf->wf_status		= WfStatusEnum::CLOSED->value;
			$wf->save();

			// update related entity status
			switch($wf->entity) {
				case('PR'):
					$pr->auth_status	= $auth_status;
					$pr->auth_date		= date('Y-m-d H:i:s');
					$pr->auth_userid	= auth()->user()->id;
					$pr->save();

					// confirm budget
					$retcode = CheckBudget::confirmBudgetPr($pr->id);
					Log::debug("retcode = ".$retcode);

					// send approval mail to requestor
					$action = WflActionEnum::APPROVED->value;
					$actionURL = route('prs.show', $pr->id);
					$requestor = User::where('id', $pr->requestor_id)->first();
					$requestor->notify(new PrActions($requestor, $pr, $action, $actionURL));

					break;
				case('PO '):
					$po->auth_status	= $auth_status;
					$po->auth_date		= date('Y-m-d H:i:s');
					$po->auth_userid	= auth()->user()->id;
					$po->save();
					break;
				default:
					Log::debug("Error!. Invalid Entity in wfl.update");
			}
		} else {
			// next approver exists	
			Log::debug("notifying next approver ");
			switch($wf->entity) {
				case('PR'):
					// Send notification to Next Approver
					$action = WflActionEnum::PENDING->value;
					$actionURL = route('prs.show', $pr->id);
					Log::debug("next_approver_id = ". $next_approver_id);
					if ($next_approver_id <> 0) {
						$approver = User::where('id', $next_approver_id)->first();
						$approver->notify(new PrActions($approver, $pr, $action, $actionURL));
					} else {
						Log::debug("next_approver_id not found!");
					}
					break;
				case('PO '):
					break;
				default:
					Log::debug("Error!. Invalid Entity in wfl.update");
			}
		}

		// // next approver exists
		// if (\App\Helpers\Workflow::getApprover( $wfl->wf_id)){
		//		do nothing just find and notify next approver
		//		Workflow::notifyApprover($wfl->wf_id);
		// } else {
		//	this is the last step
		// }
		//return redirect()->route('dashboards.index')->with('success','Done');

		//LogEvent('wfl',$wfl->id,'update','action',$wfl->action_code);
		//return redirect()->route('dashboards.index')->with('success','Wf Details updated successfully');
		//return back()->withMessage('Workflow updated.');
		return redirect()->route('prs.index')->with('success', 'Workflow has been updated accordingly.');

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Wfl $wfl)
	{
		//
	}
}
