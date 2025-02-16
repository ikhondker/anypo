<?php

namespace App\View\Components\Tenant\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;

class HeaderSearchExportXls extends Component
{

	public $route;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $entity, public string $title = "", public bool $export = true)
	{
		$this->title = ($title == '') ? $this->entity : $title;
		$this->route = Str::lower(Str::plural(Str::snake($entity, '-')));
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.card.header-search-export-xls');
	}
}
