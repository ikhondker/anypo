<?php

namespace App\View\Components\Tenant\Widgets\Po;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;
use App\Enum\UserRoleEnum;
use App\Enum\AuthStatusEnum;

use Illuminate\Support\Facades\Log;

class ListByDate extends Component
{
	public $pos;
	public $card_header ='Purchase Orders (Recent 5)';

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		//
		switch (auth()->user()->role->value) {
			case UserRoleEnum::HOD->value:
				$this->pos = Po::ByDeptAll()->orderBy('id', 'DESC')
				->where('auth_status', '<>' , AuthStatusEnum::DRAFT->value)
				->limit(5)->paginate(10);
				break;
			case UserRoleEnum::BUYER->value:
			case UserRoleEnum::CXO->value:
			case UserRoleEnum::ADMIN->value:
				$this->pos = Po::AllApproved()->orderBy('id', 'DESC')
				->where('auth_status', '<>', AuthStatusEnum::DRAFT->value)
				->limit(5)->paginate(10);
				break;
			case UserRoleEnum::SYSTEM->value:
				$this->pos = Po::with('dept')->orderBy('id', 'DESC')
				->where('auth_status', '<>', AuthStatusEnum::DRAFT->value)
				->limit(5)->paginate(10);
				break;
			default:
				//$pos = $pos->ByUserAll()->paginate(10);
				Log::warning(tenant('id'). ' tenant.widget.po.po-lists Other role = '. auth()->user()->role->value);
				abort(403);
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.po.lists-by-date');
	}
}
