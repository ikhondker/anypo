<?php

namespace App\View\Components\Tenant\Dashboards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;

use Illuminate\Support\Facades\Log;

class PoCountsBuyer extends Component
{
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
		//$this->count_approved	= Po::All()->count();
		$this->count_approved	= Po::ByBuyerApproved()->count();
		$this->sum_approved		= Po::ByBuyerApproved()->sum('fc_amount');

		$this->count_inprocess	= Po::ByBuyerInProcess()->count();
		$this->sum_inprocess	= Po::ByBuyerInProcess()->sum('fc_amount');

		$this->count_draft		= Po::ByBuyerDraft()->count();
		$this->sum_draft		= Po::ByBuyerDraft()->sum('fc_amount');
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.dashboards.po-counts-buyer');
	}
}
