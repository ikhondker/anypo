<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			WflController.php
* @brief		This file contains the implementation of the WflController
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

use App\Models\Tenant\Workflow\Wfl;
use App\Http\Requests\Tenant\Workflow\StoreWflRequest;
use App\Http\Requests\Tenant\Workflow\UpdateWflRequest;

# 1. Models
use App\Models\Tenant\Workflow\Wf;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\User;
# 2. Enums
use App\Enum\AuthStatusEnum;
use App\Enum\WfStatusEnum;
use App\Enum\WflActionEnum;
use App\Enum\EntityEnum;
use App\Enum\EventEnum;
# 3. Helpers
use App\Helpers\Tenant\PrBudget;
use App\Helpers\Tenant\PoBudget;
use App\Helpers\Tenant\Workflow;
use App\Helpers\Export;
use App\Helpers\EventLog;
# 4. Notifications
use Notification;
use App\Notifications\Tenant\PrActions;
use App\Notifications\Tenant\PoActions;
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
# 13. FUTURE

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
		$this->authorize('update',$wfl);
		Log::debug("tenant.wfl.update Processing wf_id = " .$wfl->wf_id);
		Log::debug("tenant.wfl.update Processing wfl_id = " .$wfl->id);
		Log::debug("tenant.wfl.update Processing action = " .$request->input('action'));

		$request->merge(['action_date' => date('Y-m-d H:i:s')]);
		// update wfl row
		$wfl->update($request->all());
		Log::debug("tenant.wfl.update After updating current action=" .$wfl->action->value);

		// get the wf and article details
		$wf = Wf::where('id', $wfl->wf_id)->first();
		switch($request->input('action')) {
			case(WflActionEnum::REJECTED->value):
				self::rejected($wf);
				break;
			case(WflActionEnum::APPROVED->value):
				Log::debug('tenant.wfl.update Checking if next_approver_id exists.');
				$next_approver_id = Workflow::getNextApproverId($wfl->wf_id);
				if ($next_approver_id <> '') {
					Log::debug('tenant.wfl.update next_approver exists with user_i = '.$next_approver_id);
					Log::debug('tenant.wfl.update Forward Wf. Executing tenant.wfl.moveToNext.');
					self::moveToNext($wf);
				} else {
					Log::debug('tenant.wfl.update Wf has been approved. Executing tenant.wfl.approved.');
					self::approved($wf);
				}
				break;
			default:
			Log::warning(tenant('id').' tenant.wfl.update Error! Invalid action = ' .$request->input('action'));
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
		abort(403);
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
				// reverse Booking
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
				// reverse Booking
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

		// send approved mail
		// update related entity status
		switch($wf->entity) {
			case('PR'):
				$pr = Pr::where('id', $wf->article_id)->first();
				$pr->auth_status	= AuthStatusEnum::APPROVED->value;
				$pr->auth_date		= date('Y-m-d H:i:s');
				$pr->auth_user_id	= auth()->user()->id;
				$pr->save();

				// confirm budget
				$retcode = PrBudget::prBudgetApprove($pr->id);
				//Log::debug("retcode = ".$retcode);

				// send approval mail to requestor
				$action	 			= WflActionEnum::APPROVED->value;
				$actionURL  		= route('prs.show', $pr->id);
				$requestor			= User::where('id', $pr->requestor_id)->first();
				$requestor->notify(new PrActions($requestor, $pr, $action, $actionURL));
				break;
			case('PO'):
				$po = Po::where('id', $wf->article_id)->first();
				$po->auth_status	= AuthStatusEnum::APPROVED->value;
				$po->auth_date		= date('Y-m-d H:i:s');
				$po->auth_user_id	= auth()->user()->id;
				$po->save();

				// confirm budget
				$retcode = PoBudget::poBudgetApprove($po->id);
				//Log::debug("retcode = ".$retcode);

				// send approval mail to requestor
				$action 		= WflActionEnum::APPROVED->value;
				$actionURL 		= route('pos.show', $po->id);
				$requestor 		= User::where('id', $po->requestor_id)->first();
				$requestor->notify(new PoActions($requestor, $po, $action, $actionURL));

				break;
			default:
				Log::debug("Error!. Invalid Entity in wfl.approved ".$wf->entity);
		}

		return true;
	}
	public function moveToNext(Wf $wf)
	{
		Log::debug("tenant.wfl.moveToNext processing wf_id = ". $wf->id);
		//Log::debug("tenant.wfl.moveToNext processing entity = ". $wf->entity);
		// do nothing just find and notify next approver
		// send approval mail to next approver

		// get next approver exists
		//Log::debug("notifying next approver ");
		$auth_status = AuthStatusEnum::APPROVED->value;
		$next_approver_id = Workflow::setNextApproverDue($wf->id);
		Log::debug("tenant.wfl.moveToNext next_approver_id = ". $next_approver_id);
		if ($next_approver_id == '') {
			Log::debug("tenant.wfl.moveToNext next_approver_id not found!");
			return false;
		}

		switch($wf->entity) {
			case('PR'):
				// Send notification to Next Approver
				$action 	= WflActionEnum::PENDING->value;
				$pr 		= Pr::where('id', $wf->article_id)->first();
				$actionURL 	= route('prs.show', $pr->id);
				$approver 	= User::where('id', $next_approver_id)->first();
				$approver->notify(new PrActions($approver, $pr, $action, $actionURL));
				break;
			case('PO'):
				// Send notification to Next Approver
				$action 	= WflActionEnum::PENDING->value;
				$po 		= Po::where('id', $wf->article_id)->first();
				$actionURL 	= route('pos.show', $po->id);
				$approver 	= User::where('id', $next_approver_id)->first();
				$approver->notify(new PoActions($approver, $po, $action, $actionURL));
				break;
			default:
				Log::error(tenant('id'). 'tenant.wfl.moveToNext Invalid Entity = ' . $wf->entity);
		}

		return true;
	}

}
