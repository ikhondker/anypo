<?php

namespace App\View\Components\Landlord\Widget;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Account;

class ExpireWarning extends Component
{
	public $account_id;
	public $account;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{

		$this->account_id = auth()->user()->account_id;
		if ($this->account_id ==''){
			$this->account =[];
		} else{
			$this->account = Account::where('id', $this->account_id )->first();
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.widget.expire-warning');
	}
}
