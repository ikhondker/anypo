<?php

namespace App\View\Components\Tenant\Attachment;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

# use App\Models\Tenant\Manage\Entity;
use App\Models\Tenant\Lookup\Project;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Invoice;

use App\Models\Tenant\Admin\Attachment;

# Enums
use App\Enum\EntityEnum;
use App\Enum\AuthStatusEnum;
use App\Enum\InvoiceStatusEnum;

use Illuminate\Support\Facades\Log;

class ListAllByArticle extends Component
{
	public $entity;
	public $aid;
	public $delete;
	public $attachments;

	/**
	 * Create a new component instance.
	 */
	public function __construct($entity, $aid)
	{
		$this->entity		= $entity;
		$this->aid			= $aid;
		$this->delete		= false;

		switch ($this->entity) {

			case EntityEnum::BUDGET->value:
				$budget = Budget::where('id', $this->aid)->get()->firstOrFail();
				if (!$budget->closed) {
					$this->delete		= true;
				} 
				break;
			case EntityEnum::DEPTBUDGET->value:
				$deptBudget = DeptBudget::where('id', $this->aid)->get()->firstOrFail();
				if (!$deptBudget->closed) {
					$this->delete		= true;
				} 
				break;
			case EntityEnum::PR->value:
				$pr = Pr::where('id', $this->aid)->get()->firstOrFail();
				if ($pr->auth_status == AuthStatusEnum::DRAFT->value) {
					$this->delete		= true;
				}
				break;
			case EntityEnum::PO->value:
				$po = PO::where('id', $this->aid)->get()->firstOrFail();
				if ($po->auth_status == AuthStatusEnum::DRAFT->value) {
					$this->delete		= true;
				}
				break;
			case EntityEnum::PROJECT->value:
				$project = Project::where('id', $this->aid)->get()->firstOrFail();
				if (!$project->closed) {
					$this->delete		= true;
				} 
				break;
			case EntityEnum::RECEIPT->value:
				$this->delete			= false;
				break;
			case EntityEnum::INVOICE->value:
				$invoice = Invoice::where('id', $this->aid)->get()->firstOrFail();
				if ($invoice->status == InvoiceStatusEnum::DRAFT->value) {
					$this->delete		= true;
				}
				break;
			case EntityEnum::PAYMENT->value:
				$this->delete			= false;
				break;
			default:
				Log::errror('tenenat.ListAllByArticle Invalid entity=' . $this->entity);
				return redirect()->route('attachments.index');
				// Success
		}

		$this->attachments = Attachment::with('owner')->where('entity', $this->entity)->where('article_id', $this->aid)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.attachment.list-all-by-article');
	}
}
