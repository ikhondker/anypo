<?php

namespace App\View\Components\Tenant\Widgets\Pol;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $po;
	public $readOnly;
	public $addMore;

	/**
	 * Create a new component instance.
	 */
	public function __construct($po = '', $readOnly = true, $addMore = false)
	{
		$this->po 			= $po;
		$this->readOnly 	= $readOnly;
		$this->addMore 		= $addMore;
	}


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.widgets.pol.card');
    }
}
