<?php

namespace App\View\Components\Tenant\Widgets\Po;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;

class ShowPoHeader extends Component
{

	public $po;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $poId)
	{
		$this->po = Po::where('id', $poId)->with("buyer")->with("dept")->with('status_badge','auth_status_badge')->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.po.show-po-header');
	}
}
