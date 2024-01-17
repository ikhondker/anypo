<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;
use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;

class PoCounts extends Component
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
			case UserRoleEnum::BUYER->value:
				$this->count_total		= Po::ByUserAll()->count();
				$this->sum_total		= Po::ByUserAll()->sum('amount');

				$this->count_approved	= Po::ByUserApproved()->count();
				$this->sum_approved		= Po::ByUserApproved()->sum('amount');

				$this->count_inprocess	= Po::ByUserInProcess()->count();
				$this->sum_inprocess	= Po::ByUserInProcess()->sum('amount');

				$this->count_draft		= Po::ByUserDraft()->count();
				$this->sum_draft		= Po::ByUserDraft()->sum('amount');
				break;
			case UserRoleEnum::HOD->value:
				$this->count_total		= Po::ByDeptAll()->count();
				$this->sum_total		= Po::ByDeptAll()->sum('amount');

				$this->count_approved	= Po::ByDeptApproved()->count();
				$this->sum_approved		= Po::ByDeptApproved()->sum('amount');

				$this->count_inprocess	= Po::ByDeptInProcess()->count();
				$this->sum_inprocess	= Po::ByDeptInProcess()->sum('amount');

				$this->count_draft		= Po::ByDeptDraft()->count();
				$this->sum_draft		= Po::ByDeptDraft()->sum('amount');
				break;
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$this->count_total		= Po::All()->count();
				$this->sum_draft		= Po::All()->sum('amount');

				$this->count_approved	= Po::AllApproved()->count();
				$this->sum_approved		= Po::AllApproved()->sum('amount');

				$this->count_inprocess	= Po::AllInProcess()->count();
				$this->sum_inprocess		= Po::AllInProcess()->sum('amount');

				$this->count_draft		= Po::AllDraft()->count();
				$this->sum_draft		= Po::AllDraft()->sum('amount');
				break;
			default:
			Log::debug('po-counts. Role Not Found!');
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
