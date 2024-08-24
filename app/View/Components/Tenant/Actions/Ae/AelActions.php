<?php

namespace App\View\Components\Tenant\Actions\Ae;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Ae\Ael;

class AelActions extends Component
{
	public $ael;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $aelId='')
	{
		if ($aelId <> ''){
			$this->ael 	= Ael::where('id', $aelId)->get()->firstOrFail();
		} else {
			$this->ael 	= new Ael;
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.ae.ael-actions');
	}
}
