<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;



class PrListsPoPending extends Component
{
    public $prs;
    public $card_header ='Approved Requisitions';

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
		$this->prs = Pr::ApprovedPoPending()->orderBy('id', 'DESC')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.widgets.pr.lists');
    }
}
