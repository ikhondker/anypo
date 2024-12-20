<?php

namespace App\View\Composers\Tenant;

//use App\Repositories\UserRepository;
use Illuminate\View\View;

use App\Models\Tenant\Admin\Setup;

use Illuminate\Support\Facades\Log;

class SetupComposer
{
	/**
	 * Create a new profile composer.
	 */
	public function __construct() {}

	/**
	 * Bind data to the view.
	 */
	public function compose(View $view): void
	{
		//Log::debug('SetupComposer ... ');

		$setup = Setup::first();
		$view->with(['_setup' => $setup]);
		//$view->with('count', $this->users->count());
	}
}
