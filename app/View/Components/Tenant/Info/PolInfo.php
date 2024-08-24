<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pol;

class PolInfo extends Component
{
	
	public $pol;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $polId)
	{

		 $this->pol = Pol::with('po')->where('id', $polId)->get()->first();
	}
	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.pol-info');
	}
}
