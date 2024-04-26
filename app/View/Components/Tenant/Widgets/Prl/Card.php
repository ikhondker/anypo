<?php

namespace App\View\Components\Tenant\Widgets\Prl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
	public $pr;
	public $readOnly;
	public $addMore;

	/**
	 * Create a new component instance.
	 */
	public function __construct($pr = '', $readOnly = true, $addMore = false)
	{
		$this->pr 			= $pr;
		$this->readOnly 	= $readOnly;
		$this->addMore 		= $addMore;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.prl.card');
	}
}
