<?php

namespace App\View\Components\Tenant\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Ael;

class AelActions extends Component
{
	public $ael;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public $id='')
	{
		$this->id 		= $id;
		if ($this->id <> ''){
			$this->ael 	= Ael::where('id', $this->id)->get()->firstOrFail();
		} else {
			$this->ael 	= new Ael;
		}
	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.actions.ael-actions');
    }
}
