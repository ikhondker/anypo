<?php

namespace App\View\Components\Tenant;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LandlordNoticeOneTenant extends Component
{
	public $anyNotice;
	public $notice;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		//
		$landlordConfig = tenancy()->central(function ($tenant) {
			return \App\Models\Landlord\Manage\Config::where('id', 1)->first();
		});
		//dd($landlordConfig);

		$this->anyNotice = false;
		$this->notice = "Test Notice ONE Tenant TODO Landlord ." .$landlordConfig->name ;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.landlord-notice-one-tenant');
	}
}
