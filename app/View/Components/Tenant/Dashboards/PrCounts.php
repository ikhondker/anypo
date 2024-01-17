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

	public $count_total;
	public $sum_total;

	public $count_approved;
	public $sum_approved;

	public $count_inprocess;
	public $sum_inprocess;

	public $count_draft;
	public $sum_draft;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{

		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:
				$this->count_total		= Pr::ByUserAll()->count();
				$this->sum_total		= Pr::ByUserAll()->sum('amount');

				$this->count_approved	= Pr::ByUserApproved()->count();
				$this->sum_approved		= Pr::ByUserApproved()->sum('amount');

				$this->count_inprocess	= Pr::ByUserInProcess()->count();
				$this->sum_inprocess	= Pr::ByUserInProcess()->sum('amount');

				$this->count_draft		= Pr::ByUserDraft()->count();
				$this->sum_draft		= Pr::ByUserDraft()->sum('amount');
				break;
			case UserRoleEnum::HOD->value:
				$this->count_total		= Pr::ByDeptAll()->count();
				$this->sum_total		= Pr::ByDeptAll()->sum('amount');

				$this->count_approved	= Pr::ByDeptApproved()->count();
				$this->sum_approved		= Pr::ByDeptApproved()->sum('amount');

				$this->count_inprocess	= Pr::ByDeptInProcess()->count();
				$this->sum_inprocess	= Pr::ByDeptInProcess()->sum('amount');

				$this->count_draft		= Pr::ByDeptDraft()->count();
				$this->sum_draft		= Pr::ByDeptDraft()->sum('amount');
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$this->count_total		= Pr::All()->count();
				$this->sum_draft		= Pr::All()->sum('amount');

				$this->count_approved	= Pr::AllApproved()->count();
				$this->sum_approved		= Pr::AllApproved()->sum('amount');

				$this->count_inprocess	= Pr::AllInProcess()->count();
				$this->sum_inprocess		= Pr::AllInProcess()->sum('amount');

				$this->count_draft		= Pr::AllDraft()->count();
				$this->sum_draft		= Pr::AllDraft()->sum('amount');
				break;
			default:
			Log::debug('Role Not Found!');
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
