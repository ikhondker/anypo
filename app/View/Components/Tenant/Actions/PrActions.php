<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;

class PrActions extends Component
{
	public $pr;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $prId)
	{
		$this->pr 		= Pr::where('id', $prId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.pr-actions');
	}
}
