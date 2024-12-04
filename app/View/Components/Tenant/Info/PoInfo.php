<?php

namespace App\View\Components\Tenant\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Po;

class PoInfo extends Component
{

	public $po;
	public $photo;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $poId, $photo='po')
	{
		$this->photo 	= 'flow/'.$photo.'.jpg';
		$this->po 		= Po::where('id', $poId)->get()->first();
	}


	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.info.po-info');
	}
}
