<?php

namespace App\View\Composers\Landlord;

//use App\Repositories\UserRepository;
use Illuminate\View\View;

use App\Models\Landlord\Manage\Config;
use App\Models\Landlord\Manage\Country;

class ConfigComposer
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

		$config = Config::with('relCountry')->first();
		$view->with(['_config' => $config]);
		//$view->with('count', $this->users->count());
	}
}
