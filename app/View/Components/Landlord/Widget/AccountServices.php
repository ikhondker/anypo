<?php

namespace App\View\Components\Landlord\Widget;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Admin\Service;

class AccountServices extends Component
{
	public $services;

	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
		$this->services = Service::with('account')->byAccount()->orderBy('id', 'ASC')->paginate(10);
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.widget.account-services');
	}
}
