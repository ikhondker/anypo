<?php

namespace App\Http\Controllers\Tenant\Workflow;
use App\Http\Controllers\Controller;


use App\Http\Requests\Tenant\Workflow\StoreWflRequest;
use App\Http\Requests\Tenant\Workflow\UpdateWflRequest;

# Models
use App\Models\Tenant\Workflow\Wf;
use App\Models\Tenant\Workflow\Wfl;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;

use App\Models\User;
# Enums
use App\Enum\AuthStatusEnum;
use App\Enum\WfStatusEnum;
use App\Enum\WflActionEnum;
use App\Enum\EntityEnum;
use App\Enum\EventEnum;

# Helpers
use App\Helpers\PrBudget;
use App\Helpers\PoBudget;
use App\Helpers\EventLog;
use App\Helpers\Workflow;
# Notifications
use Notification;
use App\Notifications\Tenant\PrActions;
use App\Notifications\Tenant\PoActions;
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
		abort(403);
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
	public function store(StoreWflRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Wfl $wfl)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Wfl $wfl)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateWflRequest $request, Wfl $wfl)
	{
		//$this->authorize('update',$wfl);
		$request->merge(['action_date' => date('Y-m-d H:i:s')]);
		$wfl->update($request->all());
		
		// get the wf and article details
		$wf = Wf::where('id', $wfl->wf_id)->first();
		switch($request->input('action')) {
			case(WflActionEnum::REJECTED->value):
				self::rejected($wf);
				break;
			case(WflActionEnum::APPROVED->value):
				$next_approver_id = Workflow::getNextApproverId($wfl->wf_id);
				if ($next_approver_id <> 0) {
					self::moveToNext($wf);
				} else {
					self::approved($wf); 
				}
				break;
			default:
				Log::warning("Error! Invalid action in wfl.update" .$request->input('action'));
		}

		switch($wf->entity) {
			case(EntityEnum::PR->value):
				return redirect()->route('prs.show',$wf->article_id)->with('success', 'Workflow has been updated accordingly.');
				break;
			case(EntityEnum::PO->value):
				return redirect()->route('pos.show',$wf->article_id)->with('success', 'Workflow has been updated accordingly.');
				break;
			default:
				return redirect()->route('home')->with('success', 'Workflow has been updated accordingly.');
		}

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Wfl $wfl)
	{
		//
	}

	public function rejected(Wf $wf)
	{

		// update wf record
		$wf->auth_status	= AuthStatusEnum::REJECTED->value;
		$wf->wf_status		= WfStatusEnum::CLOSED->value;
		$wf->save();

		// update related entity+article status 
		switch($wf->entity) {
			case('PR'):
				//  reverse Booking
				$pr = Pr::where('id', $wf->article_id)->first();
				$retcode = PrBudget::prBudgetBookReverse(EventEnum::REJECT->value,$pr->id);
				Log::debug("retcode = ".$retcode);

				$pr->auth_status	= AuthStatusEnum::REJECTED->value;
				$pr->auth_date		= date('Y-m-d H:i:s');
				$pr->auth_user_id	= auth()->user()->id;
				$pr->save();

				// send rejection mail to requestor
				$action = WflActionEnum::REJECTED->value;
				$actionURL = route('prs.show', $pr->id);
				$requestor = User::where('id', $pr->requestor_id)->first();
				$requestor->notify(new PrActions($requestor, $pr, $action, $actionURL));
				break;
			case('PO'):
				//  reverse Booking
				$po = Po::where('id', $wf->article_id)->first();
				$retcode = PoBudget::poBudgetBookReverse(EventEnum::REJECT->value,$po->id);
				Log::debug("retcode = ".$retcode);

				$po->auth_status	= AuthStatusEnum::REJECTED->value;
				$po->auth_date		= date('Y-m-d H:i:s');
				$po->auth_user_id	= auth()->user()->id;
				$po->save();

				// send rejection mail to requestor
				$action = WflActionEnum::REJECTED->value;
				$actionURL = route('pos.show', $po->id);
				$requestor = User::where('id', $po->requestor_id)->first();
				$requestor->notify(new PoActions($requestor, $po, $action, $actionURL));
				break;
			default:
				Log::debug("Error!. Invalid Entity in wfl.rejected".$wf->entity);
		}
		return true;
	}

	public function approved(Wf $wf)
	{
		// update wf record
		$wf->auth_status	= AuthStatusEnum::APPROVED->value;
		$wf->wf_status		= WfStatusEnum::CLOSED->value;
		$wf->save();

		// send approved mail  TODO
		// update related entity status
		switch($wf->entity) {
			case('PR'):
				$pr = Pr::where('id', $wf->article_id)->first();
				$pr->auth_status	=  AuthStatusEnum::APPROVED->value;
				$pr->auth_date		= date('Y-m-d H:i:s');
				$pr->auth_user_id	= auth()->user()->id;
				$pr->save();

				// confirm budget
				$retcode = PrBudget::prBudgetApprove($pr->id);
				//Log::debug("retcode = ".$retcode);

				// send approval mail to requestor
				$action = WflActionEnum::APPROVED->value;
				$actionURL = route('prs.show', $pr->id);
				$requestor = User::where('id', $pr->requestor_id)->first();
				$requestor->notify(new PrActions($requestor, $pr, $action, $actionURL));
				break;
			case('PO'):

				$po = Po::where('id', $wf->article_id)->first();
				$po->auth_status	=  AuthStatusEnum::APPROVED->value;
				$po->auth_date		= date('Y-m-d H:i:s');
				$po->auth_user_id	= auth()->user()->id;
				$po->save();

				// confirm budget
				$retcode = PoBudget::poBudgetApprove($po->id);
				//Log::debug("retcode = ".$retcode);

				// send approval mail to requestor
				$action = WflActionEnum::APPROVED->value;
				$actionURL = route('pos.show', $po->id);
				$requestor = User::where('id', $po->requestor_id)->first();
				$requestor->notify(new PoActions($requestor, $po, $action, $actionURL));

				break;
			default:
				Log::debug("Error!. Invalid Entity in wfl.approved ".$wf->entity);
		}

		return true;
	}
	public function moveToNext(Wf $wf)
	{
		// do nothing just find and notify next approver
		// send approval mail  to next approver TODO
		// TODO Workflow::notifyApprover($wfl->wf_id);

		// next approver exists	
		//Log::debug("notifying next approver ");
		$auth_status = AuthStatusEnum::APPROVED->value;
		$next_approver_id = Workflow::getNextApproverId($wf->id);
		Log::debug("wfl.moveToNext next_approver_id = ". $next_approver_id);
		if ($next_approver_id == 0) {
			Log::debug("wfl.moveToNext next_approver_id not found!");
			return false;
		} 

		switch($wf->entity) {
			case('PR'):
				// Send notification to Next Approver
				$action = WflActionEnum::PENDING->value;
				$pr = Pr::where('id', $wf->article_id)->first();
				$actionURL = route('prs.show', $pr->id);
				$approver = User::where('id', $next_approver_id)->first();
				$approver->notify(new PrActions($approver, $pr, $action, $actionURL));
				break;
			case('PO '):
				// Send notification to Next Approver
				$action = WflActionEnum::PENDING->value;
				$po = Po::where('id', $wf->article_id)->first();
				$actionURL = route('pos.show', $po->id);
				$approver = User::where('id', $next_approver_id)->first();
				$approver->notify(new PoActions($approver, $po, $action, $actionURL));

				break;
			default:
				Log::debug("Error!. Invalid Entity in wfl.moveToNext");
		}

		return true;
	}

}
