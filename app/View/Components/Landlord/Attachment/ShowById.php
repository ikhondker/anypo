<?php

namespace App\View\Components\Landlord\Attachment;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Admin\Attachment;

class ShowById extends Component
{
	public $id;
	public $attachment;
	
	/**
	 * Create a new component instance.
	 */
	public function __construct($id)
	{
		$this->id			= $id;
		$this->attachment 	= Attachment::where('id', $id)->get()->first();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.attachment.show-by-id');
	}
}
