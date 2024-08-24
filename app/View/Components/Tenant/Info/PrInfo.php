<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;

class PrInfo extends Component
{

	public $pr;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $prId)
	{
		 $this->pr = Pr::with("requestor")->with("dept")->with('status_badge','auth_status_badge')->where('id', $prId)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.pr-info');
	}
}
