<?php

namespace App\View\Components\Landlord\Edit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Category extends Component
{
    public $categories;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $value='')
	{
		$this->categories = \App\Models\Landlord\Lookup\Category::getAll();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.edit.category');
	}
}
