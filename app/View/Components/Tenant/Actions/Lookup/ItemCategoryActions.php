<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Lookup\ItemCategory;

class ItemCategoryActions extends Component
{
	public $itemCategory;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $itemCategoryId)
	{
		$this->itemCategory = ItemCategory::where('id', $itemCategoryId)->get()->firstOrFail();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.actions.lookup.item-category-actions');
	}
}
