<?php

namespace App\View\Components\Tenant\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Str;
use Illuminate\Support\Facades\Log;
class ArticleLink extends Component
{
	public $entity;
	public $id;
	public $route;

	/**
	 * Create a new component instance.
	 */
	public function __construct($entity, $id=1001)
	{
		$this->entity =$entity;
		$this->id =$id;
		$this->route = Str::plural(Str::snake(Str::lower($entity), '-'));

		//Log::debug('route=' . $this->route);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.list.article-link');
	}
}
