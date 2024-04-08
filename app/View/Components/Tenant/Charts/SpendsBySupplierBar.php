<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Supplier;
use Illuminate\Support\Facades\Log;

use Str;

class SpendsBySupplierBar extends Component
{
	public 	$suppliers;

	public $supplier_labels 	= [];
	//public $project_colors 	= [];
	
	public $budget 			= [];
	public $amount_pr 		= [];
	public $amount_po 		= [];
	public $amount_grs 		= [];
	public $amount_invoice 	= [];
	public $amount_payment 	= [];

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->suppliers = Supplier::where('enable', true)->orderBy('id', 'DESC')->limit(10)->get();

		foreach ($this->suppliers as $supplier){
			//Log::debug('Value of id=' . $supplier->name . ' -> '.$supplier->amount);
			$this->supplier_labels[] 	= Str::limit($supplier->name, 5,'...');
			$this->budget[] 			= (int) $supplier->amount;
			$this->amount_pr[] 			= (int) $supplier->amount_pr + $supplier->amount_pr_booked;
			$this->amount_po[] 			= (int) $supplier->amount_po + $supplier->amount_po_booked;
			$this->amount_grs[] 		= (int) $supplier->amount_grs;
			$this->amount_invoice[] 	= (int) $supplier->amount_invoice;
			$this->amount_payment[] 	= (int) $supplier->amount_payment;
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.charts.spends-by-supplier-bar');
	}
}
