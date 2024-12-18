<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Ae\Aeh;

class AehInfo extends Component
{

	public $aeh;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $aehId)
	{
		$this->aeh = Aeh::where('id', $aehId)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.aeh-info');
	}
}
