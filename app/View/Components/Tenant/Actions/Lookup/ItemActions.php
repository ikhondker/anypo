<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


use App\Models\Tenant\Lookup\Item;

class ItemActions extends Component
{
	public $item;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $itemId)
	{
		$this->item 	= Item::where('id', $itemId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.item-actions');
	}
}
