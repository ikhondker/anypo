<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Workflow.php
* @brief		This file contains the implementation of the Workflow
* @path			\app\Helpers\Tenant
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Helpers\Tenant;

use Request;

use App\Models\User;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Workflow\Hierarchy;
use App\Models\Tenant\Workflow\Hierarchyl;
use App\Models\Tenant\Workflow\Wf;
use App\Models\Tenant\Workflow\Wfl;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\WflActionEnum;
use App\Enum\Tenant\AuthStatusEnum;
use Exception;

use DB;
use Notification;


class Workflow
{
	public static function submitWf($entity, $article_id)
	{

		// don't need exception as can not save dept with hierarchy
		switch ($entity) {
			case EntityEnum::PR->value:
				// try catch exception handing
				$pr = Pr::where('id', $article_id)->first();
				$requestor_id = $pr->requestor_id;
				//$dept_id = $pr->dept_id;
				$dept = Dept::where('id', $pr->dept_id)->first();
				try {
					$hierarchy = Hierarchy::where('id', $dept->pr_hierarchy_id)->firstOrFail();
					$hierarchy_id =	$hierarchy->id;
				} catch (ModelNotFoundException $exception) {
				 	$hierarchy_id = 0;
				 	Log::error("Workflow.submitWf Hierarchy not Found for entity = ".$entity." article_id = ".$article_id." dept_id = ".$dept->id);
				} catch (Exception $e) {
					$hierarchy_id = 0;
				 	Log::error("Workflow.submitWf Unknown Error for entity = ".$entity." article_id = ".$article_id." dept_id = ".$dept->id);
				}
				break;
			case EntityEnum::PO->value:
				// try catch exception handing
				$po = Po::where('id', $article_id)->first();
				$requestor_id = $po->buyer_id;
				//$dept_id = $pr->dept_id;
				$dept = Dept::where('id', $po->dept_id)->first();
				try {
					$hierarchy = Hierarchy::where('id', $dept->po_hierarchy_id)->firstOrFail();
					$hierarchy_id =	$hierarchy->id;
				} catch (ModelNotFoundException $exception) {
					$hierarchy_id = 0;
					Log::error("Workflow.submitWf Hierarchy not Found for entity = ".$entity." article_id = ".$article_id." dept_id = ".$dept->id);
				} catch (Exception $e) {
					$hierarchy_id = 0;
					Log::error("Workflow.submitWf Unknown Error for entity = ".$entity." article_id = ".$article_id." dept_id = ".$dept->id);
				}
				break;
			default:
				Log::debug("Helpers.Workflow.submitWf Other Entity!");
		}

		// create WF header and child row
		if ($hierarchy_id <> 0) {

			// create WF header row
			$wf					= new Wf();
			$wf->entity			= $entity;
			$wf->article_id		= $article_id;
			$wf->hierarchy_id	= $hierarchy_id;
			$wf->auth_status 	= AuthStatusEnum::INPROCESS->value;

			$wf->save();
			$wf_id				= $wf->id;

			Log::debug("Helpers.Workflow.submitWf new workflow created with wf_id = ".$wf->id);

			// Insert submission row first
			DB::INSERT("
				INSERT INTO wfls(wf_id, performer_id, action_date, action, notes)
				SELECT ".$wf_id.",'".$requestor_id."' ,now(),'". WflActionEnum::SUBMITTED->value ."','Submitted for Review and Approval';
			");

			DB::INSERT("
					INSERT INTO wfls(wf_id, performer_id)
					SELECT ".$wf_id.",approver_id
					FROM hierarchyls WHERE hid= ".$hierarchy_id.";
				");

			Log::debug("Helpers.Workflow.submitWf First rows inserted into wfl as per hierarchy_id = ".$hierarchy_id);

			// mark first approver as due
			// find first approver and make him in wfls as due
			$hierarchyl = Hierarchyl::where('hid', $wf->hierarchy_id)->orderBy('id', 'ASC')->firstOrFail();
			Log::debug("Helpers.Workflow.submitWf First Approver approver_id = ".$hierarchyl->approver_id);

			// find from wfls and change status
			$wfl = Wfl::where('wf_id',$wf->id)->where('performer_id', $hierarchyl->approver_id)->orderBy('id', 'ASC')->firstOrFail();
			Log::debug("Helpers.Workflow.submitWf found first approver in wlf for wfl_id = ".$wfl->id);
			Log::debug("Helpers.Workflow.submitWf change status as DUE for wfl_id = ".$wfl->id);

			$wfl->fill(['action' => WflActionEnum::DUE->value]);
			$wfl->update();
		} else {
			$wf_id = 0;
		}

		return $wf_id;
	}

	// check if current logged-in user can approve current document
	public static function allowApprove($wf_id)
	{
		Log::debug('Helpers.Tenant.Workflow.allowApprove checking if workflow wf_id = '.$wf_id.' is pending with current user_id = '.auth()->user()->id);
		try {
			$wfl = Wfl::where('wf_id', $wf_id)->where('action', WflActionEnum::DUE->value)->where('performer_id', auth()->user()->id)->firstOrFail();
			Log::debug('Helpers.Tenant.Workflow.allowApprove Yes, found row pending with current user wfl_id = '.$wfl->id);
			return true;
		} catch (ModelNotFoundException $exception) {
			Log::debug('Helpers.Tenant.Workflow.allowApprove No, not pending with current user wf_id = '.$wf_id);
			return false;
		}
	}

	// Check if any more approver exists who need to approve document
	// from where it is called? PoController.submit, PrController.submit, WflController.update WflController.moveToNext
	public static function setNextApproverDue($wf_id)
	{
		Log::debug('Helpers.Workflow.setNextApproverDue finding next_approver for wf_id = '.$wf_id);
		try {
			// mark as due for next approver
			$wfl = Wfl::with('wf')->where('wf_id', $wf_id)->where('action', WflActionEnum::PENDING->value)->firstOrFail();
			$wfl->action = WflActionEnum::DUE->value;
			$wfl->update();

			//Log::debug('Helpers.Workflow.setNextApproverDue wfl_id = '.$wfl->id);
			//Log::debug('Helpers.Workflow.setNextApproverDue wf->action = '.$wfl->action->value);
			Log::debug('Helpers.Workflow.setNextApproverDue wfl->performer_id = '.$wfl->performer_id);
			return $wfl->performer_id;
		} catch (ModelNotFoundException $exception) {
			Log::debug('Helpers.Workflow.setNextApproverDue no next performer_id found. This is last approver. Returning zero.');
			return '';
		}
	}

	public static function getDueApproverId($wf_id)
	{
		Log::debug('Helpers.Workflow.getDueApproverId finding next_approver for wf_id = '.$wf_id);
		try {
			// get next approver
			$wfl = Wfl::where('wf_id', $wf_id)->where('action', WflActionEnum::DUE->value)->firstOrFail();
			//Log::debug('Helpers.Workflow.getDueApproverId wfl_id = '.$wfl->id);
			//Log::debug('Helpers.Workflow.getDueApproverId wf->action = '.$wfl->action->value);
			Log::debug('Helpers.Workflow.getDueApproverId wfl->performer_id = '.$wfl->performer_id);
			return $wfl->performer_id;
		} catch (ModelNotFoundException $exception) {
			Log::debug('Helpers.Workflow.getDueApproverId no next performer_id found. This is last approver. Returning null.');
			return '';
		}
	}

	// Check if any more approver exists who need to approve document
	// from where it is called? PoController.submit, PrController.submit, WflController.update WflController.moveToNext
	public static function getNextApproverId($wf_id)
	{
		Log::debug('Helpers.Tenant.Workflow.getNextApproverId finding next_approver for wf_id = '.$wf_id);
		try {
			// get next approver
			$wfl = Wfl::where('wf_id', $wf_id)->where('action', WflActionEnum::PENDING->value)->firstOrFail();
			//Log::debug('Helpers.Workflow.getNextApproverId wfl_id = '.$wfl->id);
			//Log::debug('Helpers.Workflow.getNextApproverId wf->action = '.$wfl->action->value);
			Log::debug('Helpers.Tenant.Workflow.getNextApproverId wfl->performer_id = '.$wfl->performer_id);
			return $wfl->performer_id;
		} catch (ModelNotFoundException $exception) {
			Log::debug('Helpers.Tenant.Workflow.getNextApproverId no next performer_id found. This is last approver. Returning null.');
			return '';
		}
	}
}
