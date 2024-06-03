<?php

namespace App\View\Components\Tenant\Ael;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Ae\Aeh;
use App\Models\Tenant\Ae\Ael;

class AelForPo extends Component
{
	public $id;
    public $aeh;
	public $aels;

	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
        $this->id   = $id;
		//$this->aeh  = Aeh::where('po_id', $id)->get()->firstOrFail();

        $this->aels = Ael::with('aeh')
            ->whereHas('aeh', function ($q) use ($id) {
                $q->where('po_id', $id);
            })
            ->get()->all();

		//$this->aels = Ael::where('aeh_id', $this->aeh->id)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.ael.ael-for-po');
	}
}
