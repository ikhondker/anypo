<?php

namespace App\View\Components\Tenant\Attachment;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Attachment;

class All extends Component
{
	public $attachments;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $entity, public string $articleId)
	{
		$this->attachments = Attachment::where('entity', $entity)->where('article_id', $articleId)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.attachment.all');
	}
}
