<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;
use App\Enum\UserRoleEnum;
//use App\Enum\Tenant\AuthStatusEnum;

use Illuminate\Support\Facades\Log;

class PoCounts extends Component
{
	public $count_approved;
	public $sum_approved;

	public $count_inprocess;
	public $sum_inprocess;

	public $count_rejected;
	public $sum_rejected;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		switch (auth()->user()->role->value) {
			// user separate dashboard widget for buyer
			// case UserRoleEnum::BUYER->value:

			// 	$this->count_approved	= Po::ByBuyerApproved()->count();
			// 	$this->sum_approved		= Po::ByBuyerApproved()->sum('fc_amount');

			// 	$this->count_inprocess	= Po::ByBuyerInProcess()->count();
			// 	$this->sum_inprocess	= Po::ByBuyerInProcess()->sum('fc_amount');

			// 	$this->count_rejected	= Po::ByBuyerRejected()->count();
			// 	$this->sum_rejected		= Po::ByBuyerRejected()->sum('fc_amount');
			// 	break;
			case UserRoleEnum::HOD->value:

				$this->count_approved	= Po::ByDeptApproved()->count();
				$this->sum_approved		= Po::ByDeptApproved()->sum('fc_amount');

				$this->count_inprocess	= Po::ByDeptInProcess()->count();
				$this->sum_inprocess	= Po::ByDeptInProcess()->sum('fc_amount');

				$this->count_rejected	= Po::ByDeptRejected()->count();
				$this->sum_rejected		= Po::ByDeptRejected()->sum('fc_amount');
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$this->count_approved	= Po::AllApproved()->count();
				$this->sum_approved		= Po::AllApproved()->sum('fc_amount');

				$this->count_inprocess	= Po::AllInProcess()->count();
				$this->sum_inprocess	= Po::AllInProcess()->sum('fc_amount');

				$this->count_rejected	= Po::AllRejected()->count();
				$this->sum_rejected		= Po::AllRejected()->sum('fc_amount');
				break;
			default:
			Log::warning('tenant.component.dashboard.po-counts. Role Not Found!');
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.po-counts');
	}
}
