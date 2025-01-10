<?php

namespace App\View\Components\Tenant\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LinkPo extends Component
{
		//public $id;
		/**
		 * Create a new component instance.
		 */
		public function __construct(public string $id='1001')
		{

		}

		/**
		 * Get the view / contents that represent the component.
		 */
		public function render(): View|Closure|string
		{
				return view('components.tenant.common.link-po');
		}
}
