<?php

namespace App\View\Components\Tenant\Attachment;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Manage\Entity;
use Str;
use Illuminate\Support\Facades\Log;
class Add extends Component
{
	public $route;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $entity, public string $articleId )
	{
		$e = Entity::where('entity', $entity )->first();
		$this->route = $e->route;
		//$this->route = Str::lower(Str::plural(Str::snake($entity, '-')));
		//Log::debug('e->route=' . $e->route);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.attachment.add');
	}
}
