<?php

 namespace App\View\Composers\Landlord;

//use App\Repositories\UserRepository;
use Illuminate\View\View;

use App\Models\User;

class UserComposer
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
		$user = new User();
		if (auth()->check() ){
			$user = User::where('id', auth()->user()->id)->first();
		}
		$view->with(['_landlord_user' => $user]);
		//$view->with('count', $this->users->count());
	}
}
