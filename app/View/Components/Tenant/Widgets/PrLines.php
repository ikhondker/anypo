<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;
use App\Models\Tenant\Lookup\Item;
use Illuminate\Support\Facades\Log;

class PrLines extends Component
{
    public $id;
    public $selected_prl_id;
    public $pr;
    public $prls;
    public $items;
    public $add;
    public $edit;
    public $show;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $add=false, $edit=false, $show=false, $pid=0)
    {
        $this->items = Item::getAll();

        //$this->selected_prl_id = ($selected_prl_id == 0) ? 0 : $selected_prl_id  ;
        $this->selected_prl_id = $pid;
        
        $this->pr = Pr::where('id', $id)->get()->first();
        $this->prls = Prl::where('pr_id', $id)->get()->all();
        //Log::debug("id=".$id." selected_prl_id=".$this->selected_prl_id);

        $this->add  = $add;
        $this->edit = $edit;
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.widgets.pr-lines');
    }
}
