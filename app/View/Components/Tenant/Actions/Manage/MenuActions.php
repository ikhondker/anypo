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
	public function __construct(public $id)
	{
		// if ( $id == 0 ){
		// 	$this->id		= 0;
		// 	$this->menu 	= New Dept();
		// } else {
			$this->id 		= $id;
			$this->menu 	= Menu::where('id', $this->id)->get()->firstOrFail();
		//}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.manage.menu-actions');
	}
}
