<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


use App\Models\Tenant\Po;

class PoActions extends Component
{
	public $po;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $poId)
	{
		$this->po 		= Po::where('id', $poId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.po-actions');
	}
}
