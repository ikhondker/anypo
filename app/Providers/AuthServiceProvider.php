<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User' 	=> 'App\Policies\UserPolicy',
		'App\Models\Tenant' => 'App\Policies\TenantPolicy',
		'App\Models\Domain' => 'App\Policies\DomainPolicy',

		'App\Models\Landlord\Account'   => 'App\Policies\Landlord\AccountPolicy',
		'App\Models\Landlord\Activity' 	=> 'App\Policies\Landlord\ActivityPolicy',
		'App\Models\Landlord\Checkout' 	=> 'App\Policies\Landlord\CheckoutPolicy',
		'App\Models\Landlord\Comment' 	=> 'App\Policies\Landlord\CommentPolicy',
		'App\Models\Landlord\Contact' 	=> 'App\Policies\Landlord\ContactPolicy',
		'App\Models\Landlord\Dashboard' => 'App\Policies\Landlord\DashboardPolicy',
		'App\Models\Landlord\Dept'		=> 'App\Policies\Landlord\DeptPolicy',
		'App\Models\Landlord\Invoice' 	=> 'App\Policies\Landlord\InvoicePolicy',
		'App\Models\Landlord\Notification' => 'App\Policies\Landlord\NotificationPolicy',
		'App\Models\Landlord\Payment' 	=> 'App\Policies\Landlord\PaymentPolicy',
		'App\Models\Landlord\Service' 	=> 'App\Policies\Landlord\ServicePolicy',
		'App\Models\Landlord\Ticket' 	=> 'App\Policies\Landlord\TicketPolicy',
		'App\Models\Landlord\Report' 	=> 'App\Policies\Landlord\ReportPolicy',
		'App\Models\Landlord\Process' 	=> 'App\Policies\Landlord\ProcessPolicy',
		'App\Models\Landlord\Attachment' => 'App\Policies\Landlord\AttachmentPolicy',

		// check ? TODO
		'App\Models\Landlord\Admin\Category' 	=> 'App\Policies\Landlord\Admin\CategoryPolicy',
		'App\Models\Landlord\Admin\Country' 	=> 'App\Policies\Landlord\Admin\CountryPolicy',
		'App\Models\Landlord\Admin\Entity' 		=> 'App\Policies\Landlord\Admin\EntityPolicy',
		'App\Models\Landlord\Admin\Menu' 		=> 'App\Policies\Landlord\Admin\MenuPolicy',
		'App\Models\Landlord\Admin\PaymentMethod' => 'App\Policies\Landlord\Admin\PaymentMethodPolicy',
		'App\Models\Landlord\Admin\Priority' 	=> 'App\Policies\Landlord\Admin\PriorityPolicy',
		'App\Models\Landlord\Admin\Product' 	=> 'App\Policies\Landlord\Admin\ProductPolicy',
		'App\Models\Landlord\Admin\Rating' 		=> 'App\Policies\Landlord\Admin\RatingPolicy',
		'App\Models\Landlord\Admin\Setup' 		=> 'App\Policies\Landlord\Admin\SetupPolicy',
		'App\Models\Landlord\Admin\Status' 		=> 'App\Policies\Landlord\Admin\StatusPolicy',
		'App\Models\Landlord\Admin\Table' 		=> 'App\Policies\Landlord\Admin\TablePolicy',
		'App\Models\Landlord\Admin\Template' 	=> 'App\Policies\Landlord\Admin\TemplatePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
