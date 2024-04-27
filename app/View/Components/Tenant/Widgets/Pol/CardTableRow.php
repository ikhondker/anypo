<?php

namespace App\View\Components\Tenant\Widgets\Pol;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardTableRow extends Component
{
	public $pol;
	public $status;
	/**
	 * Create a new component instance.
	 */
	public function __construct($line, $status)
	{
		$this->pol		= $line;
		$this->status	= $status;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.pol.card-table-row');
	}
}
