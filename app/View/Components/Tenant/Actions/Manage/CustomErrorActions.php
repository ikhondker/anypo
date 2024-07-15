<?php

namespace App\View\Components\Tenant\Actions\Manage;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Manage\CustomError;

class CustomErrorActions extends Component
{
    public $customError;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public $code)
	{
		$this->code 		= $code;
		$this->customError = CustomError::where('code', $this->code)->get()->firstOrFail();
	}
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.actions.manage.custom-error-actions');
    }
}
