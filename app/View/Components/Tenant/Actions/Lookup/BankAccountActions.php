<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\BankAccount;
class BankAccountActions extends Component
{
	public $bankAccount;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $bankAccountId)
	{
		$this->bankAccount 	= BankAccount::where('id', $bankAccountId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.bank-account-actions');
	}
}
