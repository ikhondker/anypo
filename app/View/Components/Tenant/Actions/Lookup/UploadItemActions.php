<?php

namespace App\View\Components\Tenant\Actions\Lookup;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Lookup\UploadItem;

class UploadItemActions extends Component
{
    public $uploadItem;
    /**
     * Create a new component instance.
     */
    public function __construct(public string $uploadItemId)
    {
        $this->uploadItem 	= UploadItem::where('id', $uploadItemId)->get()->firstOrFail();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant.actions.lookup.upload-item-actions');
    }
}
