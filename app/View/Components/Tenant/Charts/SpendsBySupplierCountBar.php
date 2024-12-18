<?php

namespace App\View\Components\Tenant\Charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\Supplier;
use Illuminate\Support\Facades\Log;
use Str;

class SpendsBySupplierCountBar extends Component
{
	public 	$suppliers;

	public $supplier_labels 	= [];
	//public $project_colors 	= [];

	public $count_pr 		= [];
	public $count_po 		= [];
	public $count_grs 		= [];
	public $count_invoice 	= [];
	public $count_payment 	= [];

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->suppliers = Supplier::where('enable', true)->orderBy('id', 'DESC')->limit(10)->get();

		foreach ($this->suppliers as $supplier){
			//Log::debug('Value of id=' . $supplier->name . ' -> '.$supplier->amount);
			//$this->supplier_labels[] 	= $supplier->name;
			$this->supplier_labels[] 	= Str::limit($supplier->name, 5,'...');
			$this->count_pr[] 			= (int) $supplier->count_pr;
			$this->count_po[] 			= (int) $supplier->count_po;
			$this->count_grs[] 			= (int) $supplier->count_grs;
			$this->count_invoice[] 		= (int) $supplier->count_invoice;
			$this->count_payment[] 		= (int) $supplier->count_payment;
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.charts.spends-by-supplier-count-bar');
	}
}
