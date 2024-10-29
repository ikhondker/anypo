<?php

namespace App\View\Components\Tenant\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;
use App\Enum\Tenant\EntityEnum;
use Illuminate\Support\Facades\Log;
class ArticleLink extends Component
{
	//public $entity;
	//public $id;
	public $route;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $entity, public string $id='1001')
	{
		//$this->entity	= $entity;
		//$this->id		= $id;
		//$this->route	= Str::plural(Str::snake($this->entity, '-'));

		// case EntityEnum::BUDGET->value:
		// case EntityEnum::PR->value:
		// case EntityEnum::PO->value:
		// case EntityEnum::PROJECT->value:
		// case EntityEnum::RECEIPT->value:
		// case EntityEnum::INVOICE->value:
		// case EntityEnum::PAYMENT->value:
		switch ($entity) {
			case EntityEnum::DEPTBUDGET->value:
				$this->route	= 'dept-budgets';
				break;
			default:
				$this->route	= Str::plural(Str::snake(Str::lower($this->entity), '-'));
		}


	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.show.article-link');
	}
}
