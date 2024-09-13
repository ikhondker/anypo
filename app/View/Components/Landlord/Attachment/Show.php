<?php

namespace App\View\Components\Landlord\Attachment;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Landlord\Attachment;

use Illuminate\Support\Facades\Log;


class Show extends Component
{
	 public $entity;
	 public $aid;
	 public $attachments;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct($entity, $aid)
	{
		//there will id 1001 and 1001 for PO and PR. need entity
		$this->entity	= $entity;
		$this->aid		= $aid;
		$this->attachments = Attachment::where('entity', $entity)->where('article_id', $aid)->get()->all();
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render(): View|Closure|string
	{
		return view('components.landlord.attachment.show');
	}
}
