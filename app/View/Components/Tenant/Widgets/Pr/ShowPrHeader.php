<?php

namespace App\View\Components\Tenant\Widgets\Pr;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;

class ShowPrHeader extends Component
{
	public $id;
	public $pr;
	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->pr = Pr::where('id', $id)->with("requestor")->with("dept")->with('status_badge','auth_status_badge')->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.pr.show-pr-header');
	}
}
