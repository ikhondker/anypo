<?php

namespace App\View\Components\Tenant\Widgets\Pr;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Pr;
use App\Enum\UserRoleEnum;
 use Illuminate\Support\Facades\Log;
 
class Lists extends Component
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
				$this->prs =  Pr::ByDeptAll()->with('dept')->with('requestor')->orderBy('id', 'DESC')->limit(5)->get();
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
			case UserRoleEnum::SYSTEM->value:
				$this->prs =  Pr::with('dept')->with('requestor')->orderBy('id', 'DESC')->limit(5)->get();
				break;
			default:
				$this->prs =  Pr::ByUserAll()->with('dept')->with('requestor')->orderBy('id', 'DESC')->limit(5)->get();
				Log::error("widget.pr.lists Other roles!");
		}

	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.pr.lists');
	}
}
