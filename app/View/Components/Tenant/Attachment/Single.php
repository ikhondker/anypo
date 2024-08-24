<?php

namespace App\View\Components\Tenant\Attachment;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tenant\Attachment;

class Single extends Component
{
	public $attachment;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $id)
	{
		$this->attachment 	= Attachment::where('id', $id)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.attachment.single');
	}
}
