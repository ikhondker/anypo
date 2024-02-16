<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;

class PoInfo extends Component
{
    
    public $id;
	public $po;

    /**
     * Create a new component instance.
     */
    public function __construct($id)
    {
         $this->po = Po::where('id', $id)->get()->first();
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.widgets.po-info');
    }
}
