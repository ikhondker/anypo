<?php

namespace App\View\Components\Tenant;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LandlordNoticeAllTenants extends Component
{
	public $anyNotice;
	public $notice;
	
	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
	  //
		$landlordSetup = tenancy()->central(function ($tenant) {
			return \App\Models\Landlord\Manage\Setup::where('id', 1)->first();
		});
		//dd($landlordSetup);
		//Log::debug('count cnt=' . $landlordSetup->name);

		$this->anyNotice = false;
		//$this->anyNotice = $landlordSetup->banner_show; // ? or maintenance
		$this->notice = "Test Notice from Landlord ." .$landlordSetup->name ;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.landlord-notice-all-tenants');
	}
}
