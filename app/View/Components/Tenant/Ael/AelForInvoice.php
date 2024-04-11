<?php

namespace App\View\Components\Tenant\Ael;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Ael;
use App\Enum\EntityEnum;

class AelForInvoice extends Component
{
	public $id;
	public $aels;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		
		$this->aels = Ael::where('entity',EntityEnum::INVOICE->value)->where('article_id', $id)->get();
		$this->id = $id;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.ael.ael-common');
	}
}
