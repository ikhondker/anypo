<?php

namespace App\View\Components\Tenant\Widgets\Pol;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;
use Illuminate\Support\Facades\Log;

class ShowPoLines extends Component
{
    public $id;
	public $selected_pol_id;
	public $po;
	public $pols;
	public $items;
	public $uoms;
	public $add;
	public $edit;
	public $show;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $add=false, $edit=false, $show=false, $pid=0)
    {
       $this->items 	= Item::All();
		$this->uoms 	= Uom::primary()->get();

		//$this->selected_prl_id = ($selected_prl_id == 0) ? 0 : $selected_prl_id  ;
		$this->selected_pol_id = $pid;
		
		$this->po 	= Po::where('id', $id)->get()->first();
		$this->pols = Pol::with('item')->with('uom')->where('po_id', $id)->get()->all();
		//Log::debug("id=".$id." selected_prl_id=".$this->selected_prl_id);

		$this->add	= $add;
		$this->edit = $edit;
		$this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.widgets.pol.show-po-lines');
    }
}
