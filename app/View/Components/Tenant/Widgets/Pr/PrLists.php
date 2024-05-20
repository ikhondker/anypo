<?php

namespace App\View\Components\Tenant\Widgets\Pr;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;

use Illuminate\Support\Facades\Log;


class PrLists extends Component
{
	public $prs;
	public $card_header ='Requisition Lists (Last 5)';

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		//
		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:
				$this->prs = Pr::ByUserAll()->with('dept')->with('requestor')->orderBy('id', 'DESC')->limit(5)->get();
				break;
			case UserRoleEnum::HOD->value:
				$this->prs = Pr::ByDeptApproved()->with('dept')->with('requestor')->orderBy('id', 'DESC')->limit(5)->get();
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$this->prs = Pr::with('dept')->with('requestor')->orderBy('id', 'DESC')
                ->where('auth_status','<>',AuthStatusEnum::DRAFT->value)
                ->limit(5)->get();
				break;
			default:
				$this->prs = Pr::ByUserAll()->with('dept')->with('requestor')->orderBy('id', 'DESC')->limit(5)->get();
				Log::error("tenant.widget.pr.pr-lists Other roles!");
		}

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.pr.pr-lists');
	}
}
