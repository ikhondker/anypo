<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pol;


class PolActions extends Component
{
	public $pol;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $polId)
	{

		$this->pol 		= Pol::where('id', $polId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.pol-actions');
	}
}
