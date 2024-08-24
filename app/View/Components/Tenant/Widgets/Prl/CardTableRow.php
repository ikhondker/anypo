<?php

namespace App\View\Components\Tenant\Widgets\Prl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardTableRow extends Component
{
	public $prl;
	//public $status;
	public $action;
	/**
	 * Create a new component instance.
	 */
	public function __construct($line, $action = false )
	{
		$this->prl		= $line;
		//$this->status	= $status;
		$this->action	= $action;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.prl.card-table-row');
	}
}
