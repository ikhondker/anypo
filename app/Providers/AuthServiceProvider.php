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

		/*
		|-----------------------------------------------------------------------------
		| Common																	 + 
		|-----------------------------------------------------------------------------
		*/
		'App\Models\User' 	=> 'App\Policies\UserPolicy',
		'App\Models\Tenant' => 'App\Policies\TenantPolicy',
		'App\Models\Domain' => 'App\Policies\DomainPolicy',
		/*
		|-----------------------------------------------------------------------------
		| Landlord																	 + 
		|-----------------------------------------------------------------------------
		*/
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

		/*
		|-----------------------------------------------------------------------------
		| Tenant																	 + 
		|-----------------------------------------------------------------------------
		*/

		'App\Models\Tenant\Admin\Activity' 		=> 'App\Policies\Tenant\Admin\ActivityPolicy',
		'App\Models\Tenant\Admin\Attachment' 	=> 'App\Policies\Tenant\Admin\AttachmentPolicy',
		'App\Models\Tenant\Admin\Setup' 		=> 'App\Policies\Tenant\Admin\SetupPolicy',

		'App\Models\Tenant\Lookup\Category'     => 'App\Policies\Tenant\Lookup\CategoryPolicy',
		'App\Models\Tenant\Lookup\Country'      => 'App\Policies\Tenant\Lookup\CountryPolicy',
		'App\Models\Tenant\Lookup\Currency'     => 'App\Policies\Tenant\Lookup\CurrencyPolicy',
		'App\Models\Tenant\Lookup\Dept'         => 'App\Policies\Tenant\Lookup\DeptPolicy',
		'App\Models\Tenant\Lookup\Designation'  => 'App\Policies\Tenant\Lookup\DesignationPolicy',
		'App\Models\Tenant\Lookup\Group'        => 'App\Policies\Tenant\Lookup\GroupPolicy',
		'App\Models\Tenant\Lookup\Item'         => 'App\Policies\Tenant\Lookup\ItemPolicy',
		'App\Models\Tenant\Lookup\Oem'          => 'App\Policies\Tenant\Lookup\OemPolicy',
		'App\Models\Tenant\Lookup\Project'      => 'App\Policies\Tenant\Lookup\ProjectPolicy',
		'App\Models\Tenant\Lookup\Rate'         => 'App\Policies\Tenant\Lookup\RatePolicy',
		'App\Models\Tenant\Lookup\Supplier'     => 'App\Policies\Tenant\Lookup\SupplierPolicy',
		'App\Models\Tenant\Lookup\Uom'          => 'App\Policies\Tenant\Lookup\UomPolicy',
		'App\Models\Tenant\Lookup\UploadItem'   => 'App\Policies\Tenant\Lookup\UploadItemPolicy',
		'App\Models\Tenant\Lookup\Warehouse'    => 'App\Policies\Tenant\Lookup\WarehousePolicy',

		'App\Models\Tenant\Manage\Entity'       => 'App\Policies\Tenant\Manage\EntityPolicy',
		'App\Models\Tenant\Manage\Menu'         => 'App\Policies\Tenant\Manage\MenuPolicy',
		'App\Models\Tenant\Manage\Table'        => 'App\Policies\Tenant\Manage\TablePolicy',
		'App\Models\Tenant\Manage\Template'     => 'App\Policies\Tenant\Manage\TemplatePolicy',

		'App\Models\Tenant\Workflow\Hierarchy'  => 'App\Policies\Tenant\Workflow\HierarchyPolicy',
		'App\Models\Tenant\Workflow\Hierarchyl' => 'App\Policies\Tenant\Workflow\HierarchylPolicy',
		'App\Models\Tenant\Workflow\Wf'         => 'App\Policies\Tenant\Workflow\WfPolicy',
		'App\Models\Tenant\Workflow\Wfl'        => 'App\Policies\Tenant\Workflow\WflPolicy',


		'App\Models\Tenant\Budget'            	=> 'App\Policies\Tenant\BudgetPolicy',
		'App\Models\Tenant\DeptBudget'          => 'App\Policies\Tenant\DeptBudgetPolicy',
		'App\Models\Tenant\Notification'        => 'App\Policies\Tenant\NotificationPolicy',
		'App\Models\Tenant\Payment'             => 'App\Policies\Tenant\PaymentPolicy',
		'App\Models\Tenant\Po'                  => 'App\Policies\Tenant\PoPolicy',
		'App\Models\Tenant\Pol'                 => 'App\Policies\Tenant\PolPolicy',
		'App\Models\Tenant\Pr'                  => 'App\Policies\Tenant\PrPolicy',
		'App\Models\Tenant\Prl'                 => 'App\Policies\Tenant\PrlPolicy',
		'App\Models\Tenant\Receipt' 			=> 'App\Policies\Tenant\ReceiptPolicy',
		'App\Models\Tenant\Report' 				=> 'App\Policies\Tenant\ReportPolicy',
		
		// 'App\Models\BankAccount' => 'App\Policies\BankAccountPolicy',
		// 'App\Models\Tenant' => 'App\Policies\TenantPolicy',
		// 'App\Models\User' => 'App\Policies\UserPolicy',

	];

	/**
	 * Register any authentication / authorization services.
	 */
	public function boot(): void
	{
		//
	}
}
