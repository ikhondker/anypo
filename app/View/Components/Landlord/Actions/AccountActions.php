<?php

namespace App\View\Components\Landlord\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Account;

class AccountActions extends Component
{
	public $account;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $accountId = '')
	{
		if ($accountId == ''){
			$accountId = auth()->user()->account_id;
		}
		$this->account 	= Account::where('id', $accountId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.actions.account-actions');
	}
}
