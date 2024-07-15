<?php

namespace App\View\Components\Tenant\Actions\Ae;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Ae\Aeh;

class AehActions extends Component
{
	public $aeh;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public $id='')
	{
		$this->id 		= $id;
		if ($this->id <> ''){
			$this->aeh 	= Aeh::where('id', $this->id)->get()->firstOrFail();
		} else {
			$this->aeh 	= new Aeh;
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.ae.aeh-actions');
	}
}
