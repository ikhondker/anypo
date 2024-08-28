<?php

namespace App\View\Components\Tenant\Widgets\InvoiceLine;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class CardTableRow extends Component
{
    public $invoiceLine;
	public $action;
	/**
	 * Create a new component instance.
	 */
	public function __construct($line, $action = false )
	{
		$this->invoiceLine		= $line;
		$this->action	= $action;
	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.widgets.invoice-line.card-table-row');
    }
}
