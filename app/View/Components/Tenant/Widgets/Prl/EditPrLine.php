<?php

namespace App\View\Components\Tenant\Widgets\Prl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;

class EditPrLine extends Component
{
	//public $id;
	public $pr;
	public $prls;
	public $items;
	public $uoms;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $prid, public string  $prlid)
	{
		$this->items = Item::primary()->get();
		$this->uoms = Uom::primary()->get();
		
		$this->pr   = Pr::where('id', $prid)->get()->first();
		$this->prls = Prl::with('item')->with('uom')->where('pr_id', $this->pr->id)->get()->all();
		//$this->prl = Prl::with('item')->with('uom')->where('id', $prlid)->get()->first();
		
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.prl.edit-pr-line');
	}
}
