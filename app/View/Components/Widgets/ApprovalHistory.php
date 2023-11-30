<?php

namespace App\View\Components\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Wfl;

class ApprovalHistory extends Component
{
    public $id;
    public $wfls;

    /**
     * Create a new component instance.
     */
    public function __construct($id)
    {
        $this->wfls = Wfl::with('performer')->where('wf_id', $id)->get()->all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.approval-history');
    }
}
