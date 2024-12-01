<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Dept;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Invoice;
# 2. Enums
use App\Enum\Tenant\EntityEnum;
//use Illuminate\Support\Facades\Log;

use Str;

class WhoWhen extends Component
{
	/**
	 * Create a new component instance.
	*/
    public $route;
	public $article;

	public function __construct(public string $model, public string $articleId)
	{

		$this->route = Str::lower(Str::plural(Str::snake($model, '-')));
		switch ($model) {
			case 'Dept':
				$this->article = Dept::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			// case EntityEnum::BUDGET->value:
			// 	$budget = Budget::where('id', $attachment->article_id)->get()->firstOrFail();
			// 	break;
			// case EntityEnum::DEPTBUDGET->value:
			// 	$deptBudget = DeptBudget::where('id', $attachment->article_id)->get()->firstOrFail();
			// 	break;
			// case EntityEnum::PR->value:
			// 	$pr = Pr::where('id', $attachment->article_id)->get()->firstOrFail();
			// 	break;
			// case EntityEnum::PO->value:
			// 	$po = PO::where('id', $attachment->article_id)->get()->firstOrFail();
			// 	break;
			// case EntityEnum::PROJECT->value:
			// 	$project = Project::where('id', $attachment->article_id)->get()->firstOrFail();
			// 	break;
			// case EntityEnum::RECEIPT->value:
			// 	$editable			= false;
			// 	break;
			// case EntityEnum::INVOICE->value:
			// 	$invoice = Invoice::where('id', $attachment->article_id)->get()->firstOrFail();
			// 	break;
			case EntityEnum::PAYMENT->value:
				$editable			= false;
				break;
			default:
				$editable			= false;
		}

	}

	// public function __construct(
	// 	public string $createdBy = '',
	// 	public string $createdAt  = '',
	// 	public string $updatedBy  = '',
	// 	public string $updatedAt  = ''
	// )
	// {

	// }

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.who-when');
	}
}
