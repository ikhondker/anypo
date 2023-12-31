<?php
 
namespace App\View\Composers;
 
//use App\Repositories\UserRepository;
use Illuminate\View\View;
 
use App\Models\Landlord\Manage\Setup;
use App\Models\Landlord\Manage\Country;

class LandlordSetupComposer
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

		$setup = Setup::with('relCountry')->first();
		$view->with(['_landlord_setup' => $setup]);
		//$view->with('count', $this->users->count());
	}
}