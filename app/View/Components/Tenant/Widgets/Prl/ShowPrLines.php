<?php

namespace App\View\Components\Tenant\Widgets\Prl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Uom;


class ShowPrLines extends Component
{
    public $id;
	public $pr;
	public $prls;
	public $items;
	public $uoms;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->items = Item::primary()->get();
		$this->uoms = Uom::primary()->get();
		if ($id <> ''){
			$this->pr   = Pr::where('id', $id)->get()->first();
			$this->prls = Prl::with('item')->with('uom')->where('pr_id', $id)->get()->all();
		} else {
			$this->pr   = new Pr();
			$this->prls = new Prl();
		}
	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.widgets.prl.show-pr-lines');
    }
}
