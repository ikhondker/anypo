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

		//$this->anyNotice = false;
		$this->anyNotice = $landlordSetup->maintenance; // ? or maintenance
		//$this->notice = "Test Notice from Landlord ." .$landlordSetup->maintenance_start_time . " to ". $landlordSetup->maintenance_end_time ;
		$this->notice = "
		Please note there will be scheduled server maintenance 
		from  " .  strtoupper(date('d-M-Y H:i:s', strtotime($landlordSetup->maintenance_start_time))) .
		" to " . strtoupper(date('d-M-Y H:i:s', strtotime($landlordSetup->maintenance_end_time))) .
		"This maintenance is essential to ensure the continued performance, reliability, and security of the systems. We appreciate your support and thank you for your patience.
		";
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.landlord-notice-all-tenants');
	}
}
