<?php

namespace App\View\Components\Tenant\Accounting;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Accounting;

class ForPo extends Component
{
	public $id;
	public $accountings;
	

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->accountings = Accounting::where('po_id', $id)->get();
		$this->id = $id;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.accounting.for-po');
	}
}
