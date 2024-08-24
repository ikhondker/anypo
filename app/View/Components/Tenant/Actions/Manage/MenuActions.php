<?php

namespace App\View\Components\Tenant\Actions\Manage;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Manage\Menu;

class MenuActions extends Component
{
	public $menu;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $menuId)
	{
		$this->menu 	= Menu::where('id', $menuId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.manage.menu-actions');
	}
}
