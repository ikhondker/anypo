<?php

namespace App\View\Components\Tenant\Attachment;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Admin\Attachment;

class All extends Component
{
	public $entity;
	public $aid;
	public $attachments;

	/**
	 * Create a new component instance.
	 */
	public function __construct($entity, $aid)
	{
		$this->entity	= $entity;
		$this->aid		= $aid;
		$this->attachments = Attachment::where('entity', $entity)->where('article_id', $aid)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.attachment.all');
	}
}
