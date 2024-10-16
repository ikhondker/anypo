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

use App\Models\Tenant\Attachment;

# Enums
use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\AuthStatusEnum;
use App\Enum\Tenant\InvoiceStatusEnum;

use Illuminate\Support\Facades\Log;

class ListAllByArticle extends Component
{
	//public $entity;
	//public $article_id;
	public $delete;
	public $attachments;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $entity, public string $articleId)
	{
		$this->attachments = Attachment::with('owner')->where('entity', $this->entity)->where('article_id', $this->articleId)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.attachment.list-all-by-article');
	}
}
