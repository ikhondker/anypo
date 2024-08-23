<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Access.php
* @brief		This file contains the implementation of the Bo
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

namespace App\Helpers\Tenant;

# 1. Models
use App\Models\Tenant\Manage\Entity;
use App\Models\Tenant\Lookup\Project;

use App\Models\Tenant\Attachment;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Invoice;
# 2. Enums
use App\Enum\EntityEnum;
use App\Enum\AuthStatusEnum;
use App\Enum\InvoiceStatusEnum;
# 3. Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;


use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Access
{

	public static function isAttachmentEditable($attId)
	{
		
		$attachment = Attachment::where('id', $attId)->get()->firstOrFail();

		// TODO fine tuning access edit and delete
		// Restriction
		// document to be draft or non closed
		// owner and admin can can only edit if editable
		// also check ListAllByArticle Component

		$editable		= false;

		switch ($attachment->entity) {

			case EntityEnum::BUDGET->value:
				$budget = Budget::where('id', $attachment->article_id)->get()->firstOrFail();
				if (!$budget->closed)  {
					if (auth()->user()->id == $attachment->owner_id){
						$editable		= true;
					}	
				} 
				break;
			case EntityEnum::DEPTBUDGET->value:
				$deptBudget = DeptBudget::where('id', $attachment->article_id)->get()->firstOrFail();
				if (!$deptBudget->closed) {
					if (auth()->user()->id == $attachment->owner_id){
						$editable		= true;
					}
				} 
				break;
			case EntityEnum::PR->value:
				$pr = Pr::where('id', $attachment->article_id)->get()->firstOrFail();
				if ($pr->auth_status == AuthStatusEnum::DRAFT->value) {
					// only owner can edit
					if (auth()->user()->id == $attachment->owner_id){
						$editable		= true;
					}
				}
				break;
			case EntityEnum::PO->value:
				$po = PO::where('id', $attachment->article_id)->get()->firstOrFail();
				if ($po->auth_status == AuthStatusEnum::DRAFT->value) {
					// only owner can edit
					if (auth()->user()->id == $attachment->owner_id){
						$editable		= true;
					}
				}
				break;
			case EntityEnum::PROJECT->value:
				$project = Project::where('id', $attachment->article_id)->get()->firstOrFail();
				if (!$project->closed) {
					if (auth()->user()->id == $attachment->owner_id){
						$editable		= true;
					}
				} 
				break;
			case EntityEnum::RECEIPT->value:
				$editable			= false;
				break;
			case EntityEnum::INVOICE->value:
				$invoice = Invoice::where('id', $attachment->article_id)->get()->firstOrFail();
				if ($invoice->status == InvoiceStatusEnum::DRAFT->value) {
					if (auth()->user()->id == $attachment->owner_id){
						$editable		= true;
					}
				}
				break;
			case EntityEnum::PAYMENT->value:
				$editable			= false;
				break;
			default:
				$editable			= false;
			}
			return $editable;
	}
}
