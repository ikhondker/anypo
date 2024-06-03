<?php

namespace App\View\Components\Tenant\Ael;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Ae\Aeh;
use App\Models\Tenant\Ae\Ael;
use App\Enum\EntityEnum;
use Exception;
class AelForPayment extends Component
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
        try {
            $this->aeh  = Aeh::where('source_entity',EntityEnum::PAYMENT->value)->where('article_id', $this->id)->get()->firstOrFail();
            $this->aels = Ael::where('aeh_id', $this->aeh->id)->get()->all();
        } catch (Exception $e) {
            $this->aeh  =  new Aeh();
            $this->aels = new Ael();
        }

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.ael.ael-common');
	}
}
