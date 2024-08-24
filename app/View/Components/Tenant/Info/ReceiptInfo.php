<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Receipt;

class ReceiptInfo extends Component
{
	
	public $receipt;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $receiptId)
	{
		$this->receipt = Receipt::with('pol.po')->where('id', $receiptId)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.receipt-info');
	}
}
