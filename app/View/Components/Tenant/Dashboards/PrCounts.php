<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;

class PrCounts extends Component
{

	
	public $count_approved;
	public $sum_approved;
	
	public $count_inprocess;
	public $sum_inprocess;
	
	public $count_rejected;
	public $sum_rejected;
	
	// Dont show converted does not make any sense
	//public $count_converted;
	//public $sum_converted;

	//public $count_draft;
	//public $sum_draft;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{

		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:


				$this->count_approved	= Pr::ByUserApproved()->count();
				$this->sum_approved		= Pr::ByUserApproved()->sum('fc_amount');

				$this->count_inprocess	= Pr::ByUserInProcess()->count();
				$this->sum_inprocess	= Pr::ByUserInProcess()->sum('fc_amount');

				$this->count_rejected	= Pr::ByUserRejected()->count();
				$this->sum_rejected		= Pr::ByUserRejected()->sum('fc_amount');

				//$this->count_converted	= Pr::ByUserConverted()->count();
				//$this->sum_converted	= Pr::ByUserConverted()->sum('fc_amount');

				break;
			case UserRoleEnum::HOD->value:

				$this->count_approved	= Pr::ByDeptApproved()->count();
				$this->sum_approved		= Pr::ByDeptApproved()->sum('fc_amount');

				$this->count_inprocess	= Pr::ByDeptInProcess()->count();
				$this->sum_inprocess	= Pr::ByDeptInProcess()->sum('fc_amount');

				$this->count_rejected	= Pr::ByDeptRejected()->count();
				$this->sum_rejected		= Pr::ByDeptRejected()->sum('fc_amount');

				//$this->count_converted	= Pr::ByDeptConverted()->count();
				//$this->sum_converted	= Pr::ByDeptConverted()->sum('fc_amount');

				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:

				$this->count_approved	= Pr::AllApproved()->count();
				$this->sum_approved		= Pr::AllApproved()->sum('fc_amount');

				$this->count_inprocess	= Pr::AllInProcess()->count();
				$this->sum_inprocess	= Pr::AllInProcess()->sum('fc_amount');

				$this->count_rejected	= Pr::AllRejected()->count();
				$this->sum_rejected		= Pr::AllRejected()->sum('fc_amount');

				//$this->count_converted	= Pr::AllConverted()->count();
				//$this->sum_converted	= Pr::AllConverted()->sum('fc_amount');

				break;
			default:
			Log::debug('tenant.component.dashboard.pr-counts Role Not Found!');
		}

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.pr-counts');
	}
}
