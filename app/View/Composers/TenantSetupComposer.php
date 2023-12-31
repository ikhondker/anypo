<?php
 
namespace App\View\Composers;
 
//use App\Repositories\UserRepository;
use Illuminate\View\View;
 
use App\Models\Tenant\Admin\Setup;
//use App\Models\Setup;
class TenantSetupComposer
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

		$setup = Setup::first();
		$view->with(['_setup' => $setup]);
		//$view->with('count', $this->users->count());
	}
}