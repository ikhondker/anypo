<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Lookup\Category;

class CategoryActions extends Component
{

    public $category;
    /**
     * Create a new component instance.
     */
    public function __construct(public $id)
    {
        $this->id 		= $id;
		$this->category = Category::where('id', $this->id)->get()->firstOrFail();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.actions.lookup.category-actions');
    }
}
