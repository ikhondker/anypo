<?php
 
namespace App\View\Composers;
 
//use App\Repositories\UserRepository;
use Illuminate\View\View;
 
use App\Models\User;

class LandlordUserComposer
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

        $user = User::where('id', auth()->user()->id)->first();
        $view->with(['_landlord_user' => $user]);
        //$view->with('count', $this->users->count());
    }
}