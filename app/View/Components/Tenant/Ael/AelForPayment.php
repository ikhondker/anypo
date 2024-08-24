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
	//public $id;
	//public $aeh;
	public $aels;
	public $label;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $paymentId)
	{
		$this->label= 'Payment #'.$paymentId;
		try {
			$this->aels = Ael::with('aeh')->ByPayment($paymentId)->get()->all();
		} catch (Exception $e) {
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
