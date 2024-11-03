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
			return \App\Models\Landlord\Manage\Config::where('id', config('akk.LANDLORD_CONFIG_ID'))->first();
		});

		// use tenant table for notice TODOP2
		$this->anyNotice = false;
		$this->notice = "Test Notice ONE Tenant Landlord ." .$landlordConfig->name ;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.landlord-notice-one-tenant');
	}
}
