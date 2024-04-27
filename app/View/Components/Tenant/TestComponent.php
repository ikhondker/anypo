<?php

namespace App\View\Components\Tenant;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

class TestComponent extends Component
{
	//public $dept_budget_id;
	//public string $type,
	//public string $message = 'aaaaaaaa',
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		// public string $type,
		public string $dbid = '9999',
		//public string $dept_budget_id,
	)
	{
		//Log::debug('Value of dept_budget_id=' . $dept_budget_id);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.test-component');
	}
}
