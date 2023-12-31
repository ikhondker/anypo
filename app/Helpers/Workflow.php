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
#use App\Models\Tenant\Activity as LogActivityModel;

//use App\Models\Entity;
use App\Models\User;
use App\Models\Tenant\Pr;

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


use DB;
use Notification;

//use App\Notifications\TicketCreated;
//use App\Notifications\TicketUpdated;

class Workflow
{
	public static function submitWf($entity, $article_id)
	{

		// wf_key is not used
		//$entity = Entity::where('entity',$entity)->first();
		//$wf_key = $doc_type->wf_key;

		// get dept id of the emp
		//$emp = Emp::where('id',$emp_id)->first();
		//$dept_id = $emp->dept_id;

		switch ($entity) {
			case EntityEnum::PR->value:
				// TODO try catch exception handing
				$pr = Pr::where('id', $article_id)->first();
				$requestor_id = $pr->requestor_id;
				//$dept_id = $pr->dept_id;
				$dept = Dept::where('id', $pr->dept_id)->first();
				$hierarchy = Hierarchy::where('id', $dept->pr_hierarchy_id)->firstOrFail();
				$hierarchy_id =  $hierarchy->id;
				break;
			case EntityEnum::PO->value:
				break;
			default:
				Log::debug("Other Entity!");
		}

		// try {
		//  	// TODO must uncomment
		// 	// $hierarchy = Hierarchy::where('wf_key', $wf_key)->where('dept_id', $dept_id)->firstOrFail();
		// 	//$hierarchy = Hierarchy::where('entity', $entity)->firstOrFail();
		// 	$hierarchy_id =  $hierarchy->id;
		// 	Log::debug("Hierarchy =".$hierarchy_id);
		// } catch (ModelNotFoundException $exception) {
		// 	$hierarchy_id =  0;
		// 	Log::debug("Hierarchy not Found for entity=".$entity." article_id=".$article_id." emp_id=".$emp_id." dept_id=".$dept_id);
		//  	//return back()->withError($exception->getMessage())->withInput();
		// }

		// create WF header and child row
		if ($hierarchy_id <>  0) {

			// create WF header row
			$wf					= new Wf();
			//$wf->wf_key		= $wf_key;
			$wf->entity			= $entity;
			$wf->article_id		= $article_id;
			$wf->hierarchy_id	= $hierarchy_id;
			$wf->save();
			$wf_id				= $wf->id;

			// insert into wf child
			//Log::debug("Inserting into wfds");

			// Insert submission row first TODO
			DB::INSERT("INSERT INTO wfls(wf_id, performer_id, action_date, action, notes) 
			SELECT ".$wf_id.",".$requestor_id." ,now(),'". WflActionEnum::SUBMITTED->value ."','Submitted for Review and Approval';");

			DB::INSERT("INSERT INTO wfls(wf_id, performer_id) 
				SELECT ".$wf_id.",approver_id 
				FROM hierarchyls WHERE hid= ".$hierarchy_id.";");
		} else {
			$wf_id  = 0;
		}

		return $wf_id;
	}

	// check if curerent logged-in user can approve current document
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


	// Check if any more approver exists who need to approve document
	public static function xxgetApprover($wf_id)
	{
		try {
			// get next approver
			$wfd = Wfl::where('wf_id', $wf_id)->where('action', 'PENDING')->firstOrFail();
			return true;
		} catch (ModelNotFoundException $exception) {
			return false;
		}
	}


	public static function TBDnotifyApprover($wf_id)
	{

		// get wf record
		$wf = Wf::where('id', $wf_id)->first();

		// get entity record
		$entity = Entity::where('entity', $wf->entity)->first();

		// get notify article instance and emp_id
		$emp_id = 0;
		//@include('includes.wf-get-notify-article-instance');
		switch($wf->entity) {
			case('SALADV'):
				//$route='Advance';
				$advance = Advance::where('id', $wf->article_id)->first();
				$emp_id = $advance->emp_id;
				break;
			case('LEAVE'):
				$leave = Leave::where('id', $wf->article_id)->first();
				$emp_id = $leave->emp_id;
				break;
			case('PR'):
				$pr = Pr::where('id', $wf->article_id)->first();
				$emp_id = $pr->emp_id;
				break;
			case('PO '):
				$po = Po::where('id', $wf->article_id)->first();
				$emp_id = $po->emp_id;
				break;
			default:
				Log::debug("wf-get-notify-article-instance.blade.php = ERROR");
		}

		//Log::debug("After Include @notifyApprover! entity=".$entity->name." emp_id=".$emp_id);

		// find and notify first/next approver
		//$wfd = Wfd::with('wf')->where('wf_id', $wf->wf_id)->where('action', 'PENDING')->firstOrFail();
		//$wfd = Wfd::where('wf_id', $wf->wf_id)->where('action', 'PENDING')->firstOrFail();
		// TODO if not data in wfds show error
		$wfd = Wfd::where('wf_id', $wf_id)->where('action', 'PENDING')->firstOrFail();

		$owner = User::where('emp_id', $emp_id)->first();
		$approver = User::where('id', $wfd->performer_id)->first();

		$details = [
			'entity'		=> $wf->entity,
			'id'			=> $wf->article_id,
			'from'		=> $owner->name,
			'to'            => $approver->name,
			'subject'       => $entity->name. '#'. $wf->article_id.' need your approval.', // $advance->summary
			'greeting'      => 'Hi '.$approver->name.',',
			'body'          => $entity->name. '#'.$wf->article_id.' is submitted for your approval. Please review.',
			'thanks'        => 'Thank you for using '. config('app.name').'!',
			'actionText'    => 'View Document',
			//'actionURL'   => route('advances.show', ['advance' => $wf->article_id]),
			'actionURL'     => route($entity->route.'.show', $wf->article_id),
		];
		$approver->notify(new ApprovalNotification($details));

		//return true;
	}
}
