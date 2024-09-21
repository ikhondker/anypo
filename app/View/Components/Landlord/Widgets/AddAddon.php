<?php

namespace App\View\Components\Landlord\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Account;
use App\Models\Landlord\Lookup\Product;

class AddAddon extends Component
{
	public $account_id;
	public $account;
	public $addons;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->account_id 	= auth()->user()->account_id;
		$this->account 		= Account::where('id', $this->account_id )->first();
		$this->addons 		= Product::where('addon', true)->where('enable', true)->orderBy('id', 'ASC')->get();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.widgets.add-addon');
	}
}
