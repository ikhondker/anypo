<?php

namespace App\View\Components\Share\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Share\Template;

class TemplateActions extends Component
{
	public $template;
	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $templateId)
	{
		$this->template 	= Template::where('id', $templateId)->get()->firstOrFail();
	}


	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.share.actions.template-actions');
	}
}
