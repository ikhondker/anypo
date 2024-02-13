<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Workflow.php
* @brief		This file contains the implementation of the Workflow
* @path			\app\Helpers
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

namespace App\Helpers;

use Request;

use App\Models\User;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;

use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Workflow\Hierarchy;
use App\Models\Tenant\Workflow\Wf;
use App\Models\Tenant\Workflow\Wfl;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Enum\EntityEnum;
use App\Enum\WflActionEnum;
use App\Enum\AuthStatusEnum;

use DB;
use Notification;

class Workflow
{
	public static function submitWf($entity, $article_id)
	{

		// dont need exception as can not save dept with hierarchy
		switch ($entity) {
			case EntityEnum::PR->value:
				// TODO try catch exception handing
				$pr = Pr::where('id', $article_id)->first();
				$requestor_id = $pr->requestor_id;
				//$dept_id = $pr->dept_id;
				$dept = Dept::where('id', $pr->dept_id)->first();
				try {
					$hierarchy = Hierarchy::where('id', $dept->pr_hierarchy_id)->firstOrFail();
					$hierarchy_id =	$hierarchy->id;
				} catch (ModelNotFoundException $exception) {
				 	$hierarchy_id =  0;
				 	Log::debug("Hierarchy not Found for entity=".$entity." article_id=".$article_id." emp_id=".$emp_id." dept_id=".$dept_id);
				}
				break;
			case EntityEnum::PO->value:
				// TODO try catch exception handing
				$po = Po::where('id', $article_id)->first();
				$requestor_id = $po->buyer_id;
				//$dept_id = $pr->dept_id;
				$dept = Dept::where('id', $po->dept_id)->first();
				try {
					$hierarchy = Hierarchy::where('id', $dept->po_hierarchy_id)->firstOrFail();
					$hierarchy_id =	$hierarchy->id;
				} catch (ModelNotFoundException $exception) {
					$hierarchy_id =  0;
					Log::debug("Hierarchy not Found for entity=".$entity." article_id=".$article_id." emp_id=".$emp_id." dept_id=".$dept_id);
				}
				break;
			default:
				Log::debug("Workflow.submitWf Other Entity!");
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

			// Insert submission row first TODO
			DB::INSERT("INSERT INTO wfls(wf_id, performer_id, action_date, action, notes) 
			SELECT ".$wf_id.",".$requestor_id." ,now(),'". WflActionEnum::SUBMITTED->value ."','Submitted for Review and Approval';");

			DB::INSERT("INSERT INTO wfls(wf_id, performer_id) 
				SELECT ".$wf_id.",approver_id 
				FROM hierarchyls WHERE hid= ".$hierarchy_id.";");
		} else {
			$wf_id = 0;
		}

		return $wf_id;
	}

	// check if current logged-in user can approve current document
	public static function allowApprove($wf_id)
	{
		try {
			$wfd = Wfl::where('wf_id', $wf_id)->where('action', WflActionEnum::PENDING->value)->where('performer_id', Auth::user()->id)->firstOrFail();
			return true;
		} catch (ModelNotFoundException $exception) {
			return false;
		}
	}

	// Check if any more approver exists who need to approve document
	public static function getNextApproverId($wf_id)
	{
		try {
			// get next approver
			$wfl = Wfl::where('wf_id', $wf_id)->where('action', WflActionEnum::PENDING->value)->firstOrFail();
			return $wfl->performer_id;
		} catch (ModelNotFoundException $exception) {
			return 0;
		}
	}
}
