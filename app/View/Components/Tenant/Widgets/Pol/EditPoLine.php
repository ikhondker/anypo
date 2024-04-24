<?php

namespace App\View\Components\Tenant\Widgets\Pol;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;



class EditPoLine extends Component
{
	//public $id;
	public $po;
	public $pols;
	public $items;
	public $uoms;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $poid, public string  $polid)
	{
		$this->items = Item::primary()->get();
		$this->uoms = Uom::primary()->get();
		
		$this->po	= Po::where('id', $poid)->get()->first();
		$this->pols = Pol::with('item')->with('uom')->where('po_id', $this->po->id)->get()->all();
		//$this->prl = Prl::with('item')->with('uom')->where('id', $prlid)->get()->first();
		
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.pol.edit-po-line');
	}
}
